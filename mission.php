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

    <div class="bg-black ">
        <br>
        <div class="grid justify-items-stretch">
            <div class="justify-self-center">
                <a href="gestionMission.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600 "><i class="fa-solid fa-plus"></i>Add Mission</a>
            </div>
        </div>
        <br>
        <div class="grid grid-rows-1 grid-flow-col gap-2">
            <div class="row-span-3">


                <br>
                <br>
                <div class="text-white">
                    <div class="grid justify-items-stretch">
                        <p class="justify-self-start text-white">Countries :</p>
                    </div>
                    <div class="justify-self-center text-white">
                        <form action="#" method="GET">
                            <?php
                            $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                            foreach ($pdo->query('SELECT * FROM country') as $country) {
                                $checked = [];
                                if (isset($_GET['country'])) {
                                    $checked = $_GET['country'];
                                }
                            ?>
                                <!-- dans mon foreach je mets en place un tableau vide afin de pouvoir selectionner x pays  -->

                                <input type="checkbox" id="$country[name]" name="country[]" value=<?= $country['name'] ?> <?php if (in_array($country['name'], $checked)) {
                                                                                                                                echo "checked";
                                                                                                                            } ?>><?= $country['name'] ?></input>
                                <br>
                            <?php
                            }
                            ?>

                            <button type="submit" class="mt-2 p-2 rounded-lg bg-blue-600 hover:bg-gradient-to-r from-cyan-500 to-blue-500  text-white" style="cursor: pointer;">
                                Search
                            </button>
                        </form>
                    </div>
                </div>


            </div>

            <div class="cell">

                <?php
                // mise en place du filtre pour pouvoir selectionner un pays avec checkbox
                // dans mon foreach je fais l appel de ma requete sql query($sql)

                try {
                    $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                    $sql = "SELECT * FROM missions WHERE country = country";
                    $countries = [];
                    if (isset($_GET['country'])) {
                        $countries = $_GET['country'];
                        if (count($countries) == 1) {
                            $sql = "SELECT * FROM missions WHERE country = '$countries[0]'";
                        } else if (count($countries) > 1) {
                            $sql = "SELECT * FROM missions WHERE country = '$countries[0]'";
                            foreach ($countries as $country) {
                                $sql .= " OR country = '$country'";
                            }
                        }
                    }
                    foreach ($pdo->query($sql) as $mission) {
                        echo "<div class='border border-black bg-gradient-to-r from-gray-400 to-black-500 hover:from-black-500 hover:to-gray-400'>";
                        echo "<br>";
                        // echo "Mission: " . $mission['title'] . ' Description: ' . $mission['description'] . '';
                        echo "Mission: " . $mission['title'];
                        echo '<br>';
                        echo "Description: " . $mission['description'];
                        echo "<br>";
                        echo "Code: " . $mission['nameCode'];
                        echo "<br>";
                        echo "Place: " . $mission['country'];
                        echo "<br>";
                        echo "Start: " . $mission['startDate'];
                        echo "<br>";
                        echo "End: " . $mission['endDate'] . '<br>';
                        foreach ($pdo->query("SELECT * FROM missionagent WHERE mission_id = $mission[id]") as $missionagent) {
                            foreach ($pdo->query("SELECT * FROM agents WHERE id = $missionagent[agent_id]") as $agent) {
                                echo "Processing Agent: " . $agent['name'] . '<br>';
                            }
                        }
                        foreach ($pdo->query("SELECT * FROM missioncontact WHERE mission_id = $mission[id]") as $missioncontact) {
                            foreach ($pdo->query("SELECT * FROM contacts WHERE id = $missioncontact[contact_id]") as $contact) {
                                echo "Contact : " . $contact['name'] . '<br>';
                            }
                        }
                        foreach ($pdo->query("SELECT * FROM targets WHERE mission_id = $mission[id]") as $target) {
                            echo "Target: " . $target['name'] . '<br>';
                        }
                        foreach ($pdo->query("SELECT * FROM missions WHERE id = $mission[id]") as $missionstatus) {
                            foreach ($pdo->query("SELECT * FROM status WHERE id = $missionstatus[status_id]") as $status) {
                                echo "Mission Status : " . $status['conditions'] . '<br>';
                            }
                        }


                        echo "<br>";
                        echo '<form action="updateMission.php" method="GET">';
                        echo '<button type="submit" value="' . $mission['id'] . '" name="update" class="mt-2 p-2 rounded-lg bg-green-600 hover:bg-gradient-to-r from-lime-300 to-green-500 text-white" style="cursor: pointer;">';
                        echo 'Update';
                        echo '</button>';
                        echo '</form>';
                        echo '<form action="#" method="POST">';
                        echo '<button type="submit" value="' . $mission['id'] . '" name="deleteMission" class="mt-2 p-2 rounded-lg bg-red-600 hover:bg-gradient-to-r from-orange-500 to-red-700 text-white" style="cursor: pointer;">';
                        echo 'Delete';
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

                $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                $cleardb_server = $cleardb_url["host"];
                $cleardb_username = $cleardb_url["user"];
                $cleardb_password = $cleardb_url["pass"];
                $cleardb_db = substr($cleardb_url["path"], 1);
                $active_group = 'default';
                $query_builder = TRUE;

                try {
                    // $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    $pdo = new PDO($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db());
                    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $sql1 = "DELETE FROM missionagent WHERE mission_id = '$_POST[deleteMission]'";
                    $sql2 = "DELETE FROM missioncontact WHERE mission_id = '$_POST[deleteMission]'";
                    $sql3 = "DELETE FROM stash WHERE mission_id = '$_POST[deleteMission]'";
                    $sql4 = "DELETE FROM targets WHERE mission_id = '$_POST[deleteMission]'";
                    $sql5 = "DELETE FROM missionagent WHERE mission_id = '$_POST[deleteMission]'";
                    $sql6 = "DELETE FROM missioncontact WHERE mission_id = '$_POST[deleteMission]'";
                    $sql = "DELETE FROM missions WHERE id = '$_POST[deleteMission]'";
                    $pdo->exec($sql1);
                    $pdo->exec($sql2);
                    $pdo->exec($sql3);
                    $pdo->exec($sql4);
                    $pdo->exec($sql5);
                    $pdo->exec($sql6);
                    $pdo->exec($sql);
                } catch (PDOException $e) {
                    echo $sql . '<br>' . $e->getMessage();
                }

                $pdo = null;

                ?>
            </div>
            </ul>





        </div>
    </div>
</body>

</html>