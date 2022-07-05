<?php

session_start();
// if (isset($_POST['username']) && isset($_POST['password'])) {
//     // connexion bdd
//     $db_username = 'root';
//     $db_password = '';
//     $db_name = 'espionstudi';
//     $db_host = 'localhost';
//     $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
//         or die('impossible de se connecter à la BDD');

//sécurité pour attaque injection sql xss

$username = 'visiteur';
$password = '1234';

if ($username == 'visiteur' && $password == '1234') {
    $_SESSION['username'] = $username;
    header('Location : connexion.php');
} else {
    header('Location :login.php?erreur=1 && erreur=2');
}
// }
// mysqli_close($db);
