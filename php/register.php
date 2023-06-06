<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if ( !isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['repeat-password']) ) {
        header('Location: ..\index.php');
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Podaj poprawny email!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\user\register.php');
    }

    if (!($_POST['password'] === $_POST['repeat-password'])) {
        $_SESSION['message'] = 'Podane przez ciebie hasła różnią się od siebie!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\user\register.php');
    }
    
    if ($query = $connection->prepare('SELECT uzytkownik_id, haslo FROM uzytkownik WHERE nazwa = ?')) {
        $query->bind_param('s', $_POST['username']);
        $query->execute();
        $query->store_result();
        if ($query->num_rows > 0) {
            $_SESSION['message'] = 'Istnieje już konto o podanej nazwie użytkownika!';
            $_SESSION['message-type'] = 'error';
            header('Location: ..\user\register.php');
        } else {
            if ($query = $connection->prepare('SELECT uzytkownik_id, haslo FROM uzytkownik WHERE email = ?')) {
                $query->bind_param('s', $_POST['email']);
                $query->execute();
                $query->store_result();
                if ($query->num_rows > 0) {
                    $_SESSION['message'] = 'Istnieje już konto o podanym emailu!';
                    $_SESSION['message-type'] = 'error';
                    header('Location: ..\user\register.php');
                } else {
                    if ($query = $connection->prepare('INSERT INTO uzytkownik (nazwa, email, haslo) VALUES (?, ?, ?)')) {
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $query->bind_param('sss', $_POST['username'], $_POST['email'], $password);
                        $query->execute();
                        $_SESSION['message'] = 'Twoje konto zostało utworzone! Możesz teraz się zalogować.';
                        $_SESSION['message-type'] = 'success';
                        header('Location: ..\user\login.php');
                    } else {
                        echo 'Could not prepare statement!';
                    }
                }
            } else {
                echo 'Could not prepare statement!';
            }
        }
    } else {
        echo 'Could not prepare statement!';
    }

    $connection->close();
?>