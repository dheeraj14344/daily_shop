<?php 
    require('connection.inc.php'); 
    require('functions.inc.php');

    if(isset($_SESSION['USER_LOGIN'])){
        unset($_SESSION['USER_LOGIN']);
        unset($_SESSION['ID']);
        unset($_SESSION['USER_NAME']);
    }
?>
<script>
    window.location.href='index.php';
</script>