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





    <?php
    require_once('menu.php')
    ?>


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
                    foreach ($pdo->query("SELECT * FROM missionagent WHERE mission_id = $mission[id]") as $missionagent) {
                        foreach ($pdo->query("SELECT * FROM agents WHERE id = $missionagent[agent_id]") as $agent) {
                            echo "Agent traitant: " . $agent['name'] . '<br>';
                        }
                    }
                    foreach ($pdo->query("SELECT * FROM missioncontact WHERE mission_id = $mission[id]") as $missioncontact) {
                        foreach ($pdo->query("SELECT * FROM contacts WHERE id = $missioncontact[contact_id]") as $contact) {
                            echo "Contact : " . $contact['name'] . '<br>';
                        }
                    }
                    foreach ($pdo->query("SELECT * FROM targets WHERE mission_id = $mission[id]") as $target) {
                        echo "Cible: " . $target['name'] . '<br>';
                    }
                    foreach ($pdo->query("SELECT * FROM missions WHERE id = $mission[id]") as $missionstatus) {
                        foreach ($pdo->query("SELECT * FROM status WHERE id = $missionstatus[status_id]") as $status) {
                            echo "Etat de la mission : " . $status['conditions'] . '<br>';
                        }
                    }
                }
            } catch (PDOException $e) {
                echo "<p>Erreur connexion à la base de données </p>";
            }

            ?>
        </p>
    </div>

</body>

</html>