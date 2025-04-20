<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo mt-3 ml-2">
                    <a href="<?= base_url() ?>">Gudang</a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Menu</li>
                <!-- Dashboard Menu -->
                <li class="sidebar-item <?= ($nama_menu == 'Dashboard') ? 'active' : '' ?>">
                    <a href="<?= base_url('admin/dashboard') ?>" class='sidebar-link'>
                        <i class="bi bi-speedometer2 text-primary"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                
                <!-- Dynamic Menus -->
                <?php if (!empty($dtmenu)) : ?>
                    <?php foreach ($dtmenu as $menuGroup) : ?>
                        <?php foreach ($menuGroup as $menu) : ?>
                            <li class="sidebar-item <?= ($menu->submenu == 1) ? 'has-sub' : '' ?> <?= ($nama_menu == $menu->nama) ? 'active' : '' ?>">
                                <a href="<?= $menu->submenu == 1 ? '#' : base_url($menu->url) ?>" class="sidebar-link">
                                    <i class="<?= esc($menu->icon) ?> text-primary"></i>
                                    <span><?= esc($menu->nama) ?></span>
                                </a>
                                
                                <!-- Submenu Items -->
                                <?php if ($menu->submenu == '1' && isset($dtsubmenu[$menu->id])) : ?>
                                    <ul class="submenu <?= ($nama_menu == $menu->nama) ? 'active' : '' ?>">
                                        <?php foreach ($dtsubmenu[$menu->id] as $submenu) : ?>
                                            <li class="submenu-item <?= ($nama_submenu == $submenu->nama) ? 'active' : '' ?>">
                                                <a href="<?= base_url($submenu->url) ?>">
                                                    <i class="bi bi-circle-fill text-warning"></i>
                                                    <?= esc($submenu->nama) ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                <?php endif; ?>
                            </li>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>

                <!-- User Menu Section -->
                <li class="sidebar-title">User Menu</li>
                <li class="sidebar-item">
                    <a href="<?= base_url('user/profile') ?>" class="sidebar-link">
                        <i class="bi bi-person-circle text-primary"></i>
                        <span>Profile</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="<?= base_url('user/rpassword') ?>" class="sidebar-link">
                        <i class="bi bi-key text-primary"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link" id="logout-link">
                        <i class="bi bi-box-arrow-right text-primary"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>

<script>
document.getElementById('logout-link').addEventListener('click', function(e) {
    e.preventDefault();
    Swal.fire({
        title: 'Konfirmasi Logout',
        text: "Apakah anda yakin ingin keluar?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: '#435ebe',
        cancelButtonColor: '#dc3545',
        confirmButtonText: 'Ya, Logout',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '<?= base_url("user/login/logout") ?>';
        }
    });
});
</script>