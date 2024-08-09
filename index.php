<?php require "includes/header.php"; ?>

<?php
// Redirect to login if the user is already not login
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
?>
hello <?= $_SESSION['username']; ?>
<?php require "includes/footer.php"; ?>
