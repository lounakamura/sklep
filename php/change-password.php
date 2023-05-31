<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if ( !isset($_POST['current-password'], $_POST['new-password'], $_POST['repeat-password']) ) {
        header('Location: ..\user\account.php');
    }

    

    if ($query = $connection->prepare('SELECT haslo FROM uzytkownik WHERE uzytkownik_id = ?')) {
        $query->bind_param('s', $_SESSION['id']);
        $query->execute();
        $query->store_result();
        $query->bind_result($password);
        $query->fetch();
        if (password_verify($_POST['current-password'], $password)) {
            if(!($_POST['new-password'] === $_POST['repeat-password'])){
                $_SESSION['message'] = 'Podane przez ciebie hasła różnią się od siebie!';
                $_SESSION['message-type'] = 'error';
                header('Location: ..\user\account.php');
            } else if ($stmt = $connection->prepare('UPDATE uzytkownik SET haslo = ? WHERE uzytkownik_id = ?')) {
                $password = password_hash($_POST['new-password'], PASSWORD_DEFAULT);
                $stmt->bind_param('ss', $password, $_SESSION['id']);
                $stmt->execute();
                $_SESSION['message'] = 'Hasło zostało zmienione';
                $_SESSION['message-type'] = 'success';
                header("Location: ..\user\account.php");
            }
        } else {
            $_SESSION['message'] = 'Nieprawidłowe hasło!';
            $_SESSION['message-type'] = 'error';
            header("Location: ..\user\account.php");
        }
    }

    $connection->close();
?>