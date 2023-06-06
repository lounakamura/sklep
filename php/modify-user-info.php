<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if ( !isset($_POST['first-name'], $_POST['last-name'], $_POST['username'], $_POST['email'], $_POST['phone']) ) {
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\user\account.php');
    } else if (!preg_match("/^[A-Za-zĄĘĆŻŹŁÓąęćżźłó]*$/", $_POST['first-name'])) {
        $_SESSION['message'] = 'Imię może składać się tylko z liter!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\user\account.php');
    } else if (!preg_match("/^[A-Za-zĄĘĆŻŹŁÓąęćżźłó]*$/", $_POST['last-name'])) {
        $_SESSION['message'] = 'Nazwisko może składać się tylko z liter!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\user\account.php');
    } else if (!preg_match("/^[a-zA-Z0-9ĄĘĆŻŹŁÓąęćżźłó\-\_\.]*$/", $_POST['username'])) {
        $_SESSION['message'] = 'Nazwa użytkownika może zawierać tylko litery, cyfry i znaki -_.!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\user\account.php');
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['message'] = 'Nieprawidłowy email!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\user\account.php');
    } else if (!preg_match("/^[0-9]*$/", $_POST['phone']) ) {
        $_SESSION['message'] = 'Nieprawidłowy numer telefonu!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\user\account.php');
    } else {
        $query = "SELECT uzytkownik_id FROM uzytkownik WHERE nazwa = '".$_POST['username']."'";
        $result = $connection->query($query);
        if ($result->num_rows > 0) {
            $foundUserId = $result->fetch_assoc()['uzytkownik_id'];
        }

        if ($result->num_rows > 0 && $foundUserId != $_SESSION['id']) {
            $_SESSION['message'] = 'Istnieje już konto o podanej nazwie użytkownika!';
            $_SESSION['message-type'] = 'error';
            header('Location: ..\user\account.php');
        } else {
            $query = "SELECT uzytkownik_id FROM uzytkownik WHERE email = '".$_POST['email']."'";
            $result = $connection->query($query);
            if ($result->num_rows > 0) {
                $foundUserId = $result->fetch_assoc()['uzytkownik_id'];
            }

            if ($result->num_rows > 0 && $foundUserId != $_SESSION['id']) {
                $_SESSION['message'] = 'Istnieje już konto o podanym emailu!';
                $_SESSION['message-type'] = 'error';
                header('Location: ..\user\account.php');
            } else {
                $query = "UPDATE uzytkownik SET imie = '".ucfirst($_POST['first-name'])."', nazwisko = '".ucfirst($_POST['last-name'])."', nazwa = '".$_POST['username']."', email = '".$_POST['email']."', numer_telefonu = '".$_POST['phone']."' WHERE uzytkownik_id=".$_SESSION['id'];
                $result = $connection->query($query);
                $_SESSION['message'] = 'Twoje dane zostały zmienione.';
                $_SESSION['message-type'] = 'success';
                header('Location: ..\user\account.php');
            }
        }
    }

    $connection->close();
?>