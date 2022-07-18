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
    <h1 class="text-center text-white">Nouvelle Mission</h1>
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
                <label for="country"> Pays : </label>
                <select name="country" id="country">
                    <br>
                    <?php

                    $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                    foreach ($pdo->query('SELECT * FROM country') as $country) {
                        echo '<option value="' . $country['name'] . '">' . $country['name'] . '</option>';
                    }

                    ?>
                </select>
                <label for="startDate"> Début : </label>
                <input type="date" name="startDate" id="startDate" required />
                <label for="endDate"> Fin : </label>
                <input type="date" name="endDate" id="endDate" required />
                <br>
                <label for="agent"> Agent : </label>
                <select name="agent" id="agent">
                    <br>
                    <?php

                    $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                    foreach ($pdo->query('SELECT * FROM agents') as $agent) {
                        echo '<option value="' . $agent['id'] . '">' . $agent['name'] . '</option>';
                    }

                    ?>
                </select>
                <br>
                <label for="contact"> Contact : </label>
                <select name="contact" id="contact">
                    <br>
                    <?php

                    $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                    foreach ($pdo->query('SELECT * FROM contacts') as $contact) {
                        echo '<option value="' . $contact['id'] . '">' . $contact['name'] . '</option>';
                    }

                    ?>
                </select>
                <label for="skill"> Compétence : </label>
                <select name="skill" id="skill">
                    <br>
                    <?php

                    $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                    foreach ($pdo->query('SELECT * FROM skill') as $skill) {
                        echo '<option value="' . $skill['id'] . '">' . $skill['speciality'] . '</option>';
                    }

                    ?>
                </select>
                <label for="type"> Type : </label>
                <select name="type" id="type">
                    <br>
                    <?php

                    $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                    foreach ($pdo->query('SELECT * FROM type') as $type) {
                        echo '<option value="' . $type['id'] . '">' . $type['name'] . '</option>';
                    }

                    ?>
                </select>
                <label for="status"> Statut : </label>
                <select name="status" id="status">
                    <br>
                    <?php

                    $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                    foreach ($pdo->query('SELECT * FROM status') as $status) {
                        echo '<option value="' . $status['id'] . '">' . $status['conditions'] . '</option>';
                    }

                    ?>
                </select>
                <br><br>
                <input type="submit" value="Valider" class="hover:bg-sky-600 hover:text-slate-900" />

        </div>

    </div>
    <?php

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO missions (title, description, nameCode, country, startDate, endDate, skill_id, status_id, type_id) VALUES ('$_POST[title]', '$_POST[description]', '$_POST[nameCode]', '$_POST[country]','$_POST[startDate],'$_POST[endDate]','$_POST[skill]','$_POST[status],'$_POST[type]')";
        foreach ($pdo->query("SELECT * FROM missions WHERE title = '$_POST[title]' ") as $mission) {
            $sql1 = "INSERT INTO missionagent (mission_id, agent_id) VALUES ('$mission[id]','$_POST[agent])";
        }
        foreach ($pdo->query("SELECT * FROM missions WHERE title = '$_POST[title]' ") as $mission) {
            $sql2 = "INSERT INTO missioncontact (mission_id, contact_id) VALUES ('$mission[id]','$_POST[contact])";
        }

        $pdo->exec($sql);
        echo "<p class='text-center text-white'>Ajouté à la base de données</p>";
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>



</body>

</html>