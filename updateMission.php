<!DOCTYPE html>
<html lang="en">

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

    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $cleardb_server = $cleardb_url["host"];
    $cleardb_username = $cleardb_url["user"];
    $cleardb_password = $cleardb_url["pass"];
    $cleardb_db = substr($cleardb_url["path"], 1);
    $active_group = 'default';
    $query_builder = TRUE;


    $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);



    ?>

    <?php
    require_once('menu.php');
    // require_once('sidebar.php');
    ?>
    <br>
    <h1 class="text-center text-white">Update</h1>
    <br>
    <div class="grid grid justify-items-stretch">
        <br>
        <div class=" justify-self-center border border-black text-center bg-slate-100">
            <form action="#" method="POST">
                <label for="majTitle"> Title : </label>
                <input type="text" name="majTitle" id="majTitle" required <?php
                                                                            foreach (mysqli_query($pdo, "SELECT * FROM missions WHERE id = '$_GET[update]'") as $mission) {
                                                                                echo 'value="' . $mission['title'] . '" ';
                                                                            }

                                                                            ?>>
                <label for="majDescription"> Description : </label>
                <input type="text" name="majDescription" id="majDescription" required <?php
                                                                                        foreach (mysqli_query($pdo, "SELECT * FROM missions WHERE id = '$_GET[update]'") as $mission) {
                                                                                            echo 'value="' . $mission['description'] . '" ';
                                                                                        }

                                                                                        ?>>
                <label for="majCode"> Code : </label>
                <input type="text" name="majCode" id="majCode" required <?php
                                                                        foreach (mysqli_query($pdo, "SELECT * FROM missions WHERE id = '$_GET[update]'") as $mission) {
                                                                            echo 'value="' . $mission['nameCode'] . '" ';
                                                                        }

                                                                        ?>>
                <label for="majCountry"> Country : </label>
                <select name="majCountry" id="majCountry">
                    <?php
                    try {

                        foreach (mysqli_query($pdo, 'SELECT * FROM country') as $country) {
                            // echo '<input type="radio" class="checked:bg-blue-500" name="majNat" value= "' . $nationality['id'] . '" />';

                            echo '<option value="' . $country['name'] . '">' . $country['name'] . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                </select>
                <label for="startDate"> Start : </label>
                <input type="date" name="startDate" id="startDate" required />
                <label for="endDate"> End : </label>
                <input type="date" name="endDate" id="endDate" required />
                <br>
                <label for="agent"> Agent : </label>
                <select name="agent" id="agent">
                    <br>
                    <?php

                    $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    foreach (mysqli_query($pdo, 'SELECT * FROM agents') as $agent) {
                        echo '<option value="' . $agent['id'] . '">' . $agent['name'] . '</option>';
                    }

                    ?>
                </select>
                <br>
                <label for="contact"> Contact : </label>
                <select name="contact" id="contact">
                    <br>
                    <?php

                    $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    foreach (mysqli_query($pdo, 'SELECT * FROM contacts') as $contact) {
                        echo '<option value="' . $contact['id'] . '">' . $contact['name'] . '</option>';
                    }

                    ?>
                </select>
                <label for="skill"> Skill : </label>
                <select name="skill" id="skill">
                    <br>
                    <?php

                    $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    foreach (mysqli_query($pdo, 'SELECT * FROM skill') as $skill) {
                        echo '<option value="' . $skill['id'] . '">' . $skill['speciality'] . '</option>';
                    }

                    ?>
                </select>
                <label for="type"> Type : </label>
                <select name="type" id="type">
                    <br>
                    <?php

                    $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    foreach (mysqli_query($pdo, 'SELECT * FROM type') as $type) {
                        echo '<option value="' . $type['id'] . '">' . $type['name'] . '</option>';
                    }

                    ?>
                </select>
                <label for="status"> Statut : </label>
                <select name="status" id="status">
                    <br>
                    <?php

                    $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    foreach (mysqli_query($pdo, 'SELECT * FROM status') as $status) {
                        echo '<option value="' . $status['id'] . '">' . $status['conditions'] . '</option>';
                    }
                    ?>
                    <!-- <label for="majNat"> Nationality : </label> -->
                    <!-- <input type="number" name="majNat" id="majNat" required> -->
                    <br><br>
                    <input type="submit" value="Confirm" name="upd" class="hover:bg-sky-600 hover:text-slate-900" />
            </form>

        </div>
        <br>
        <br>
        <div class="justify-self-center">
            <a href="mission.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600">Back</a>
        </div>


    </div>

    <!-- update-->

    <?php

    try {
        if (!isset($_POST['upd'])) {
            $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
            foreach (mysqli_query($pdo, "SELECT * FROM missions WHERE id = '$_GET[update]'") as $mission) {
                $sql = "UPDATE missions SET 
              title = $mission[title],
              description = $mission[description],
              nameCode = $mission[nameCode],
              country = $mission[country],
              startDate = $mission[startDate],
              endDate = $mission[endDate],
                skill_id = $mission[skill_id],
                status_id = $mission[status_id],
                type_id = $mission[type_id]
              WHERE id = '$_GET[update]'";
            }
        } else {
            if ($mission['country'] != $_POST['nationality_id']) {
                echo "Erreur : le contact doit être du pays de la mission";
                header('Location:updateMission.php');
            }
            if ($mission['skill_id'] != $_POST['skill']) {
                echo '<br>';
                echo "Erreur : l'agent doit avoir la compétence requise";
                header('Location:updateMission.php');
            }
            $sql = "UPDATE missions SET
          title ='$_POST[majTitle]',
          description = '$_POST[majDescription]',
          nameCode = '$_POST[majCode]',
          country = '$_POST[majCountry]',
          startDate = '$_POST[startDate]',
          endDate = '$_POST[endDate]',
          skill_id = $_POST[skill],
                status_id = $_POST[status],
                type_id = $_POST[type] 
          WHERE id = '$_GET[update]'";
            mysqli_query($pdo, $sql);
            foreach (mysqli_query($pdo, "SELECT * FROM missions WHERE title = '$_POST[majTitle]'") as $mission) {

                mysqli_query($pdo, "UPDATE missionagent SET agent_id = '$_POST[agent]' WHERE mission_id = '$mission[id]'");
                mysqli_query($pdo, "UPDATE missioncontact SET contact_id = '$_POST[contact]' WHERE mission_id = '$mission[id]'");
            }
        }
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>
</body>

</html>