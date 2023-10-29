<?php
require_once './php/user.class.php';
require_once './php/session.class.php';
$user = Session::getUser();

if (!isset($_SESSION['secure'])) {
    $_SESSION['secure'] = true; // Initialize the secure session variable
}

if (isset($_GET['toggle'])) {
    if ($_GET['toggle'] == 'secure') {
        $_SESSION['secure'] = true; // Set secure session to true
    } elseif ($_GET['toggle'] == 'insecure') {
        $_SESSION['secure'] = false; // Set secure session to false
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Contact | Secure Website</title>
    <meta name="description" content="About author.">
    <meta name="keywords" content="HTML, CSS, PHP, JavaScript, jQuery, secure, website">
    <meta name="author" content="Ivan Šincek">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./img/favicon.ico">
    <link rel="stylesheet" href="./css/main.css" hreflang="en" type="text/css" media="all">
    <script src="./js/jquery.js"></script>
    <script src="./js/main.js" defer></script>
</head>

<body class="background-img">
    <!-- <?php require_once './components/navigation.php'; ?> -->
    <div class="about">
        <form action=""></form>
        <a href="selection.php">Secure</a>
        <a href="selection.php?toggle=insecure">In Secure</a>
    </div>
    <!-- <?php require_once './components/footer.php'; ?> -->
</body>

</html>