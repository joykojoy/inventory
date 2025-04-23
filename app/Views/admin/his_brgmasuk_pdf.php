<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kelola Stock Gudang</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@300&display=swap" rel="stylesheet">
    <style>
        @media print {

            button.btn.btn-sm.btn-danger {
                display: none;
            }
        }
    </style>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/assets/css/app.css">
</head>

<body>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col"></div>
                <div class="col text-end">
                    <button class="btn btn-sm btn-danger justify-content-end" onclick="window.print()">
                        <i class=" bi bi-printer me-2"></i>Print
                    </button>
                </div>
            </div>
            <div class="row text-center">
                <h5 class="card-title">History Stock Barang Masuk</h5>
            </div>
        </div>
        <div class="card-body fs-6">
            <table class="table table-light mt-3">
                <thead>
                    <tr>
                        <td>No</td>
                        <td>Tanggal</td>
                        <td>Nama Barang</td>
                        <td class="text-end">Quantity In</td>
                        <td>Satuan</td>
                        <td class="text-end">Harga</td>
                        <td class="text-end">Total Harga</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $totalQty = 0;
                    $grandTotal = 0;
                    foreach ($data as $d) : 
                        $totalHarga = $d->qtt_in * $d->harga;
                        $totalQty += $d->qtt_in;
                        $grandTotal += $totalHarga;
                    ?>
                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $d->tgl ?></td>
                            <td><?= $d->nama_brg ?></td>
                            <td class="text-end"><?= number_format($d->qtt_in, 0, ',', '.') ?></td>
                            <td><?= $d->nama_satuan ?></td>
                            <td class="text-end">Rp <?= number_format($d->harga, 0, ',', '.') ?></td>
                            <td class="text-end">Rp <?= number_format($totalHarga, 0, ',', '.') ?></td>
                        </tr>
                    <?php endforeach ?>
                    <tr class="fw-bold">
                        <td colspan="3" class="text-end">Total:</td>
                        <td class="text-end"><?= number_format($totalQty, 0, ',', '.') ?></td>
                        <td colspan="2" class="text-end">Total Nilai:</td>
                        <td class="text-end">Rp <?= number_format($grandTotal, 0, ',', '.') ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>