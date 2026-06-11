<aside class="main-sidebar sidebar-dark-primary elevation-4">


    <a href="<?= base_url('/') ?>" class="brand-link">
        <span class="brand-text font-weight-light ml-3">Library Information System</span>
    </a>


    <div class="sidebar">
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview">


                <li class="nav-item">
                    <a href="<?= base_url('/dashboard') ?>" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('/list/books') ?>" class="nav-link">
                        <i class="nav-icon fas fa-book"></i>
                        <p>Master Buku</p>
                    </a>
                </li>


                <li class="nav-item">
                    <a href="<?= base_url('/list/users') ?>" class="nav-link">
                        <i class="nav-icon fas fa-users"></i>
                        <p>Master Member</p>
                    </a>
                </li>


            </ul>
        </nav>
    </div>
</aside>
