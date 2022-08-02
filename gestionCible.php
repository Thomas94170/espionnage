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
    <h1 class="text-center text-white">New Target</h1>
    <br>
    <div class="grid grid justify-items-stretch">
        <br>
        <div class=" justify-self-center border border-black text-center bg-slate-100">
            <form action="#" method="POST">
                <label for="name"> Name : </label>
                <input type="text" name="name" id="name" required />
                <label for="firstname"> Firstname : </label>
                <input type="text" name="firstname" id="firstname" required />
                <label for="date"> Date of birth </label>
                <input type="date" name="date_of_birth" id="date_of_birth" required />
                <label for="codeName"> Code : </label>
                <input type="text" name="codeName" id="codeName" required />
                <br>
                <label for="nationality_id"> Nationality : </label>
                <select name="nationality_id" id="">
                    <?php
                    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
                    $cleardb_server = $cleardb_url["host"];
                    $cleardb_username = $cleardb_url["user"];
                    $cleardb_password = $cleardb_url["pass"];
                    $cleardb_db = substr($cleardb_url["path"], 1);
                    $active_group = 'default';
                    $query_builder = TRUE;


                    $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    foreach (mysqli_query($pdo, 'SELECT * FROM nationality') as $nationality) {


                        echo '<option value="' . $nationality['id'] . '">' . $nationality['name'] . '</option>';
                    }

                    ?>
                </select>
                <label for="mission_id"> Mission : </label>
                <select name="mission_id" id="mission_id">
                    <?php

                    // $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    foreach (mysqli_query($pdo, 'SELECT * FROM missions') as $mission) {


                        echo '<option value="' . $mission['id'] . '">' . $mission['title'] . '</option>';
                    }

                    ?>
                </select>
                <!-- <label for="nationality_id"> Nationalité : </label> -->
                <!-- <input type="number" name="nationality_id" id="nationality_id" required /> -->
                <!-- <label for="mission_id"> Mission affectée : </label> -->
                <!-- <input type="number" name="mission_id" id="mission_id" /> -->
                <br><br>
                <button type="submit" value="Add" name="add" class="hover:bg-sky-600 hover:text-slate-900">Add</button>

        </div>

    </div>
    <?php

    try {
        if (isset($_POST['add'])) {
            $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
            // $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // $reset = "ALTER TABLE target auto_increment = 0";
            $sql = "INSERT INTO targets (name,firstname,date_of_birth,codeName,nationality_id,mission_id) VALUES ('$_POST[name]', '$_POST[firstname]', '$_POST[date_of_birth]', '$_POST[codeName]', '$_POST[nationality_id]', '$_POST[mission_id]')";
            // mysqli_query($pdo, $reset);
            mysqli_query($pdo, $sql);
            echo "<p class='text-center text-white'>Add in database</p>";
        }
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>



</body>

</html>