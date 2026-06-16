<?php

namespace App\Controllers;

use App\Models\BookModel;
use App\Models\MemberModel;

class LaporanController extends BaseController
{
    public function buku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Laporan Data Buku';

        return view('laporan/buku', $data);
    }

    public function cetakBuku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Laporan Data Buku';

        return view('laporan/cetak_buku', $data);
    }

    public function labelBuku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Cetak Label Buku';

        return view('laporan/label_buku', $data);
    }

    public function cetakLabelBuku()
    {
        $bookModel = new BookModel();
        $data['books'] = $bookModel->findAll();
        $data['title'] = 'Cetak Label Buku';

        return view('laporan/cetak_label_buku', $data);
    }

    public function cetakLabelSatu($id)
    {
        $bookModel = new BookModel();
        $data['book'] = $bookModel->find($id);
        $data['title'] = 'Cetak Label Buku';

        return view('laporan/cetak_label_satu', $data);
    }

    public function cetakMember()
    {
        $memberModel = new MemberModel();
        $data['members'] = $memberModel->findAll();
        $data['title'] = 'Laporan Data Member';

        return view('laporan/cetak_member', $data);
    }

}