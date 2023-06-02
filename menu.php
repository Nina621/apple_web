<?php
print '    
        <ul>
            <li><a href="index.php?menu=1"><img src="./imgs/logo.png"></a></li>
            <li><a href="index.php?menu=2">NEWS</a></li>
            <li><a href="index.php?menu=3">ABOUT</a></li>
            <li><a href="index.php?menu=4">ITUNES APPLE API</a></li>
            <li><a href="index.php?menu=5">CONTACT</a></li>';
if (!isset($_SESSION['user']['valid']) || $_SESSION['user']['valid'] == 'false') {
    print '
                <li><a href="index.php?menu=6">REGISTER</a></li>
                <li><a href="index.php?menu=7">SIGN IN </a></li>';
} else if ($_SESSION['user']['valid'] == 'true') {
    print '
                <li><a href="index.php?menu=8">ADMIN</a></li>
                <li><a href="signout.php">SIGN OUT</a></li>';
}
print '
        </ul> ';
?>