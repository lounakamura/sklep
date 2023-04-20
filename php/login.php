<?php
    session_start();

    require_once "config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if ( !isset($_POST['username'], $_POST['password']) ) {
        header('Location: ..\index.php');
    }

    if ($query = $connection->prepare('SELECT uzytkownik_id, email, haslo FROM uzytkownik WHERE nazwa = ?')) {
        $query->bind_param('s', $_POST['username']);
        $query->execute();
        $query->store_result();
        if ($query->num_rows>0) {
            $query->bind_result($account_id, $email, $password);
            $query->fetch();
            if (password_verify($_POST['password'], $password)) {
                $oldSession = $_SESSION['session'];
                session_regenerate_id();
                newSession($connection);

                $_SESSION['loggedin'] = TRUE;
                $_SESSION['username'] = $_POST['username'];
                $_SESSION['id'] = $account_id;

                // Keep products in cart if there were any
                $query = "SELECT koszyk_id FROM koszyk WHERE sesja_id=".$oldSession;
                $result = $connection->query($query);
                if($result->num_rows>0) {
                    $query = "UPDATE koszyk SET sesja_id=".$_SESSION['session'].", uzytkownik_id=".$_SESSION['id']." WHERE sesja_id=$oldSession";
                    $result = $connection->query($query);
                }

                // Check if user is an admin
                $query = "SELECT admin FROM uzytkownik WHERE uzytkownik_id=".$_SESSION['id'];
                $result = $connection->query($query);
                $result = mysqli_fetch_assoc($result);
                if($result['admin']) {
                    $_SESSION['isadmin'] = TRUE;
                }

                $_SESSION['message'] = 'Zostałeś poprawnie zalogowany!';
                $_SESSION['message-type'] = 'success';
                header("Location: ..\index.php");
            } else {
                $_SESSION['message'] = 'Nieprawidłowe hasło!';
                $_SESSION['message-type'] = 'error';
                header("Location: ..\user\login.php");
            }
        } else {
            $_SESSION['message'] = 'Konto o podanej nazwie nie istnieje!';
            $_SESSION['message-type'] = 'error';
            header("Location: ..\user\login.php");
        }
        $query->close();
    }

    $connection->close();
?>