<?php
    session_start();

    require_once __DIR__."\..\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if(!isset($_SESSION['isadmin'])) {
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\..\index.php');
    } else if(empty($_FILES['upload']['name'][0])){
        $_SESSION['message'] = 'Wystąpił błąd!';
        $_SESSION['message-type'] = 'error';
        header('Location: ..\admin.php');
    } else {
        $fileAmount = count($_FILES['upload']['name']);

        $uploadedPics = 0;
        // Loop through each file
        for($i=0; $i<$fileAmount; $i++) {
            $extension = pathinfo($_FILES['upload']['name'][$i], PATHINFO_EXTENSION);
            $name = $_POST['product']."_".time()."".rand(1, 100).".".$extension;
            
            $parent_dir = dirname(__DIR__, 3);
            $target_dir = "/sklep/images/product-images/".$_POST['product']."/";
            $absolute_path = $parent_dir.$target_dir;
            $target_file = $absolute_path.$name;
            
            $validExtensions = array("jpg", "jpeg", "png", "webp");
            
            if(in_array($extension, $validExtensions)){
                // Check if directory exists, if not, create it
                if(!is_dir($absolute_path)) {
                    mkdir($absolute_path, 0777, true);
                }
                if(move_uploaded_file($_FILES['upload']['tmp_name'][$i], $target_file)){
                    $query = "INSERT INTO zdjecie (sciezka, nazwa, produkt_id) VALUES ('$target_dir', '$name', ".$_POST['product'].")";
                    $result = $connection->query($query);
                    if($result){
                        $uploadedPics++;
                    }
                }
            }
        }

        $_SESSION['message'] = 'Poprawnie dodanych zdjęć: '.$uploadedPics;
        $_SESSION['message-type'] = 'success';

        header('Location: ..\admin.php');
    }

    $connection->close();
?>