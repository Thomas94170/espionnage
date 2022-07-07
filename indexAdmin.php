<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="style.css">
    <title>Evaluation KGB</title>
</head>

<body>
    <div class="text-center border border-lime-600 bg-lime-300 text-lime-900">
        <?php
        session_start();
        if ($_SESSION['username'] !== "") {
            $user = $_SESSION['username'];

            echo "Bonjour " . $user . " ravi de vous voir !";
            echo "<br>";
        }

        ?>
    </div>
    <br>

    <div class="grid justify-center">
        <div class="justify-self-center">
            <label for="missions-select">Choisir la mission:</label>
            <select name="mission" id="mission">
                <?php
                try {
                    $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                    foreach ($pdo->query('SELECT * FROM missions') as $mission) {
                        echo "<br>";
                        echo '<option value=""></option>';
                        echo '<option value="' . $mission["title"] . '">' . $mission['title'] . '</option>';
                    }
                } catch (PDOException $e) {
                    echo "<p>Erreur connexion à la base de données </p>";
                }
                // switch ($_POST['mission']) {
                //     default:
                //         header('Location:page.php');
                // }
                ?>
            </select>
            <a href="">Valider</a>
        </div>
    </div>




    <div class="text-center">
        <p>

            <?php

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                foreach ($pdo->query('SELECT * FROM missions') as $mission) {
                    echo "<br>";
                    // echo "Mission: " . $mission['title'] . ' Description: ' . $mission['description'] . '';
                    echo "Mission: " . $mission['title'];
                    echo '<br>';
                    echo "Description: " . $mission['description'];
                    echo "<br>";
                    echo "Nom de code: " . $mission['nameCode'];
                    echo "<br>";
                    echo "Lieu: " . $mission['country'];
                    echo "<br>";
                    echo "Date de début: " . $mission['startDate'];
                    echo "<br>";
                    echo "Date de fin: " . $mission['endDate'] . '<br>';
                    echo $mission['skill_id'] . ' ' . $mission['status_id'] . ' ' . $mission['type_id'];
                    echo "<br>";
                }
            } catch (PDOException $e) {
                echo "<p>Erreur connexion à la base de données </p>";
            }

            ?>
        </p>
    </div>

</body>

</html>