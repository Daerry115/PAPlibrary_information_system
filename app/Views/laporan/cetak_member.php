<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
            color: #000;
        }

        .header-laporan {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 2px solid #000;
            padding-bottom: 10px;
        }

        .header-laporan h2 {
            margin: 0;
            font-size: 18px;
            text-transform: uppercase;
        }

        .header-laporan p {
            margin: 4px 0 0 0;
            font-size: 12px;
            color: #555;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th {
            background-color: #343a40;
            color: white;
            padding: 8px;
            text-align: left;
            border: 1px solid #999;
            font-size: 11px;
        }

        table td {
            padding: 6px 8px;
            border: 1px solid #ccc;
            font-size: 11px;
        }

        table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .tombol-cetak {
            text-align: right;
            margin-bottom: 15px;
        }

        .tombol-cetak button {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 20px;
            border-radius: 4px;
            cursor: pointer;
        }

        @media print {
            .tombol-cetak {
                display: none;
            }

            body {
                margin: 10px;
            }
        }
    </style>

</head>

<body>

<div class="tombol-cetak">
    <button onclick="window.print()">
        🖨 Cetak / Simpan sebagai PDF
    </button>
</div>


<div class="header-laporan">

    <h2>Laporan Data Member</h2>

    <p>Library Information System</p>

    <p>
        Dicetak pada: <?= date('d F Y, H:i') ?> WIB
    </p>

</div>


<table>

<thead>
<tr>
    <th width="40">No.</th>
    <th>Kode Member</th>
    <th>Nama Member</th>
    <th>Email</th>
    <th>No. Telepon</th>
    <th>Alamat</th>
</tr>
</thead>


<tbody>

<?php $no = 0; ?>

<?php foreach($members as $member): ?>

<?php $no++; ?>

<tr>

    <td><?= $no ?></td>

    <td><?= $member['code_member'] ?></td>

    <td><?= $member['name_member'] ?></td>

    <td><?= $member['email_member'] ?></td>

    <td><?= $member['phone_member'] ?></td>

    <td><?= $member['address_member'] ?></td>

</tr>

<?php endforeach; ?>

</tbody>

</table>


<script>

window.onload = function () {
    window.print();
};

</script>


</body>
</html>