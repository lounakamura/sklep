<?php
    session_start();
    session_unset();
    $_SESSION = [];
    session_destroy();
    
    header("Location: '.__DIR__.'\..\index.php");
?>