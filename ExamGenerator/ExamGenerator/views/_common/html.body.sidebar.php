<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="
        <?= URL_BASE . DS . 'home' ?>
    ">
        <div class="sidebar-brand-text">EXAMGenerator</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php if ($variables['user']['Role_idRole'] !== "3") { ?>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true"
                aria-controls="collapseOne">
                <i class="fas fa-fw fa-cog"></i>
                <span>Gestion de classes</span>
            </a>
            <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= URL_BASE . DS . 'mesEleves' ?>">Mes élèves</a>
                    <a class="collapse-item" href="<?= URL_BASE . DS . 'mesClasses' ?>">Mes classes</a>
                </div>
            </div>
        </li>

    <?php } ?>

    <?php if ($variables['user']['Role_idRole'] !== "3") { ?>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
                aria-controls="collapseTwo">
                <i class="fas fa-fw fa-cog"></i>
                <span>Gestion scolarité</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= URL_BASE . DS . 'cursus' ?>">Les cursus</a>
                    <a class="collapse-item" href="<?= URL_BASE . DS . 'niveaux' ?>">Les niveaux</a>
                    <a class="collapse-item" href="<?= URL_BASE . DS . 'matieres' ?>">Les matières</a>
                    <a class="collapse-item" href="<?= URL_BASE . DS . 'professeurs' ?>">Les professeurs</a>
                </div>
            </div>
        </li>

    <?php } ?>

    <?php if ($variables['user']['Role_idRole'] !== "0") { ?>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-cog"></i>
                <span>Mes Examens</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= URL_BASE . DS . 'examens' ?>">Examens</a>
                    <a class="collapse-item" href="<?= URL_BASE . DS . 'questions' ?>">Questions</a>
                    <a class="collapse-item" href="<?= URL_BASE . DS . 'sujets' ?>">Sujets</a>
                </div>
            </div>
        </li>

    <?php } ?>

    <?php if ($variables['user']['Role_idRole'] !== "2" &&   $variables['user']['Role_idRole'] !== "3" ) { ?>
        <!-- Configuration admin -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseConfig"
               aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Configuration</span>
            </a>
            <div id="collapseConfig" class="collapse" aria-labelledby="headingUtilities"
                 data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" href="<?= URL_BASE . DS . 'utilisateurs'?>">Utilisateurs</a>
                </div>
            </div>
        </li>
    <?php } ?>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <?php if ($variables['user']['Role_idRole'] !== "3") { ?>

        <!-- Nav Item - Import data -->
        <li class="nav-item">
            <a class="nav-link" href="<?= URL_BASE . DS . 'import_data' ?>">
                <i class="fas fa-fw fa-database"></i>
                <span>Importer des données</span></a>
        </li>

    <?php } ?>

    <?php if ($variables['user']['Role_idRole'] !== "3") { ?>

        <!-- Nav Item - Export data -->
        <li class="nav-item">
            <a class="nav-link" href="<?= URL_BASE . DS . 'export_data' ?>">
                <i class="fas fa-fw fa-database"></i>
                <span>Exporter des données</span></a>
        </li>

    <?php } ?>

    <hr class="sidebar-divider d-none d-md-block">

    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
</ul>
<!-- End of Sidebar -->