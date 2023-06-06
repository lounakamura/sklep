<?php
    if(isset($_SESSION['message']) && isset($_SESSION['message-type'])){
        echo "<script>spop('".$_SESSION['message']."', '".$_SESSION['message-type']."');</script>";
        unset($_SESSION["message"]);
        unset($_SESSION["message-type"]);
    }
?>