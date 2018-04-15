<?php

if ( isset( $_GET['lang'] ) ) {
    session_start();
    $_SESSION['lang'] = $_GET['lang'];
    // define ('WPLANG', $_SESSION[WPLANG]);
    echo '<script>window.location.replace("http://daniel.rdytech.se/tags/");</script>';
} else {
    echo '<script> alert("Error! No language chosen"); window.location.replace("http://daniel.rdytech.se/"); </script>';
}
?>
