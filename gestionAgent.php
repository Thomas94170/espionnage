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
    <h1 class="text-center text-white">Nouvel Agent</h1>
    <br>
    <div class="grid grid justify-items-stretch">
        <br>
        <div class=" justify-self-center border border-black text-center bg-slate-100">
            <form action="#" method="POST">
                <!-- <label for="id"> Id : </label>
                <input type="number" name="id" id="id" required /> -->
                <label for="name"> Nom : </label>
                <input type="text" name="name" id="name" required />
                <label for="firstname"> Prénom : </label>
                <input type="text" name="firstname" id="firstname" required />
                <label for="date"> Date de naissance </label>
                <input type="date" name="date_of_birth" id="date_of_birth" required />
                <label for="authentificationCode"> Code : </label>
                <input type="text" name="authentificationCode" id="authentificationCode" required />
                <br>
                <label for="Nationality"> Nationality : </label>
                <select name="nationality_id" id="">
                    <br>
                    <?php
                    try {
                        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                        foreach ($pdo->query('SELECT * FROM nationality') as $nationality) {
                            echo '<option value="' . $nationality['id'] . '">' . $nationality['name'] . '</option>';
                            // echo '<input type="radio" class="checked:bg-blue-500" name="nationality_id" value= "' . $nationality['id'] . '" />';
                            // echo $nationality['name'];
                            // echo "<br>";
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                <!-- <label for="nationality_id"> Nationalité : </label> -->
                <!-- <input type="number" name="nationality_id" id="nationality_id" required /> -->
                <br><br>
                <input type="submit" value="Valider" class="hover:bg-sky-600 hover:text-slate-900" />

        </div>

    </div>
    <?php

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO agents (name, firstname, date_of_birth, authentificationCode, nationality_id) VALUES ('$_POST[name]', '$_POST[firstname]', '$_POST[date_of_birth]', '$_POST[authentificationCode]','$_POST[nationality_id]')";
        $pdo->exec($sql);
        echo "<p class='text-center text-white'>Ajouté à la base de données</p>";
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>



</body>

</html>