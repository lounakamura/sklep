<?php
    session_start();

    require_once __DIR__."\php\config.php";

    $connection = new mysqli ($servername, $username, $password, $database);
    
    if (!isset($_SESSION['session'])) {
        newSession($connection);
    } else {
        checkIfSessionExists($connection);
    }
    
    if(!isset($_SESSION['isadmin'])) {
        header('Location: '.__DIR__.'\index.php');
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
    <link rel="icon" type="image/ico" href="/sklep/images/ui/logo-small.svg">
    <link rel="stylesheet" href="/sklep/css/main.css">
    <link rel="stylesheet" href="/sklep/css/admin.css">
    <script src="/sklep/js/jquery-3.6.1.min.js"></script>
</head>

<body>
    <?php 
        require_once __DIR__.'\..\..\page-components\header.html';
        require_once __DIR__.'\..\..\page-components\nav.php'; 
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
                        <label for="category">Kategoria główna</label>
                        <select name="category" id="category">
                            <?php
                                foreach($maincategories as $maincategory){
                                    echo "<option value='".$maincategory['kategoria_id']."'>".$maincategory['kategoria']."</option>";
                                }
                            ?>
                        </select>

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

                        <label for="name">Nazwa</label>
                        <input type="text" name="name" id="name" required maxlength="128">

                        <label for="price">Cena</label>
                        <input type="number" name="price" id="price" required min="0.00" max="10000.00" step="0.01">

                        <label for="description">Opis</label>
                        <textarea name="description" id="description" required></textarea>

                        <label>Marka</label>
                        <select name="brand">
                            <?php
                                foreach($brands as $brand){
                                    echo "<option value='".$brand['marka_id']."'>".$brand['marka']."</option>";
                                }
                            ?>
                        </select>

                        <label for="amount">Ilość</label>
                        <input type="number" name="amount" id="amount" required min="0" max="999" step="1" value="999">

                        <label for="images">Zdjęcia</label>
                        <input name="upload[]" type="file" multiple="multiple" id="images">

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
                        <label>Wybierz produkt z listy</label>
                        <select name="product">
                            <?php
                                foreach ($productNames as $product) {
                                    echo "<option value='".$product['produkt_id']."'>".$product['nazwa']."</option>";
                                }
                            ?>
                        </select>
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
                        <label>Wybierz produkt z listy</label>
                        <select name="product">
                            <?php
                                foreach ($productNames as $product) {
                                    echo "<option value='".$product['produkt_id']."'>".$product['nazwa']."</option>";
                                }
                            ?>
                        </select>
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
                        <label>Wybierz produkt z listy</label>
                        <select name="product">
                            <?php
                                foreach ($productNames as $product) {
                                    echo "<option value='".$product['produkt_id']."'>".$product['nazwa']."</option>";
                                }
                            ?>
                        </select>
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
                        <label for='maincategory-name'>Nazwa</label>
                        <input type='text' name='maincategory' id='maincategory-name' required maxlength='25'>
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
                        <label>Kategoria nadrzędna</label>
                        <select name="parent-category">
                            <?php
                                foreach($maincategories as $maincategory){
                                    echo "<option value='".$maincategory['kategoria_id']."'>".$maincategory['kategoria']."</option>";
                                }
                            ?>
                        </select>
                        <label for='category-name'>Nazwa</label>
                        <input type='text' name='category' id='category-name' required maxlength='32'>
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
                        <label>Kategoria nadrzędna</label>
                        <select name="parent-category">
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
                        <label for='subcategory-name'>Nazwa</label>
                        <input type='text' name='subcategory' id='subcategory-name' required maxlength='32'>
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
                        <label>Wybierz kategorię główną</label>
                        <select name="maincategory">
                            <?php
                                foreach($maincategories as $maincategory){
                                    echo "<option value='".$maincategory['kategoria_id']."'>".$maincategory['kategoria']."</option>";
                                }
                            ?>
                        </select>
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
                        <label>Wybierz podkategorię</label>
                        <select name="category">
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
                        <label>Wybierz kategorię produktów</label>
                        <select name="subcategory">
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
                        <label for='brand-name'>Nazwa</label>
                        <input type='text' name='brand' id='brand-name' required maxlength='32'>
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
                        <label>Wybierz markę</label>
                        <select name="brand">
                            <?php
                                foreach($brands as $brand){
                                    echo "<option value='".$brand['marka_id']."'>".$brand['marka']."</option>";
                                }
                            ?>
                        </select>
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

    <script src="/sklep/js/misc.js"></script>
    <script src="/sklep/js/scrollToTop.js"></script>
    <script src="/sklep/js/menuHandler.js"></script>
    <script src="/sklep/js/cartPreview.js"></script>
    <script src="/sklep/js/addToCart.js"></script>
    <script src="/sklep/js/removeFromCart.js"></script>
    <script src="/sklep/js/accountPreview.js"></script>

    <script src="/sklep/admin/js/addProduct-CategoryDisplay.js"></script>
</body>
</html>

<?php
    $connection->close();
?>