<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if ( !isset($_POST['email'], $_POST['username'], $_POST['password'], $_POST['repeat-password']) ) {
        header('Location: '.__DIR__.'\..\index.php');
    }

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        exit('Email is not valid!');
    }

    if (!($_POST['password'] === $_POST['repeat-password'])) {
        exit('Passwords don\'t match!');
    }
    
    if ($stmt = $connection->prepare('SELECT uzytkownik_id, haslo FROM uzytkownik WHERE nazwa = ?')) {
        $stmt->bind_param('s', $_POST['username']);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            echo 'Istnieje już konto o podanej nazwie uzytkownika';
        } else {
            if ($stmt = $connection->prepare('SELECT uzytkownik_id, haslo FROM uzytkownik WHERE email = ?')) {
                $stmt->bind_param('s', $_POST['email']);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    echo 'Istnieje już konto o podanym emailu';
                } else {
                    if ($stmt = $connection->prepare('INSERT INTO uzytkownik (nazwa, email, haslo) VALUES (?, ?, ?)')) {
                        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                        $stmt->bind_param('sss', $_POST['username'], $_POST['email'], $password);
                        $stmt->execute();
                        echo 'You have successfully registered! You can now login!';
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