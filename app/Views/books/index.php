<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1>Daftar Buku</h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="card">
    <div class="card-header">
        <h3 class="card-title">Data Buku</h3>

        <div class="card-tools">
            <a href="<?= base_url('book/trash') ?>" class="btn btn-warning btn-sm">
                <i class="fas fa-trash"></i> Tong Sampah
            </a>
            <a href="<?= base_url('create/book') ?>" class="btn btn-primary btn-sm">
                <i class="fas fa-plus"></i> Tambah Buku
            </a>
        </div>
    </div>

    <div class="card-body table-responsive">
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?= session()->getFlashdata('success'); ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th width="50">No.</th>
                    <th>Kode Buku</th>
                    <th>ISBN</th>
                    <th>Judul Buku</th>
                    <th>Penulis</th>
                    <th>Penerbit</th>
                    <th>Tahun</th>
                    <th>Keterangan</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
    <?php if (!empty($books) && is_array($books)) : ?>
        <?php $no = 1; ?>
        <?php foreach ($books as $book) : ?>
            <tr>
                <td><?= $no++; ?></td>
                <td><?= esc($book['code_book']) ?></td>
                <td><?= esc($book['isbn_book']) ?></td>
                <td><?= esc($book['title_book']) ?></td>
                <td><?= esc($book['author_book']) ?></td>
                <td><?= esc($book['publisher_book']) ?></td>
                <td><?= esc($book['published_year']) ?></td>
                <td><?= esc($book['description_book']) ?></td>
                <td>
                    <?= isset($book['stock']) ? esc($book['stock']) : '-' ?>
                </td>
                <td>
                    <a href="<?= base_url('edit/book/' . $book['id_book']) ?>" class="btn btn-info btn-sm">Edit</a>
                    
                    <a href="<?= base_url('delete/book/' . $book['id_book']) ?>" 
                       class="btn btn-danger btn-sm" 
                       onclick="return confirm('Apakah Anda yakin ingin menghapus buku ini?')">Hapus</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else : ?>
        <tr>
            <td colspan="7" class="text-center">Tidak ada data buku ditemukan.</td>
        </tr>
    <?php endif; ?>
</tbody>
<?php if (session()->getFlashdata('success')) : ?>
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <?= session()->getFlashdata('success'); ?>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
<?php endif; ?>
<table class="table table-bordered table-striped">  
    <thead>
        </table>
    </div>
</div>
<?= $this->endsection() ?>