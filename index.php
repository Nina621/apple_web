<?php
# Stop Hacking attempt
define('__APP__', TRUE);

# Start session
session_start();

#functions
include("functions.php");

# Database connection
include("dbconn.php");

# Variables MUST BE INTEGERS
if (isset($_GET['menu'])) {
    $menu = (int) $_GET['menu'];
}
if (isset($_GET['action'])) {
    $action = (int) $_GET['action'];
}

# Variables MUST BE STRINGS A-Z
if (!isset($_POST['_action_'])) {
    $_POST['_action_'] = FALSE;
}

if (!isset($menu)) {
    $menu = 1;
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <meta http-equiv="content-type" content="text/html; charset=utf-8">
    <meta name="description"
        content="This is app about Apple, is an American multinational technology company headquartered in California. This app is made just for personal use.">
    <meta name="keywords" content="apple, apple_crud_app, apple news">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;700&display=swap" rel="stylesheet">

    <title>Napredno WEB programiranje</title>
</head>

<body>
    <header>
        <div class="nav-container">
            <?php include("menu.php") ?>
        </div>
    </header>
    <main>
        <?php
        if (isset($_SESSION['message'])) {
            print $_SESSION['message'];
            unset($_SESSION['message']);
        }

        # Dashboard
        if (!isset($menu) || $menu == 1) {
            include("home.php");
        }

        # News
        else if ($menu == 2) {
            include("news.php");
        }

        # About
        else if ($menu == 3) {
            include("about.php");
        }

        # itunes Apple API
        else if ($menu == 4) {
            include("itunesAppleApi.php");
        }

        # Contact
        else if ($menu == 5) {
            include("contact.php");
        }

        # Register
        else if ($menu == 6) {
            include("register.php");
        }

        # Signin
        else if ($menu == 7) {
            include("signin.php");
        }

        # Admin webpage
        else if ($menu == 8) {
            include("admin.php");
        }
        ?>


    </main>
    <footer class="navbar fixed-bottom">
        <div class="container-fluid">
            <div class="footer-link">
                <?php
                echo "<p>Copyright - 2023" . " -  <a target='_blank' href='https://github.com/Nina621' >Nikolina Marinić</a> &copy;</p>";
                ?>
            </div>
        </div>
    </footer>
</body>

</html>