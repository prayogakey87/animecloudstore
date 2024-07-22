<?php
session_start();

if (!isset($_SESSION['admin_email'])) {
    $_SESSION['admin_email'] = 'unset';
} else if ($_SESSION['admin_email'] === 'unset') {
} else {
    $_SESSION['admin_email'];
}
?>
