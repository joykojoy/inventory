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
                <h5 class="card-title">Ready Stock Barang</h5>
            </div>
        </div>
        <div class="card-body fs-6">
            <?= $this->include('tabel/pstockpdf') ?>
        </div>
    </div>
</body>

</html>