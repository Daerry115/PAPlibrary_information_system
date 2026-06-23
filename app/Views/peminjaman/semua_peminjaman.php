<?= $this->extend('layouts/template') ?>

<?= $this->section('content') ?>
<section class="content pt-4">
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-dark">
                <h3 class="card-title font-weight-bold">Data Riwayat Transaksi Peminjaman</h3>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped table-hover">
                        <thead>
                            <tr>
                                <th width="50" class="text-center">No.</th>
                                <th>Kode Peminjaman</th>
                                <th>Anggota</th>
                                <th>Kode Buku</th>
                                <th>Judul Buku</th>
                                <th>Tgl Pinjam</th>
                                <th>Batas Kembali</th>
                                <th>Durasi</th>
                                <th>Status</th>
                                <th>Denda</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (empty($peminjaman)): ?>
                                <tr>
                                    <td colspan="10" class="text-center text-muted py-4">Belum ada data transaksi peminjaman.</td>
                                </tr>
                            <?php else: ?>
                                <?php $no = 1; foreach ($peminjaman as $p): ?>
                                    <tr>
                                        <td class="text-center"><?= $no++ ?></td>
                                        <td class="font-weight-bold text-primary"><?= $p['kode_peminjaman'] ?></td>
                                        <td>
                                            <span class="badge badge-secondary"><?= $p['kode_member'] ?? $p['id_member'] ?? '-' ?></span><br>
                                            <strong><?= $p['nama_member'] ?? 'Anggota' ?></strong>
                                        </td>
                                        <td><?= $p['kode_buku'] ?? $p['code_book'] ?? '-' ?></td>
                                        <td><?= $p['judul_buku'] ?? $p['title_book'] ?? '-' ?></td>
                                        <td><?= date('d/m/Y', strtotime($p['tanggal_pinjam'])) ?></td>
                                        <td><?= date('d/m/Y', strtotime($p['batas_kembali'])) ?></td>
                                        <td><?= $p['durasi_pinjam'] ?> hari</td>
                                        <td>
                                            <?= $p['status'] === 'dipinjam' 
                                                ? '<span class="badge badge-warning px-2 py-1">Dipinjam</span>' 
                                                : '<span class="badge badge-success px-2 py-1">Dikembalikan</span>' ?>
                                        </td>
                                        <td>
                                            <?php if ($p['status'] === 'dipinjam'): ?>
                                                <span class="text-muted">-</span>
                                            <?php elseif ((int)$p['denda'] > 0): ?>
                                                <span class="text-danger font-weight-bold">Rp <?= number_format((int)$p['denda'], 0, ',', '.') ?></span>
                                            <?php else: ?>
                                                <span class="text-success">Rp 0</span>
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