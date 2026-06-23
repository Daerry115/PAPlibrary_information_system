<?= $this->extend('layouts/template') ?>

<?= $this->section('header') ?>
<div class="row mb-2">
    <div class="col-sm-6">
        <h1><?= $title ?></h1>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-user mr-2"></i>Cari Anggota
        </h3>
    </div>
    <div class="card-body">
        <div class="row align-items-end">
            <div class="col-md-4">
                <div class="form-group mb-0">
                    <label for="kode_anggota">Kode Anggota</label>
                    <div class="input-group">
                        <input type="text"
                               id="kode_anggota"
                               class="form-control"
                               placeholder="Masukkan kode anggota...">

                        <div class="input-group-append">
                            <button class="btn btn-primary"
                                    id="btn-cari-anggota"
                                    type="button">
                                <i class="fas fa-search"></i> Cari
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div id="info-anggota" class="mt-3" style="display:none;">
            <hr>
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td width="140"><strong>Kode Anggota</strong></td>
                            <td>: <span id="anggota-kode"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Nama</strong></td>
                            <td>: <span id="anggota-nama"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Email</strong></td>
                            <td>: <span id="anggota-email"></span></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-6">
                    <table class="table table-sm table-borderless">
                        <tr>
                            <td width="140"><strong>Telepon</strong></td>
                            <td>: <span id="anggota-telepon"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Alamat</strong></td>
                            <td>: <span id="anggota-alamat"></span></td>
                        </tr>
                        <tr>
                            <td><strong>Tgl Bergabung</strong></td>
                            <td>: <span id="anggota-join"></span></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div id="info-anggota-error"
             class="alert alert-warning mt-3"
             style="display:none;">
            <i class="fas fa-exclamation-triangle mr-1"></i>
            <span id="pesan-error-anggota"></span>
        </div>
    </div>
</div>

<div class="card" id="card-peminjaman" style="display:none;">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-book mr-2"></i>Buku yang Dipinjam
        </h3>
        <div class="card-tools">
            <button class="btn btn-success btn-sm"
                    id="btn-tambah-peminjaman"
                    type="button">
                <i class="fas fa-plus"></i> Tambah Peminjaman
            </button>
        </div>
    </div>
    <div class="card-body table-responsive p-0">
        <table class="table table-bordered table-striped table-sm mb-0">
            <thead class="thead-light">
                <tr>
                    <th width="50">No.</th>
                    <th>Kode Peminjaman</th>
                    <th>Kode Buku</th>
                    <th>Judul Buku</th>
                    <th>Pengarang</th>
                    <th>Tgl Pinjam</th>
                    <th>Batas Kembali</th>
                    <th>Durasi</th>
                    <th>Status</th>
                    <th>Denda</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="tbody-peminjaman">
                <tr>
                    <td colspan="11" class="text-center text-muted">
                        Belum ada data peminjaman.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="modalTambahPeminjaman" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-success text-white">
                <h5 class="modal-title">
                    <i class="fas fa-plus-circle mr-2"></i>Tambah Peminjaman Buku
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="modal-alert" class="alert" style="display:none;"></div>
                <input type="hidden" id="hidden-id-member">

                <div class="form-group">
                    <label for="kode_buku">Kode Buku <span class="text-danger">*</span></label>
                    <input type="text" id="kode_buku" class="form-control"
                           placeholder="Masukkan kode buku..." autocomplete="off">
                    <small class="form-text text-muted">
                        Masukkan kode buku yang akan dipinjam.
                    </small>
                </div>

                <div class="form-group">
                    <label for="tanggal_pinjam">
                        Tanggal Pinjam <span class="text-danger">*</span>
                    </label>
                    <input type="date" id="tanggal_pinjam" class="form-control">
                </div>

                <div class="form-group">
                    <label for="durasi_pinjam">
                        Lama Pinjam (hari) <span class="text-danger">*</span>
                    </label>
                    <input type="number" id="durasi_pinjam" class="form-control"
                           value="3" min="1" max="60">
                    <small class="form-text text-muted">
                        Default 3 hari. Tanggal kembali dihitung otomatis.
                    </small>
                </div>

                <div class="form-group mb-0">
                    <label>Perkiraan Tanggal Kembali</label>
                    <input type="text" id="preview_batas_kembali"
                           class="form-control" readonly
                           style="background:#f4f6f9;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-success" id="btn-simpan-peminjaman">
                    <i class="fas fa-save mr-1"></i> Simpan
                </button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalKembalikan" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info text-white">
                <h5 class="modal-title">
                    <i class="fas fa-undo-alt mr-2"></i>Konfirmasi Pengembalian Buku
                </h5>
                <button type="button" class="close text-white" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="kembalikan-id">
                <table class="table table-sm table-borderless mb-3">
                    <tr>
                        <td width="150"><strong>Kode Buku</strong></td>
                        <td>: <span id="kembalikan-kode-buku"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Judul Buku</strong></td>
                        <td>: <span id="kembalikan-judul"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Batas Kembali</strong></td>
                        <td>: <span id="kembalikan-batas"></span></td>
                    </tr>
                    <tr>
                        <td><strong>Tgl Dikembalikan</strong></td>
                        <td>: <span id="kembalikan-tgl-kembali"></span>
                            &nbsp;
                            <span id="kembalikan-info-terlambat" class="font-weight-bold"></span>
                        </td>
                    </tr>
                </table>
                <hr>
                <div class="form-group mb-0">
                    <label for="input_denda"><strong>Denda (Rp)</strong></label>
                    <input type="number" id="input_denda" class="form-control"
                           value="0" min="0" step="500" placeholder="0">
                    <small class="form-text text-muted">
                        Masukkan nominal denda yang dikenakan. Isi 0 jika tidak ada denda.
                    </small>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-info" id="btn-konfirmasi-kembalikan">
                    <i class="fas fa-check mr-1"></i> Konfirmasi Pengembalian
                </button>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?= $this->section('js') ?>
<script>
    let currentMemberId = null; 
    const BASE_URL = '<?= base_url() ?>/'; 

    document.getElementById('btn-cari-anggota').addEventListener('click', cariAnggota);

    document.getElementById('kode_anggota').addEventListener('keydown', function(e) {
        if (e.key === 'Enter') cariAnggota();
    });

    function cariAnggota() {
        const kode = document.getElementById('kode_anggota').value.trim();
        if (!kode) return;

        document.getElementById('info-anggota').style.display       = 'none';
        document.getElementById('info-anggota-error').style.display = 'none';

        fetch(BASE_URL + 'peminjaman/get-anggota', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: 'kode_anggota=' + encodeURIComponent(kode)
        })
        .then(response => response.json())
        .then(function(res) {
            if (res.success) {
                const m = res.member;
                currentMemberId = m.id_member;
                document.getElementById('hidden-id-member').value      = m.id_member;
                
                document.getElementById('anggota-kode').textContent    = m.code_member;
                document.getElementById('anggota-nama').textContent    = m.name_member;
                document.getElementById('anggota-email').textContent   = m.email_member   || '-';
                document.getElementById('anggota-telepon').textContent = m.phone_member   || '-';
                document.getElementById('anggota-alamat').textContent  = m.address_member || '-';
                document.getElementById('anggota-join').textContent    = m.join_date      || '-';

                document.getElementById('info-anggota').style.display    = 'block';
                document.getElementById('card-peminjaman').style.display = 'block';
                renderTabel(res.peminjaman);

            } else {
                document.getElementById('pesan-error-anggota').textContent = res.message;
                document.getElementById('info-anggota-error').style.display = 'block';
            }
        });
    }

    document.getElementById('tanggal_pinjam').value = new Date().toISOString().split('T')[0];
    updatePreviewBatasKembali();

    function updatePreviewBatasKembali() {
        const tanggal = document.getElementById('tanggal_pinjam').value;
        const durasi  = parseInt(document.getElementById('durasi_pinjam').value) || 3;
        if (tanggal) {
            const batas = new Date(tanggal);
            const offset = batas.getTimezoneOffset();
            batas.setMinutes(batas.getMinutes() - offset);
            batas.setDate(batas.getDate() + durasi);
            document.getElementById('preview_batas_kembali').value =
                batas.toLocaleDateString('id-ID', {
                    weekday: 'long', year: 'numeric', month: 'long', day: 'numeric'
                });
        }
    }

    document.getElementById('tanggal_pinjam').addEventListener('change', updatePreviewBatasKembali);
    document.getElementById('durasi_pinjam').addEventListener('input', updatePreviewBatasKembali);

    document.getElementById('btn-tambah-peminjaman').addEventListener('click', function() {
        document.getElementById('kode_buku').value      = '';
        document.getElementById('tanggal_pinjam').value = new Date().toISOString().split('T')[0];
        document.getElementById('durasi_pinjam').value  = 3;
        document.getElementById('modal-alert').style.display = 'none';
        updatePreviewBatasKembali();
        $('#modalTambahPeminjaman').modal('show');
    });

    document.getElementById('btn-simpan-peminjaman').addEventListener('click', function() {
        const kode_buku      = document.getElementById('kode_buku').value.trim();
        const tanggal_pinjam = document.getElementById('tanggal_pinjam').value;
        const durasi_pinjam  = document.getElementById('durasi_pinjam').value;
        const id_member      = document.getElementById('hidden-id-member').value;

        if (!kode_buku || !tanggal_pinjam || !durasi_pinjam) {
            showModalAlert('danger', 'Semua field wajib diisi.');
            return;
        }

        fetch(BASE_URL + 'peminjaman/store', {
            method: 'POST',
            headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
            body: new URLSearchParams({ kode_buku, tanggal_pinjam, durasi_pinjam, id_member })
        })
        .then(r => r.json())
        .then(function(res) {
            if (res.success) {
                $('#modalTambahPeminjaman').modal('hide');
                renderTabel(res.peminjaman);
                showToast('success', res.message);
            } else {
                showModalAlert('danger', res.message);
            }
        });
    });

    // ==========================================================
    // PERBAIKAN TOTAL: FUNGSI RENDER TABEL & PASANG DATASET MODAL
    // ==========================================================
    function renderTabel(peminjaman) {
        const tbody = document.getElementById('tbody-peminjaman');

        if (!peminjaman || peminjaman.length === 0) {
            tbody.innerHTML = '<tr><td colspan="11" class="text-center text-muted">Belum ada data peminjaman.</td></tr>';
            return;
        }

        let html = '';

        peminjaman.forEach(function(p, i) {
        const badge = p.status === 'dipinjam'
            ? '<span class="badge badge-warning">Dipinjam</span>'
            : '<span class="badge badge-success">Dikembalikan</span>';

        // AMAN: Jika properti Indonesia tidak ada, dia otomatis pakai properti Inggris
        const v_kode_buku   = p.kode_buku   || p.code_book  || p.book_code  || '-';
        const v_judul_buku  = p.judul_buku  || p.title_book || p.book_title || '-';
        const v_pengarang   = p.pengarang   || p.author     || p.author_book|| '-';
        const v_batas       = p.batas_kembali || p.date_expire|| '-';

        const aksi = p.status === 'dipinjam'
            ? `<button class="btn btn-xs btn-info btn-kembalikan" 
                    data-id="${p.id_peminjaman}"
                    data-kode="${v_kode_buku}"
                    data-judul="${v_judul_buku}"
                    data-batas="${v_batas}">
                <i class="fas fa-undo-alt"></i> Kembalikan
            </button>`
            : '-';

        const denda = parseInt(p.denda) || 0;
        let dendaCell;
        if (p.status === 'dipinjam') {
            dendaCell = '<span class="text-muted">-</span>';
        } else if (denda > 0) {
            dendaCell = `<span class="text-danger font-weight-bold">Rp ${denda.toLocaleString('id-ID')}</span>`;
        } else {
            dendaCell = '<span class="text-success">Rp 0</span>';
        }

        // Tampilkan variabel yang sudah divalidasi di atas
        html += `<tr>
            <td>${i + 1}</td>
            <td>${p.kode_peminjaman}</td>
            <td>${v_kode_buku}</td>
            <td>${v_judul_buku}</td>
            <td>${v_pengarang}</td>
            <td>${p.tanggal_pinjam || p.date_borrow}</td>
            <td>${v_batas}</td>
            <td>${p.durasi_pinjam || p.duration_borrow} hari</td>
            <td>${badge}</td>
            <td>${dendaCell}</td>
            <td>${aksi}</td>
        </tr>`;
    });

        tbody.innerHTML = html;

        // Pasang event listener pengembalian secara dinamis setelah HTML selesai dirender
        document.querySelectorAll('.btn-kembalikan').forEach(btn => {
            btn.addEventListener('click', function() {
                const batasKembali = this.dataset.batas;
                const today        = new Date().toISOString().split('T')[0];

                document.getElementById('kembalikan-id').value                = this.dataset.id;
                document.getElementById('kembalikan-kode-buku').textContent  = this.dataset.kode;
                document.getElementById('kembalikan-judul').textContent      = this.dataset.judul;
                document.getElementById('kembalikan-batas').textContent      = batasKembali;
                document.getElementById('kembalikan-tgl-kembali').textContent = today;
                document.getElementById('input_denda').value                 = 0;

                const diffHari = Math.floor((new Date(today) - new Date(batasKembali)) / 86400000);
                const infoEl   = document.getElementById('kembalikan-info-terlambat');
                if (diffHari > 0) {
                    infoEl.textContent = `(Terlambat ${diffHari} hari)`;
                    infoEl.className   = 'font-weight-bold text-danger';
                } else {
                    infoEl.textContent = '(Tepat waktu)';
                    infoEl.className   = 'font-weight-bold text-success';
                }

                $('#modalKembalikan').modal('show');
            });
        });
    }

    function showModalAlert(type, pesan) {
        const el = document.getElementById('modal-alert');
        el.className      = 'alert alert-' + type;
        el.textContent    = pesan;
        el.style.display  = 'block';
    }

    function showToast(type, pesan) {
        const warna = type === 'success' ? '#28a745' : '#dc3545';
        const div   = document.createElement('div');
        div.style.cssText = `
            position: fixed; top: 20px; right: 20px; z-index: 9999;
            background: ${warna}; color: #fff;
            padding: 12px 20px; border-radius: 6px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.2); font-size: 14px;
        `;
        div.innerHTML = `<i class="fas fa-check-circle mr-2"></i>${pesan}`;
        document.body.appendChild(div);
        setTimeout(() => div.remove(), 3000);
    }

    document.getElementById('btn-konfirmasi-kembalikan').addEventListener('click', function() {
        const id    = document.getElementById('kembalikan-id').value;
        const denda = parseInt(document.getElementById('input_denda').value) || 0;
        $('#modalKembalikan').modal('hide');
        kembalikanBuku(id, denda);
    });

    function kembalikanBuku(id_peminjaman, denda) {
        fetch(BASE_URL + 'peminjaman/kembalikan/' + id_peminjaman, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: 'denda=' + encodeURIComponent(denda)
        })
        .then(r => r.json())
        .then(res => {
            if (res.success) {
                renderTabel(res.peminjaman);
                showToast('success', res.message);
            } else {
                alert(res.message);
            }
        });
    }
</script>
<?= $this->endSection() ?>