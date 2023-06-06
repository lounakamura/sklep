<div class='order-navigation'>
    <a class='nav' href='/sklep/cart.php'>
        <span class='order-icons'>
            <i class="fa-solid fa-cart-shopping fa-xl" style="color: #000000;"></i>
        </span>
        <span class='nav-text'>
            <span class='nav-name'>Koszyk</span>
            <span class='nav-desc'>Wartość koszyka: 
                <?php
                    $cartProducts = [];
                    
                    // Storing products in cart
                    $query = "SELECT koszyk_id, p.produkt_id, p.nazwa, p.cena, k.ilosc, CONCAT(z.sciezka, z.nazwa) AS zdjecie FROM koszyk AS k JOIN produkt as p USING (produkt_id) JOIN zdjecie AS z USING (produkt_id) WHERE ";
                    if(isset($_SESSION['loggedin'])) {
                        $query .= "uzytkownik_id=".$_SESSION['id'];
                    } else {
                        $query .= "sesja_id=".$_SESSION['session'];
                    }
                    $query .= " GROUP BY p.produkt_id";
                    $result = $connection->query($query);
                    fetchAllToArray($cartProducts, $result);
                    $result->free();

                    $productSum = 0;
                    foreach( $cartProducts as $cartProduct ) {
                        $productSum += $cartProduct['cena']*$cartProduct['ilosc'];
                    }

                    echo "<span>".number_format($productSum, 2, ',', '')." zł</span>";
                ?>
            </span>
        </span>
    </a>
    <a class='nav' href='/sklep/order/information.php'>
        <span class='order-icons'>
            <i class="fa-solid fa-file-lines fa-xl" style="color: #000000;"></i>
        </span>
        <span class='nav-text'>
            <span class='nav-name'>Twoje dane</span>
            <span class='nav-desc'>Podaj dane do wysyłki</span>
        </span>
    </a>
    <a class='nav' href='/sklep/order/shipping.php'>
        <span class='order-icons'>
            <i class="fa-solid fa-truck fa-xl" style="color: #000000;"></i>
        </span>
        <span class='nav-text'>
            <span class='nav-name'>Dostawa i płatność</span>
            <span class='nav-desc'>Wybierz sposób dostawy i płatności</span>
        </span>
    </a>
    <a class='nav' href='/sklep/order/check.php'>
        <span class='order-icons bubble-icon'>
            <i class="fa-solid fa-clipboard-check fa-xl" style="color: #000000;"></i>
        </span>
        <span class='nav-text'>
            <span class='nav-name'>Weryfikacja danych</span>
            <span class='nav-desc'>Sprawdź zamówienie przed jego złożeniem</span>
        </span>
    </a>
</div>