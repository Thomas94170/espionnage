<?php

session_start();
if (isset($_POST['username']) && isset($_POST['password'])) {
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["eu-cdbr-west-03.cleardb.net"];
    $cleardb_username = $cleardb_url["b993bfa7bc6b92"];
    $cleardb_password = $cleardb_url["e2103544"];
    $cleardb_db = substr($cleardb_url["heroku_94efd7f137d0ee9"], 1);
    $active_group = 'default';
    $query_builder = TRUE;
    // Connect to DB
    $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db)
        or die('pas de connexion!');
    // $db_username = 'root';
    // $db_password = '';
    // $db_name = 'espionstudi';
    // $db_host = 'localhost';
    // $db = mysqli_connect($db_host, $db_username, $db_password, $db_name)
    // or die('pas de connexion!');

    //mysql_real_escape_string, htmlspecialchars contrer attaque sql xss
    $username = mysqli_real_escape_string($conn, htmlspecialchars($_POST['username']));
    $password = mysqli_real_escape_string($conn, htmlspecialchars($_POST['password']));
    // 23 24 28 j ai remplacé $db par $conn
    if ($username !== '' && $password !== '') {
        $req = "SELECT count(*) FROM admin where name = '" . $username . "' and password= '" . $password . "' ";
        $exec_requete = mysqli_query($conn, $req);
        $reponse = mysqli_fetch_array($exec_requete);
        $count = $reponse['count(*)'];
        if ($count != 0) {
            $_SESSION['username'] = $username;
            header('Location: indexAdmin.php');
        } else {
            header('Location : login.php?erreur=1');
        }
    } else {
        header('Location: login.php?erreur=2');
    }
} else {
    header('Location: login.php');
}
mysqli_close($db);
