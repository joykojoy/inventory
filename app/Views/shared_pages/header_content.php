<div class="page-heading">
    <div class="page-title">
        <div class="row">
            <div class="col-12 col-md-6 order-md-1 order-last">
                <h3><?= ($nama_submenu) ? $nama_submenu : $nama_menu ?></h3>
                <p class="text-subtitle text-muted">Halaman <?= $nama_menu ?></p>
            </div>
            <div class="col-12 col-md-6 order-md-2 order-first">
                <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.html"><?= $nama_menu ?></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><?= ($nama_submenu) ? $nama_submenu : '' ?></li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>