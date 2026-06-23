<?php

namespace App\Controllers;

use App\Models\PeminjamanModel;
use App\Models\MemberModel;
use App\Models\BookModel;

class PeminjamanController extends BaseController
{
    // Tampilkan halaman utama peminjaman
    public function index(): string
    {
        $data['title'] = 'Peminjaman Buku';
        return view('peminjaman/index', $data);
    }

    public function getAnggota()
    {
        // Ambil data kode_anggota yang dikirim via POST dari View
        $kode_anggota = $this->request->getPost('kode_anggota');

        // 1. Inisialisasi Model Anggota
        $memberModel = new MemberModel(); 
        
        // Cari data anggota berdasarkan field 'code_member'
        $member = $memberModel->where('code_member', $kode_anggota)->first();

        // Jika data anggota tidak ditemukan di database
        if (!$member) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kode anggota tidak ditemukan.'
            ]);
        }

        // 2. QUERY UTAMA: Tarik semua riwayat peminjaman milik anggota ini beserta data bukunya
        $db = \Config\Database::connect();
        $peminjaman = $db->table('peminjaman')
            ->select('peminjaman.*, books.title_book as judul_buku, books.author_book as pengarang, books.code_book as kode_buku')
            ->join('books', 'books.id_book = peminjaman.id_book')
            ->where('peminjaman.id_member', $member['id_member']) // Filter hanya untuk anggota ini
            ->orderBy('peminjaman.id_peminjaman', 'DESC')        // Urutkan dari yang terbaru
            ->get()
            ->getResultArray();

        // 3. Kembalikan respons dalam bentuk JSON ke View
        return $this->response->setJSON([
            'success'    => true,
            'member'     => $member,      
            'peminjaman' => $peminjaman   
        ]);
    }

    public function store()
    {
        $kode_buku      = $this->request->getPost('kode_buku');
        $tanggal_pinjam = $this->request->getPost('tanggal_pinjam');
        $durasi_pinjam  = $this->request->getPost('durasi_pinjam');
        $id_member      = $this->request->getPost('id_member');

        $bookModel = new BookModel();
        $buku = $bookModel->where('code_book', $kode_buku)->first();

        if (!$buku) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Kode buku tidak valid atau tidak ditemukan.'
            ]);
        }

        if (strpos($tanggal_pinjam, '/') !== false) {
            $dateObj = \DateTime::createFromFormat('d/m/Y', $tanggal_pinjam);
            $tanggal_pinjam_db = $dateObj ? $dateObj->format('Y-m-d') : date('Y-m-d');
        } else {
            $tanggal_pinjam_db = $tanggal_pinjam;
        }

        $batas_kembali = date('Y-m-d', strtotime($tanggal_pinjam_db . ' + ' . $durasi_pinjam . ' days'));
        $kode_peminjaman = 'PMJ-' . date('YmdHis') . '-' . rand(10, 99);

        $peminjamanModel = new PeminjamanModel();
        $dataBaru = [
            'kode_peminjaman' => $kode_peminjaman,
            'id_member'       => $id_member,
            'id_book'         => $buku['id_book'],
            'tanggal_pinjam'  => $tanggal_pinjam_db,
            'batas_kembali'   => $batas_kembali,
            'durasi_pinjam'   => $durasi_pinjam,
            'status'          => 'dipinjam' 
        ];

        if (!$peminjamanModel->insert($dataBaru)) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Gagal menyimpan data ke database.'
            ]);
        }
        
        $db = \Config\Database::connect();
        $peminjamanTerbaru = $db->table('peminjaman')
            ->select('peminjaman.*, books.title_book as judul_buku, books.author_book as pengarang, books.code_book as kode_buku')
            ->join('books', 'books.id_book = peminjaman.id_book')
            ->where('peminjaman.id_member', $id_member)
            ->orderBy('peminjaman.id_peminjaman', 'DESC')
            ->get()
            ->getResultArray();

        return $this->response->setJSON([
            'success'    => true,
            'message'    => 'Data transaksi peminjaman berhasil disimpan.',
            'peminjaman' => $peminjamanTerbaru 
        ]);
    }

    public function kembalikan($id_peminjaman)
    {
        $peminjamanModel = new PeminjamanModel();
        $data            = $peminjamanModel->find($id_peminjaman);

        if (!$data) {
            return $this->response->setJSON([
                'success' => false,
                'message' => 'Data peminjaman tidak ditemukan.'
            ]);
        }

        $denda          = (int) $this->request->getPost('denda');
        $tanggalKembali = date('Y-m-d');

        $hariTerlambat = (int) floor(
            (strtotime($tanggalKembali) - strtotime($data['batas_kembali'])) / 86400
        );

        $isUpdated = $peminjamanModel->update($id_peminjaman, [
            'status'               => 'dikembalikan',
            'tanggal_dikembalikan' => $tanggalKembali,
            'denda'                => $denda,
        ]);

        if ($isUpdated) {
            $db = \Config\Database::connect();
            $peminjaman = $db->table('peminjaman')
                ->select('peminjaman.*, books.title_book as judul_buku, books.author_book as pengarang, books.code_book as kode_buku')
                ->join('books', 'books.id_book = peminjaman.id_book')
                ->where('peminjaman.id_member', $data['id_member'])
                ->orderBy('peminjaman.id_peminjaman', 'DESC')
                ->get()
                ->getResultArray();

            $message = $denda > 0
                ? "Buku berhasil dikembalikan. Denda Rp "
                  . number_format($denda, 0, ',', '.')
                  . ($hariTerlambat > 0 ? " (terlambat {$hariTerlambat} hari)." : '.')
                : 'Buku berhasil dikembalikan' . ($hariTerlambat <= 0 ? ' tepat waktu.' : '.');

            return $this->response->setJSON([
                'success'    => true,
                'message'    => $message,
                'denda'      => $denda,
                'peminjaman' => $peminjaman,
            ]);
        }

        return $this->response->setJSON([
            'success' => false,
            'message' => 'Gagal memproses pengembalian.'
        ]);
    }

    public function semua()
    {
        $peminjamanModel = new \App\Models\PeminjamanModel(); // Sesuaikan dengan nama modelmu
        
        $data['peminjaman'] = $peminjamanModel->findAll();
        $data['title']      = 'Daftar Semua Peminjaman';

        // Cukup panggil file view semua_peminjaman saja, jangan di-chain/ditambah . view('layout/header')
        return view('peminjaman/semua_peminjaman', $data);
    }
    
    public function laporanDenda()
    {
        $peminjamanModel = new \App\Models\PeminjamanModel(); // Sesuaikan dengan nama modelmu
        
        // Mengambil data peminjaman yang memiliki denda saja atau semua yang pernah didenda
        // Jika di modelmu field denda tipenya integer/numeric
        $data['denda_list'] = $peminjamanModel->where('denda >', 0)->findAll(); 
        $data['title']      = 'Laporan Denda Buku';

        return view('peminjaman/laporan_denda', $data); // Mengarah ke file view baru kita
    }

} 