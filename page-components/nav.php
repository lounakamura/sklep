<nav class="navigation-categories">
    <ul>
        <?php
            foreach ($maincategories as $maincategory) {
                $categories = [];
                $query = "SELECT * FROM kategoria_1 AS k1 WHERE k1.parent_id = " . $maincategory['kategoria_id'];
                $result = $connection->query($query);
                fetchAllToArray($categories, $result);
                $result->free();

                echo "<li class='category'>
                    <a class='uppercase' href='/sklep/products.php?maincategory=".$maincategory['kategoria_id']."' title='".$maincategory['kategoria']."'>".$maincategory['kategoria']."</a>";
                    echo "<section class='categories-bg off'>
                        <ul class='categories-main'>";
                            foreach($categories as $category){
                                $subcategories = [];
                                $query = "SELECT * FROM kategoria_2 WHERE kategoria_2.parent_id=" . $category['kategoria_id'];
                                $result = $connection->query($query);
                                fetchAllToArray($subcategories, $result);
                                $result->free();

                                echo "<li>
                                    <a class='subcategory uppercase' href='/sklep/products.php?category=".$category['kategoria_id']."' title='".$category['kategoria']."'>".$category['kategoria']."</a>";
                                    echo "<ul>";
                                        foreach ($subcategories as $subcategory) {
                                            echo "<li>
                                                <a class='subsubcategory' href='/sklep/products.php?subcategory=".$subcategory['kategoria_id']."' title='".$subcategory['kategoria']."'>".$subcategory['kategoria']."</a>";
                                            echo "</li>";
                                        }
                                    echo "</ul>";
                                echo "</li>";
                                unset( $subcategories );
                            }
                        echo "</ul>";
                    echo "</section>";
                echo "</li>";
                unset($categories);
            }
        ?>

        <li class="category">
            <a href="/sklep/brands.php" class="uppercase" title="Marki">Marki</a>
        </li>
    </ul>
</nav>