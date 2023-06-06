<?php
    session_start();

    require_once __DIR__."\..\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);

    if(!isset($_SESSION['isadmin'])) {
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: '.__DIR__.'\..\..\index.php');
    } else if (!isset($_POST['category'], $_POST['category1'], $_POST['category2'], $_POST['name'], $_POST['price'], $_POST['description'], $_POST['brand'], $_POST['amount'])) {
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\admin.php');
    } else {
        $productId = [];

        $query = "INSERT INTO produkt (kategoria_id, nazwa, cena, opis, marka_id, ilosc) VALUES (".$_POST['category2'].", '".$_POST['name']."', ".$_POST['price'].", '".$_POST['description']."', ".$_POST['brand'].", ".$_POST['amount'].")";
        $result = $connection->query($query);

        $query = "SELECT produkt_id FROM produkt WHERE nazwa='".$_POST['name']."'";
        $result = $connection->query($query);
        $productId = $result->fetch_assoc();
        $result->free();

        $fileAmount = count($_FILES['upload']['name']);

        // Loop through each file
        for($i=0; $i<$fileAmount; $i++) {
            $extension = pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);
            $name = $productId['produkt_id']."_".time()."".rand(1, 100).".".$extension;
            
            $parent_dir = dirname(__DIR__, 3);
            $target_dir = "/sklep/images/product-images/".$productId['produkt_id']."/";
            $absolute_path = $parent_dir.$target_dir;
            $target_file = $absolute_path.$name;
            
            $validExtensions = array("jpg", "jpeg", "png", "webp");
            
            if(in_array($extension, $validExtensions)){
                // Check if directory exists, if not, create it
                if(!is_dir($absolute_path)) {
                    mkdir($absolute_path, 0777, true);
                }

                if(move_uploaded_file($_FILES['upload']['tmp_name'][$i], $target_file)){
                    $query = "INSERT INTO zdjecie (sciezka, nazwa, produkt_id) VALUES ('$target_dir', '$name', ".$productId['produkt_id'].")";
                    $result = $connection->query($query);
                }
            }
        }

        $_SESSION['message'] = 'Produkt został dodany!';
        $_SESSION['message-type'] = 'success';
        header('Location: ..\admin.php');
    }

    $connection->close();
?>