<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Pengeluaran Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 20px;
        }

        .card {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        .mt-3 {
            margin-top: 15px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table,
        th,
        td {
            border: 1px solid #ddd;
        }

        th,
        td {
            padding: 8px;
        }

        thead {
            background-color: #f5f5f5;
        }

        .print-btn {
            float: right;
            padding: 5px 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .excel-btn {
            float: right;
            padding: 5px 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            margin-bottom: 10px;
            margin-right: 10px;
        }

        .header-info {
            margin-bottom: 20px;
        }

        .total-row {
            font-weight: bold;
            background-color: #f8f9fa;
        }

        @media print {
            .print-btn {
                display: none;
            }

            .excel-btn {
                display: none;
            }

            body {
                margin: 0;
                padding: 15px;
            }
        }
    </style>
</head>

<body>
    <div class="card">
        <button class="print-btn" onclick="window.print()">Print</button>
        <button class="excel-btn" onclick="window.location.href='<?= base_url('admin/historykeluar/excel') ?>'">
            Excel
        </button>
        <div class="text-center header-info">
            <h3>History Pengeluaran Barang</h3>
            <p>Periode: <?= isset($tglAwal) ? date('d-m-Y', strtotime($tglAwal)) : '' ?>
                s/d <?= isset($tglAkhir) ? date('d-m-Y', strtotime($tglAkhir)) : '' ?></p>
        </div>

        <table class="mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No DO</th>
                    <th>Customer</th>
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Group</th>
                    <th class="text-end">Jumlah Keluar</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $totalQty = 0;
                foreach ($data as $d) :
                    $totalQty += $d->qtt_out;
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d-m-Y', strtotime($d->tgl)) ?></td>
                        <td><?= $d->no_do ?></td>
                        <td><?= $d->customer ?></td>
                        <td><?= $d->kode_brg ?></td>
                        <td><?= $d->nama_brg ?></td>
                        <td><?= $d->nama_group ?></td>
                        <td class="text-end"><?= number_format($d->qtt_out, 0, ',', '.') ?></td>
                        <td><?= $d->nama_satuan ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="7" class="text-end">Total Quantity:</td>
                    <td class="text-end"><?= number_format($totalQty, 0, ',', '.') ?></td>
                    <td></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>