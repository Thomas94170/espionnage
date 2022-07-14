<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styleAgent.css">
    <title>Document</title>
</head>

<body class="bg-gradient-to-r from-black">

    <?php
    require_once('menu.php');
    ?>
    <br>
    <h1 class="text-center text-white">Nouvelle Planque</h1>
    <br>
    <div class="grid grid justify-items-stretch">
        <br>
        <div class=" justify-self-center border border-black text-center bg-slate-100">
            <form action="#" method="POST">
                <!-- <label for="id"> ID : </label>
                <input type="text" name="id" id="id" required /> -->
                <label for="code"> CODE : </label>
                <input type="number" name="code" id="code" required />
                <label for="address"> Adresse : </label>
                <input type="text" name="address" id="address" required />
                <label for="type"> Type : </label>
                <input type="text" name="type" id="type" required />
                <label for="country_id"> Country : </label>
                <select name="country_id" id="">
                    <?php
                    try {
                        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                        foreach ($pdo->query('SELECT * FROM country') as $country) {

                            echo '<option value="' . $country['id'] . '">' . $country['name'] . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                <label for="mission_id"> Mission : </label>
                <select name="mission_id" id="">
                    <?php
                    try {
                        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                        foreach ($pdo->query('SELECT * FROM missions') as $mission) {



                            echo '<option value="' . $mission['id'] . '">' . $mission['title'] . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                <!-- <label for="country_id"> Pays : </label> -->
                <!-- <input type="number" name="country_id" id="country_id" required /> -->
                <!-- <label for="mission_id"> Mission : </label> -->
                <!-- <input type="number" name="mission_id" id="mission_id" required /> -->
                <br><br>
                <input type="submit" value="Valider" class="hover:bg-sky-600 hover:text-slate-900" />

        </div>

    </div>
    <?php

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO stash (`code`,`address`,`type`,`country_id`,`mission_id`) VALUES ('$_POST[code]','$_POST[address]','$_POST[type]','$_POST[country_id]','$_POST[mission_id]')";
        foreach ($pdo->query("SELECT name FROM country WHERE id = '$_POST[country_id]'") as $country) {
            foreach ($pdo->query("SELECT country FROM missions WHERE id = '$_POST[mission_id]'") as $mission) {
                if ($country['name'] != $mission['country']) {
                    echo '<p class= "text-white text-center">Ajout Impossible, la planque doit être dans le pays de la mission';
                } else {
                    $pdo->exec($sql);
                    echo "<p class='text-center text-white'>Ajouté à la base de données</p>";
                }
            }
        }
        // $pdo->exec($sql);
        // echo "<p class='text-center text-white'>Ajouté à la base de données</p>";
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>



</body>

</html>