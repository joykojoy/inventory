<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Stock Barang</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .card {
            margin: 20px;
        }

        .card-header {
            margin-bottom: 20px;
        }

        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: right;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
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
        <div class="card-header">
            <button class="print-btn" onclick="window.print()">
                Print
            </button>
            <div class="text-center">
                <h3>History Stock Barang</h3>
                <p>Periode: <?= $tglAwal ?> s/d <?= $tglAkhir ?></p>
            </div>
        </div>
        <div class="card-body">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nama Barang</th>
                        <th class="text-end">Quantity In</th>
                        <th class="text-end">Quantity Out</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($data as $d) : ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= date('d/m/Y', strtotime($d->tgl)) ?></td>
                            <td><?= $d->nama_brg ?></td>
                            <td class="text-end"><?= number_format($d->qtt_in, 0, ',', '.') ?></td>
                            <td class="text-end"><?= number_format($d->qtt_out, 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>