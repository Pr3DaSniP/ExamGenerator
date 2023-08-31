<!doctype html>
<html lang="fr" class="h-100">
<?php include_once VIEWS . DS . '_common' . DS . 'html.head.php'; ?>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <?php include_once VIEWS . DS . '_common' . DS . 'html.body.sidebar.php'; ?>
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <?php include_once VIEWS . DS . '_common' . DS . 'html.body.navbar.php'; ?>
                <!-- Begin page content -->
                <main class="flex-shrink-0">
                    <div class="container-fluid">
                        <?php include_once VIEWS . DS . '_common' . DS . 'html.errors.php' ?>
                        <?php include_once VIEWS . DS . '_common' . DS . 'html.warning.php' ?>
                        <?php include_once VIEWS . DS . '_common' . DS . 'html.success.php' ?>

                        <?= $contentfile; ?>
                    </div>
                </main>
            </div>
            <?php include_once VIEWS . DS . '_common' . DS . 'html.body.footer.php'; ?>
        </div>
    </div>



</body>
<?php include_once VIEWS . DS . '_common' . DS . 'html.body.logoutModal.php'; ?>
<?php include_once VIEWS . DS . '_common' . DS . 'html.body.js.php'; ?>

<script>
    jQuery(function () {
        if ($('#dataTable').length > 0)
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.21/i18n/French.json"
                }
            });
    })
</script>

</html>