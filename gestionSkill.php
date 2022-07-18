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
    // require_once('sidebar.php');
    ?>
    <br>
    <h1 class="text-center text-white">Nouvelle Compétence</h1>
    <br>
    <div class="grid grid justify-items-stretch">
        <br>
        <div class=" justify-self-center border border-black text-center bg-slate-100">
            <form action="#" method="POST">
                <label for="speciality"> Compétence : </label>
                <input type="text" name="speciality" id="speciality" required>
                <br><br>
                <input type="submit" value="Valider" class="hover:bg-sky-600 hover:text-slate-900" />

        </div>

    </div>
    <?php

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO skill (`speciality`) VALUES ('$_POST[speciality]')";
        $pdo->exec($sql);
        echo "<p class='text-center text-white'>Ajouté à la base de données</p>";
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>



</body>

</html>