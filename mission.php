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

<body>

    <?php
    require_once('menu.php');
    // require_once('sidebar.php');
    ?>

    <div class="bg-black">
        <br>
        <div class="grid justify-items-stretch">
            <div class="justify-self-center">
                <a href="gestionMission.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600 "><i class="fa-solid fa-plus"></i>Ajouter Mission</a>
            </div>
        </div>
        <br>

        <div class="cell">

            <?php


            try {
                $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                foreach ($pdo->query('SELECT * FROM missions') as $mission) {
                    echo "<div class='border border-black bg-gradient-to-r from-gray-400 to-black-500 hover:from-black-500 hover:to-gray-400'>";
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


                    echo "<br>";
                    echo '<form action="updateMission.php" method="GET">';
                    echo '<button type="submit" value="' . $mission['id'] . '" name="update" class="mt-2 p-2 rounded-lg bg-green-600 text-white" style="cursor: pointer;">';
                    echo 'Mettre à jour';
                    echo '</button>';
                    echo '</form>';
                    echo '<form action="#" method="POST">';
                    echo '<button type="submit" value="' . $mission['id'] . '" name="deleteMission" class="mt-2 p-2 rounded-lg bg-red-600 text-white" style="cursor: pointer;">';
                    echo 'Supprimer';
                    echo '</button>';
                    echo '</form>';
                    echo "</div>";
                }
            } catch (PDOException $e) {
                echo "<p>Erreur connexion à la base de données </p>";
            }
            ?>

            <!-- supprimer les missions -->
            <?php

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql1 = "DELETE FROM missionagent WHERE mission_id = '$_POST[deleteMission]'";
                $sql2 = "DELETE FROM missioncontact WHERE mission_id = '$_POST[deleteMission]'";
                $sql = "DELETE FROM missions WHERE id = '$_POST[deleteMission]'";
                $pdo->exec($sql1);
                $pdo->exec($sql2);
                $pdo->exec($sql);
            } catch (PDOException $e) {
                echo $sql . '<br>' . $e->getMessage();
            }

            $pdo = null;

            ?>
        </div>
        </ul>




        <!-- supprimer agent -->

        <?php

        ?>
</body>

</html>