<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Barang Keluar</title>
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
        <div class="text-center header-info">
            <h3>History Barang Keluar</h3>
            <p>Periode: <?= isset($tglAwal) ? date('d/m/Y', strtotime($tglAwal)) : '' ?>
                s/d <?= isset($tglAkhir) ? date('d/m/Y', strtotime($tglAkhir)) : '' ?></p>
        </div>

        <table class="mt-3">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>No DO</th>
                    <th>Customer</th>
                    <th>Nama Barang</th>
                    <th class="text-end">Quantity</th>
                    <th>Satuan</th>
                    <th class="text-end">Harga</th>
                    <th class="text-end">Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $totalQty = 0;
                $totalNominal = 0;
                foreach ($data as $d) :
                    $subtotal = $d->qtt_out * $d->harga;
                    $totalQty += $d->qtt_out;
                    $totalNominal += $subtotal;
                ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= date('d/m/Y', strtotime($d->tgl)) ?></td>
                        <td><?= $d->no_do ?></td>
                        <td><?= $d->customer ?></td>
                        <td><?= $d->nama_brg ?></td>
                        <td class="text-end"><?= number_format($d->qtt_out, 0, ',', '.') ?></td>
                        <td><?= $d->nama_satuan ?></td>
                        <td class="text-end"><?= number_format($d->harga, 0, ',', '.') ?></td>
                        <td class="text-end"><?= number_format($subtotal, 0, ',', '.') ?></td>
                    </tr>
                <?php endforeach; ?>
                <tr class="total-row">
                    <td colspan="5" class="text-end">Total</td>
                    <td class="text-end"><?= number_format($totalQty, 0, ',', '.') ?></td>
                    <td></td>
                    <td></td>
                    <td class="text-end"><?= number_format($totalNominal, 0, ',', '.') ?></td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>