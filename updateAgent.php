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
                <label for="majName"> Name : </label>
                <input type="text" name="majName" id="majName" required <?php
                                                                        foreach (mysqli_query($pdo, "SELECT * FROM agents WHERE id = '$_GET[update]'") as $agent) {
                                                                            echo 'value="' . $agent['name'] . '" ';
                                                                        }

                                                                        ?>>
                <label for="majFirstname"> Firstname : </label>
                <input type="text" name="majFirstname" id="majFirstname" required <?php
                                                                                    foreach (mysqli_query($pdo, "SELECT * FROM agents WHERE id = '$_GET[update]'") as $agent) {
                                                                                        echo 'value="' . $agent['firstname'] . '" ';
                                                                                    }

                                                                                    ?>>
                <label for="majDob"> Date of birth : </label>
                <input type="date" name="majDob" id="majDob" required <?php
                                                                        foreach (mysqli_query($pdo, "SELECT * FROM agents WHERE id = '$_GET[update]'") as $agent) {
                                                                            echo 'value="' . $agent['date_of_birth'] . '" ';
                                                                        }

                                                                        ?>>
                <label for="majCode"> Code : </label>
                <input type="text" name="majCode" id="majCode" required <?php
                                                                        foreach (mysqli_query($pdo, "SELECT * FROM agents WHERE id = '$_GET[update]'") as $agent) {
                                                                            echo 'value="' . $agent['authentificationCode'] . '" ';
                                                                        }

                                                                        ?>>
                <select name="majNat" id="">
                    <?php
                    try {
                        $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                        foreach (mysqli_query($pdo, 'SELECT * FROM nationality') as $nationality) {
                            // echo '<input type="radio" class="checked:bg-blue-500" name="majNat" value= "' . $nationality['id'] . '" />';

                            echo '<option value="' . $nationality['id'] . '">' . $nationality['name'] . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                <label for="skill"> Skill : </label>
                <select name="skill_id" id="skill_id">
                    <br>
                    <?php
                    try {
                        $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                        foreach (mysqli_query($pdo, 'SELECT * FROM skill') as $skill) {
                            echo '<option value="' . $skill['id'] . '">' . $skill['speciality'] . '</option>';

                            // echo '<input type="radio" class="checked:bg-blue-500" name="nationality_id" value= "' . $nationality['id'] . '" />';
                            // echo $nationality['name'];
                            // echo "<br>";
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                <!-- <label for="majNat"> Nationality : </label> -->
                <!-- <input type="number" name="majNat" id="majNat" required> -->
                <br><br>
                <input type="submit" name="upd" value="Confirm" class="hover:bg-sky-600 hover:text-slate-900" />
            </form>

        </div>
        <br>
        <br>
        <div class="justify-self-center">
            <a href="agent.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600">Back</a>
        </div>


    </div>

    <!-- update-->

    <?php

    try {
        // $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // $sql = "UPDATE agents SET name ='$_POST[majName]',firstname = '$_POST[majFirstname]',date_of_birth = '$_POST[majDob]',authentificationCode = '$_POST[majCode]',nationality_id = '$_POST[majNat]' WHERE id = '$_GET[update]'";
        // $sqlSkill = "UPDATE skillagent SET skill_id =  '$_POST[skill_id]";
        // mysqli_query($pdo, $sql);

        if (!isset($_POST['upd'])) {
            foreach (mysqli_query($pdo, "SELECT * FROM agents WHERE id = '$_GET[update]'") as $agent) {
                $sql = "UPDATE agents SET 
              name = $agent[name],
              firstname = $agent[firstname],
              date_of_birth = $agent[date_of_birth],
              authentificationCode = $agent[authentificationCode],
              nationality_id = $agent[nationality_id]
              WHERE id = '$_GET[update]'";
            }
        } else {
            $sql = "UPDATE agents SET 
            name = '$_POST[majName]', 
            firstname = '$_POST[majFirstname]', 
            date_of_birth = '$_POST[majDob]', 
            authentificationCode = '$_POST[majCode]', 
            nationality_id = '$_POST[majNat]' 
            WHERE id = '$_GET[update]'";
            mysqli_query($pdo, $sql);
            foreach (mysqli_query($pdo, ("SELECT * from agents WHERE name = '$_POST[majName]'")) as $agent) {
                $sql2 = "UPDATE skillagent SET skill_id = '$_POST[skill_id]' WHERE agent_id = '$agent[id]'";
            }
            mysqli_query($pdo, $sql2);
        }
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>
</body>

</html>