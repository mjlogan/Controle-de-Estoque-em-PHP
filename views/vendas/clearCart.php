<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

unset($_SESSION['itens']);

// if(isset($_SESSION['itens'])){
//     foreach ($_SESSION['itens'] as $produtos => $information) {
//         unset($_SESSION['itens'][$produtos]);
//     }
// }
header('Location: ./');
?>