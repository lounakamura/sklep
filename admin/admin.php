<?php
    session_start();

    require_once __DIR__."\..\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }
    
    if(!isset($_SESSION['isadmin'])) {
        header('Location: ..\index.php');
    }

    require_once __DIR__.'\..\page-components\required.php';

    $brands = [];
    $productNames = [];

    // Storing brands
    $query = "SELECT * FROM marka ORDER BY marka ASC";
    $result = $connection->query($query);
    fetchAllToArray($brands, $result);
    $result->free();

    // Storing product names with ids
    $query = "SELECT produkt_id, nazwa FROM produkt";
    $result = $connection->query($query);
    fetchAllToArray($productNames, $result);
    $result->free();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Drogeria internetowa Kosmetykowo.pl</title>
    <?php
        require_once __DIR__.'\..\page-components\head.html';
    ?>
    <link rel="stylesheet" href="/sklep/css/admin.css">
</head>

<body>
    <?php 
        require_once __DIR__.'\..\page-components\header.html';
        require_once __DIR__.'\..\page-components\nav.php'; 
    ?>

    <main>
        <h1>Panel administratora</h1>

        <h2>Produkt</h2>
        <div class="container">
            <label for='state1'>
                <div class='accordion'>Dodaj nowy produkt</div>
            </label>
            <input type='checkbox' id='state1' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/add-product.php" enctype='multipart/form-data'>
                        <div>
                            <label for="category">Kategoria główna</label>
                            <select name="category" id="category">
                                <?php
                                    foreach($maincategories as $maincategory){
                                        echo "<option value='".$maincategory['kategoria_id']."'>".$maincategory['kategoria']."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div>
                            <label for="category1">Podkategoria</label>
                            <select name="category1" id="category1">
                                <?php
                                    foreach($maincategories as $maincategory){
                                        $categories = [];
                                        $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = ".$maincategory['kategoria_id']." ORDER BY kategoria ASC";
                                        $result = $connection->query($query);
                                        fetchAllToArray( $categories, $result );
                                        $result->free();

                                        foreach($categories as $category){
                                            echo "<option value='".$category['kategoria_id']."' data-parent='".$maincategory['kategoria_id']."'>".$category['kategoria']."</option>";
                                        }
                                        unset( $categories );
                                    }
                                ?>
                            </select>
                        </div>

                        <div>
                            <label for="category2">Kategoria produktu</label>
                            <select name="category2" id="category2">
                                <?php
                                    foreach($maincategories as $maincategory){
                                        $categories = [];
                                        $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = ".$maincategory['kategoria_id']." ORDER BY kategoria ASC";
                                        $result = $connection->query($query);
                                        fetchAllToArray( $categories, $result );
                                        $result->free();

                                        foreach($categories as $category){
                                            $subcategories = [];
                                            $query = "SELECT * FROM kategoria_2 AS k2 WHERE k2.parent_id = ".$category['kategoria_id']." ORDER BY kategoria ASC";
                                            $result = $connection->query($query);
                                            fetchAllToArray( $subcategories, $result );
                                            $result->free();

                                            foreach($subcategories as $subcategory){
                                                echo "<option value='".$subcategory['kategoria_id']."' data-parent='".$category['kategoria_id']."'>".$subcategory['kategoria']."</option>";
                                            }
                                            unset($subcategories);
                                        }
                                        unset($categories);
                                    }
                                ?>
                            </select>
                        </div>

                        <div>
                            <label for="name">Nazwa</label>
                            <input type="text" name="name" id="name" required maxlength="128">
                        </div>

                        <div>
                            <label for="price">Cena</label>
                            <input type="number" name="price" id="price" required min="0.00" max="10000.00" step="0.01">
                        </div>

                        <div>
                            <label for="description">Opis</label>
                            <textarea name="description" id="description" required></textarea>
                        </div>

                        <div>
                            <label>Marka</label>
                            <select name="brand" class="admin-select2">
                                <?php
                                    foreach($brands as $brand){
                                        echo "<option value='".$brand['marka_id']."'>".$brand['marka']."</option>";
                                    }
                                ?>
                            </select>
                        </div>

                        <div>
                            <label for="amount">Ilość</label>
                            <input type="number" name="amount" id="amount" required min="0" max="999" step="1" value="999">
                        </div>

                        <div>
                            <label for="images">Zdjęcia</label>
                            <input name="upload[]" type="file" multiple="multiple" id="images">
                        </div>

                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state2'>
                <div class='accordion'>Dodaj zdjęcia do istniejącego produktu</div>
            </label>
            <input type='checkbox' id='state2' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/upload-images.php" enctype='multipart/form-data'>
                        <div>
                            <label>Wybierz produkt z listy</label>
                            <select name="product" class="admin-select2">
                                <?php
                                    foreach ($productNames as $product) {
                                        echo "<option value='".$product['produkt_id']."'>".$product['nazwa']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <input name="upload[]" type="file" multiple="multiple" />
                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state3'>
                <div class='accordion'>Usuń produkt</div>
            </label>
            <input type='checkbox' id='state3' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/remove-product.php">
                        <div>
                            <label>Wybierz produkt z listy</label>
                            <select name="product" class="admin-select2">
                                <?php
                                    foreach ($productNames as $product) {
                                        echo "<option value='".$product['produkt_id']."'>".$product['nazwa']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="pink-button">Usuń</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state4'>
                <div class='accordion'>Zmodyfikuj produkt</div>
            </label>
            <input type='checkbox' id='state4' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/modify-product.php">
                        <div>
                            <label>Wybierz produkt z listy</label>
                            <select name="product" class="admin-select2">
                                <?php
                                    foreach ($productNames as $product) {
                                        echo "<option value='".$product['produkt_id']."'>".$product['nazwa']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="pink-button">Modyfikuj</button>
                    </form>
                </div>
            </div>
        </div>

        <h2>Kategoria</h2>

        <div class="container">
            <label for='state5'>
                <div class='accordion'>Dodaj nową kategorię główną</div>
            </label>
            <input type='checkbox' id='state5' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/add-maincategory.php">
                        <div>
                            <label for='maincategory-name'>Nazwa</label>
                            <input type='text' name='maincategory' id='maincategory-name' required maxlength='25'>
                        </div>
                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state6'>
                <div class='accordion'>Dodaj nową podkategorię</div>
            </label>
            <input type='checkbox' id='state6' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/add-category.php">
                        <div>
                            <label>Kategoria nadrzędna</label>
                            <select name="parent-category" class="admin-select2">
                                <?php
                                    foreach($maincategories as $maincategory){
                                        echo "<option value='".$maincategory['kategoria_id']."'>".$maincategory['kategoria']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for='category-name'>Nazwa</label>
                            <input type='text' name='category' id='category-name' required maxlength='32'>
                        </div>
                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state7'>
                <div class='accordion'>Dodaj nową kategorię produktów</div>
            </label>
            <input type='checkbox' id='state7' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/add-subcategory.php">
                        <div>
                            <label>Kategoria nadrzędna</label>
                            <select name="parent-category" class="admin-select2">
                                <?php
                                    foreach($maincategories as $maincategory){
                                        $categories = [];
                                        $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = ".$maincategory['kategoria_id']." ORDER BY kategoria ASC";
                                        $result = $connection->query($query);
                                        fetchAllToArray( $categories, $result );
                                        $result->free();

                                        foreach($categories as $category){
                                            echo "<option value='".$category['kategoria_id']."' data-parent='".$maincategory['kategoria_id']."'>".$category['kategoria']."</option>";
                                        }
                                        unset( $categories );
                                    }
                                ?>
                            </select>
                        </div>
                        <div>
                            <label for='subcategory-name'>Nazwa</label>
                            <input type='text' name='subcategory' id='subcategory-name' required maxlength='32'>
                        </div>
                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state8'>
                <div class='accordion'>Usuń kategorię główną</div>
            </label>
            <input type='checkbox' id='state8' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/remove-maincategory.php">
                        <div>
                            <label>Wybierz kategorię główną</label>
                            <select name="maincategory" class="admin-select2">
                                <?php
                                    foreach($maincategories as $maincategory){
                                        echo "<option value='".$maincategory['kategoria_id']."'>".$maincategory['kategoria']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="pink-button">Usuń</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state9'>
                <div class='accordion'>Usuń podkategorię</div>
            </label>
            <input type='checkbox' id='state9' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/remove-category.php">
                        <div>
                            <label>Wybierz podkategorię</label>
                            <select name="category" class="admin-select2">
                                <?php
                                foreach($maincategories as $maincategory){
                                    $categories = [];
                                    $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = ".$maincategory['kategoria_id']." ORDER BY kategoria ASC";
                                    $result = $connection->query($query);
                                    fetchAllToArray( $categories, $result );
                                    $result->free();

                                    foreach($categories as $category){
                                        echo "<option value='".$category['kategoria_id']."' data-parent='".$maincategory['kategoria_id']."'>".$category['kategoria']."</option>";
                                    }
                                    unset( $categories );
                                }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="pink-button">Usuń</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state10'>
                <div class='accordion'>Usuń kategorię produktów</div>
            </label>
            <input type='checkbox' id='state10' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/remove-subcategory.php">
                        <div>
                        <label>Wybierz kategorię produktów</label>
                            <select name="subcategory" class="admin-select2">
                                <?php
                                    foreach($maincategories as $maincategory){
                                        $categories = [];
                                        $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = ".$maincategory['kategoria_id']." ORDER BY kategoria ASC";
                                        $result = $connection->query($query);
                                        fetchAllToArray( $categories, $result );
                                        $result->free();

                                        foreach($categories as $category){
                                            $subcategories = [];
                                            $query = "SELECT * FROM kategoria_2 AS k2 WHERE k2.parent_id = ".$category['kategoria_id']." ORDER BY kategoria ASC";
                                            $result = $connection->query($query);
                                            fetchAllToArray( $subcategories, $result );
                                            $result->free();

                                            foreach($subcategories as $subcategory){
                                                echo "<option value='".$subcategory['kategoria_id']."' data-parent='".$category['kategoria_id']."'>".$subcategory['kategoria']."</option>";
                                            }
                                            unset($subcategories);
                                        }
                                        unset($categories);
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="pink-button">Usuń</button>
                    </form>
                </div>
            </div>
        </div>

        <h2>Marka</h2>

        <div class="container">
            <label for='state11'>
                <div class='accordion'>Dodaj nową markę</div>
            </label>
            <input type='checkbox' id='state11' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/add-brand.php">
                        <div>
                            <label for='brand-name'>Nazwa</label>
                            <input type='text' name='brand' id='brand-name' required maxlength='32'>
                        </div>
                        <button type="submit" class="pink-button">Dodaj</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="container">
            <label for='state12'>
                <div class='accordion'>Usuń markę</div>
            </label>
            <input type='checkbox' id='state12' class='state' hidden>
            <div class='accordion-content'>
                <div class='accordion-inner'>
                    <form method="POST" action="/sklep/admin/php/remove-brand.php">
                        <div>
                            <label>Wybierz markę</label>
                            <select name="brand" class="admin-select2">
                                <?php
                                    foreach($brands as $brand){
                                        echo "<option value='".$brand['marka_id']."'>".$brand['marka']."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                        <button type="submit" class="pink-button">Usuń</button>
                    </form>
                </div>
            </div>
        </div>

    </main>

    <?php 
        require_once __DIR__.'\..\page-components\newsletter.html';
        require_once __DIR__.'\..\page-components\social-media.html'; 
        require_once __DIR__.'\..\page-components\footer.html';
        require_once __DIR__.'\..\page-components\extras.html';
    ?>
</body>
</html>

<?php 
    require_once __DIR__.'\..\page-components\scripts.html';
?>

<script src="/sklep/admin/js/addProduct-CategoryDisplay.js"></script>

<?php
    $connection->close();
?>