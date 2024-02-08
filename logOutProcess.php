<?php

session_start();

if (isset($_SESSION["u"])) {

    $_SESSION["u"] = null;
    session_destroy();
}

?>
<script>
    window.location = 'index.php'
</script>