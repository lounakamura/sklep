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
    
    if ($stmt = $connection->prepare('SELECT uzytkownik_id, haslo FROM uzytkownik WHERE nazwa = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $_SESSION['message'] = 'Istnieje już konto o podanej nazwie użytkownika!';
            $_SESSION['message-type'] = 'error';
            header('Location: ..\user\register.php');
        } else {
            if ($stmt = $connection->prepare('SELECT uzytkownik_id, haslo FROM uzytkownik WHERE email = ?')) {
                $stmt->bind_param('s', $_POST['email']);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $_SESSION['message'] = 'Istnieje już konto o podanym emailu!';
                    $_SESSION['message-type'] = 'error';
                    header('Location: ..\user\register.php');
                } else {
                    if ($stmt = $connection->prepare('INSERT INTO uzytkownik (nazwa, email, haslo) VALUES (?, ?, ?)')) {
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $stmt->bind_param('sss', $_POST['username'], $_POST['email'], $password);
                        $stmt->execute();
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