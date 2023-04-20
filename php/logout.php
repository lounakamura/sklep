<?php
    session_start();
    session_unset();
    $_SESSION = [];
    session_destroy();
    
    session_start();
    $_SESSION['message'] = 'Zostałeś wylogowany.';
    $_SESSION['message-type'] = 'info';
    header("Location: ..\index.php");
?>