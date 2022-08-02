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

    try {
        $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM targets";
        mysqli_query($pdo, $sql);
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }


    ?>

    <?php
    require_once('menu.php');
    // require_once('sidebar.php');
    // $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
    ?>
    <br>
    <h1 class="text-center text-white">Update</h1>
    <br>
    <div class="grid grid justify-items-stretch">
        <br>
        <div class=" justify-self-center border border-black text-center bg-slate-100">
            <form action="#" method="POST">
                <label for="majName"> Name : </label>
                <input type="text" name="majName" id="majName" required <?php
                                                                        foreach (mysqli_query($pdo, "SELECT * FROM targets WHERE id = '$_GET[update]'") as $target) {
                                                                            echo 'value="' . $target['name'] . '" ';
                                                                        }

                                                                        ?>>
                <label for="majFirstname"> Firstname : </label>
                <input type="text" name="majFirstname" id="majFirstname" required <?php
                                                                                    foreach (mysqli_query($pdo, "SELECT * FROM targets WHERE id = '$_GET[update]'") as $target) {
                                                                                        echo 'value="' . $target['firstname'] . '" ';
                                                                                    }

                                                                                    ?>>
                <label for="majDob"> Date of birth : </label>
                <input type="date" name="majDob" id="majDob" required <?php
                                                                        foreach (mysqli_query($pdo, "SELECT * FROM targets WHERE id = '$_GET[update]'") as $target) {
                                                                            echo 'value="' . $target['date_of_birth'] . '" ';
                                                                        }

                                                                        ?>>
                <label for="majNat"> Nationality : </label>
                <select name="majNat" id="">
                    <?php
                    try {
                        $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                        foreach (mysqli_query($pdo, 'SELECT * FROM nationality') as $nationality) {


                            echo '<option value="' . $nationality['id'] . '">' . $nationality['name'] . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                <label for="majMis"> Mission : </label>
                <select name="majMis" id="majMis">
                    <?php
                    try {
                        $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                        foreach (mysqli_query($pdo, 'SELECT * FROM missions') as $mission) {


                            echo '<option value="' . $mission['id'] . '">' . $mission['title'] . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                <!-- <input type="text" name="majCode" id="majCode" required> -->
                <!-- <label for="majNat"> Nationality : </label> -->
                <!-- <input type="number" name="majNat" id="majNat" required> -->
                <!-- <label for="majMis"> Mission : </label> -->
                <!-- <input type="number" name="majMis" id="majMis" required> -->
                <br><br>
                <input type="submit" name="upd" value="Confirm" class="hover:bg-sky-600 hover:text-slate-900" />
            </form>

        </div>
        <br>
        <br>
        <div class="justify-self-center">
            <a href="cibles.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600">Back</a>
        </div>


    </div>

    <!-- update-->

    <?php

    try {
        $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $sql = "UPDATE agents SET name ='$_POST[majName]',firstname = '$_POST[majFirstname]',date_of_birth = '$_POST[majDob]',authentificationCode = '$_POST[majCode]',nationality_id = '$_POST[majNat]' WHERE id = '$_GET[update]'";
        // $sqlSkill = "UPDATE skillagent SET skill_id =  '$_POST[skill_id]";
        // mysqli_query($pdo, $sql);

        if (!isset($_POST['upd'])) {
            foreach (mysqli_query($pdo, "SELECT * FROM targets WHERE id = '$_GET[update]'") as $target) {
                $sql = "UPDATE targets SET 
              name = $target[name],
              firstname = $target[firstname],
              date_of_birth = $target[date_of_birth],
              codeName = $target[codeName],
              nationality_id = $target[nationality_id],
              mission_id = $target[mission_id]
              WHERE id = '$_GET[update]'";
            }
        } else {
            $sql = "UPDATE targets SET 
            name = '$_POST[majName]', 
            firstname = '$_POST[majFirstname]', 
            date_of_birth = '$_POST[majDob]', 
            codeName = '$_POST[majCode]', 
            nationality_id = '$_POST[majNat]',
            mission_id = '$_POST[majMis]'
            WHERE id = '$_GET[update]'";
            foreach (mysqli_query($pdo, ("SELECT * from missionagent WHERE mission_id = '$_POST[majMis]'")) as $mission) {
                foreach (mysqli_query($pdo, "SELECT * FROM agent WHERE id = '$mission[agent_id]'") as $agent) {
                    if ($_POST['majNat'] == $agent['nationality_id']) {
                        break;
                    } else {
                        mysqli_query($pdo, $sql);
                    }
                }
            }
        }
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>
</body>

</html>