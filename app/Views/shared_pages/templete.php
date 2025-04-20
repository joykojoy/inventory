<?= $this->include('shared_pages/header') ?>

<body>
    <div id="app">
        <?= $this->include('shared_pages/sidebar_menu') ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <?= $this->include('shared_pages/header_content') ?>
            <?= $this->renderSection('content') ?>
            <?= $this->include('shared_pages/footer_content') ?>
        </div>
    </div>
    <script src="/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/js/mazer.js"></script>
    <?= $this->include('shared_pages/myscript') ?>
</body>

</html>