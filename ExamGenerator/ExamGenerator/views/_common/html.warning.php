<?php
if (isset($_SESSION['warning'])) {
    echo '<div class="alert alert-warning" role="alert">' . $_SESSION['warning'] . '</div>';
    unset($_SESSION['warning']);
}
?>