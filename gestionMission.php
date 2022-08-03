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
    <h1 class="text-center text-white">New Mission</h1>
    <br>
    <div class="grid grid justify-items-stretch">
        <br>
        <div class=" justify-self-center border border-black text-center bg-slate-100">
            <form action="#" method="POST">
                <!-- <label for="id"> Id : </label>
                <input type="number" name="id" id="id" required /> -->
                <label for="title"> Title : </label>
                <input type="text" name="title" id="title" required />
                <label for="description"> Description : </label>
                <input type="text" name="description" id="description" required />
                <label for="nameCode"> Code :</label>
                <input type="text" name="nameCode" id="nameCode" required />
                <br>
                <label for="country"> Country : </label>
                <select name="country" id="country">
                    <br>
                    <?php
                    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                    $cleardb_server = $cleardb_url["host"];
                    $cleardb_username = $cleardb_url["user"];
                    $cleardb_password = $cleardb_url["pass"];
                    $cleardb_db = substr($cleardb_url["path"], 1);
                    $active_group = 'default';
                    $query_builder = TRUE;

                    $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    foreach (mysqli_query($pdo, 'SELECT * FROM country') as $country) {
                        echo '<option value="' . $country['name'] . '">' . $country['name'] . '</option>';
                    }

                    ?>
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
                <label for="status"> Status : </label>
                <select name="status" id="status">
                    <br>
                    <?php

                    $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    foreach (mysqli_query($pdo, 'SELECT * FROM status') as $status) {
                        echo '<option value="' . $status['id'] . '">' . $status['conditions'] . '</option>';
                    }

                    ?>
                </select>
                <br><br>
                <input type="submit" value="Add" name="add" class="hover:bg-sky-600 hover:text-slate-900" />

        </div>

    </div>
    <?php

    try {
        if (isset($_POST['add'])) {
            $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO missions (title, description, nameCode, country, startDate, endDate, skill_id, status_id, type_id) VALUES ('$_POST[title]', '$_POST[description]', '$_POST[nameCode]', '$_POST[country]','$_POST[startDate]','$_POST[endDate]','$_POST[skill]','$_POST[status]','$_POST[type]')";

            // on boucle pour que le pays soit identique à la nationalité du contact en comparant l id du pays à la nationality_id du contact
            foreach (mysqli_query($pdo, "SELECT * FROM country where name = '$_POST[country]'") as $country) {
                foreach (mysqli_query($pdo, "SELECT * FROM contacts where id = '$_POST[contact]'") as $contact) {
                    if ($country['id'] != $contact['nationality_id']) {
                        echo "Erreur : le contact doit être du pays de la mission";
                    } else {
                        // on boucle afin de selectionner la competence de l agent afin qu'elle soit identique à la compétence demandé dans la mission
                        foreach (mysqli_query($pdo, "SELECT * FROM skillagent where agent_id = '$_POST[agent]'") as $skillagent) {
                            if ($skillagent['skill_id'] != $_POST['skill']) {
                                echo "Erreur : l'agent doit avoir la compétence requise";
                            } else {
                                mysqli_query($pdo, $sql);
                            }
                        }
                    }
                }
            }
            foreach (mysqli_query($pdo, "SELECT * FROM missions WHERE title = '$_POST[title]' ") as $mission) {
                mysqli_query($pdo, "INSERT INTO missionagent (mission_id, agent_id) VALUES ('$mission[id]', '$_POST[agent]')");
            }
            foreach (mysqli_query($pdo, "SELECT * FROM missions WHERE title = '$_POST[title]' ") as $mission) {
                mysqli_query($pdo, "INSERT INTO missioncontact (mission_id, contact_id) VALUES ('$mission[id]', '$_POST[contact]')");
            }
        }
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>



</body>

</html>