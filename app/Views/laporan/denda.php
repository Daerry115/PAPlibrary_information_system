<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<section class="content pt-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-danger text-white d-flex align-items-center">
                <h3 class="card-title font-weight-bold mb-0">
                    <i class="fas fa-money-bill-wave mr-2"></i> Laporan & Rekapitulasi Denda Anggota
                </h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead class="thead-dark">
                            <tr>
                                <th width="50" class="text-center">No.</th>
                                <th>Kode Peminjaman</th>
                                <th>Nama Anggota</th>
                                <th>Judul Buku</th>
                                <th class="text-center">Tgl Pinjam</th>
                                <th class="text-center">Batas Kembali</th>
                                <th class="text-center">Terlambat</th>
                                <th>Total Denda</th>
                                <th class="text-center">Status Denda</th>
                                <th width="120" class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($denda_list)): ?>
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-4">Belum ada data denda keterlambatan buku.</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($denda_list as $d): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="font-weight-bold text-primary"><?= $d['kode_peminjaman'] ?></td>
                                        <td>
                                            <span class="badge badge-secondary"><?= $d['kode_member'] ?? $d['id_member'] ?? '-' ?></span><br>
                                            <strong><?= $d['nama_member'] ?? 'Anggota' ?></strong>
                                        </td>
                                        <td><?= $d['judul_buku'] ?? $d['title_book'] ?? '-' ?></td>
                                        <td class="text-center"><?= date('d/m/Y', strtotime($d['tanggal_pinjam'])) ?></td>
                                        <td class="text-center"><?= date('d/m/Y', strtotime($d['batas_kembali'])) ?></td>
                                        <td class="text-center text-warning font-weight-bold">
                                            <?= $d['durasi_terlambat'] ?? '0' ?> hari
                                        </td>
                                        <td class="text-danger font-weight-bold">
                                            Rp <?= number_format((int)$d['denda'], 0, ',', '.') ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if (isset($d['status_denda']) && $d['status_denda'] === 'lunas'): ?>
                                                <span class="badge badge-success px-3 py-2"><i class="fas fa-check-circle"></i> LUNAS</span>
                                            <?php else: ?>
                                                <span class="badge badge-danger px-3 py-2"><i class="fas fa-exclamation-triangle"></i> BELUM LUNAS</span>
                                            <?php endif; ?>
                                        </td>
                                        <td class="text-center">
                                            <?php if (!isset($d['status_denda']) || $d['status_denda'] !== 'lunas'): ?>
                                                <a href="<?= base_url('peminjaman/bayar_denda/' . $d['kode_peminjaman']) ?>" class="btn btn-xs btn-success" onclick="return confirm('Apakah anggota sudah membayar denda ini?')">
                                                    <i class="fas fa-money-check"></i> Bayar
                                                </a>
                                            <?php else: ?>
                                                <span class="text-muted"><i class="fas fa-check"></i> Selesai</span>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
        </div>
</section>
<?= $this->endSection() ?>