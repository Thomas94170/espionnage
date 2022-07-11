<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styleAgent.css">
    <title>Document</title>
</head>

<body>
    <?php
    require_once('menu.php');
    ?>

    <div class="">
        <br>
        <div class="grid justify-items-stretch">
            <div class="justify-self-center">
                <a href="gestionSkill.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600"><i class="fa-solid fa-plus"></i>Ajouter Compétence</a>
            </div>
        </div>
        <br>

        <div class="">

            <?php


            try {
                $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                foreach ($pdo->query('SELECT * FROM skill') as $skill) {
                    $spec = '';
                    echo "<div class='border border-black bg-gradient-to-r from-gray-400 to-black-500 hover:from-black-500 hover:to-gray-400'>";
                    echo "<br>";
                    echo "Spécialité: " . $skill['speciality'];
                    echo '<br>';
                    echo "<br>";
                    echo '<form action="#" method="POST">';
                    echo '<button class="border border-black bg-lime-500 hover:bg-lime-700">Modifier</button>';
                    echo '<button type="submit" value="' . $skill['speciality'] . '" name="delete" class="mt-2 p-2 rounded-lg bg-red-600" style="cursor: pointer;">';
                    echo 'Delete entity';
                    echo '</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo "<p>Erreur connexion à la base de données </p>";
            }


            ?>
        </div>
        </ul>



        <?php

        try {
            $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM skill WHERE speciality = '$_POST[delete]'";
            $pdo->exec($sql);
        } catch (PDOException $e) {
            echo $sql . '<br>' . $e->getMessage();
        }

        $pdo = null;

        ?>
</body>



</html>