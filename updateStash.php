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
                <label for="majCode"> Code : </label>
                <input type="text" name="majCode" id="majCode" required <?php
                                                                        foreach (mysqli_query($pdo, "SELECT * FROM stash WHERE id = '$_GET[update]'") as $stash) {
                                                                            echo 'value="' . $stash['code'] . '" ';
                                                                        }

                                                                        ?>>
                <label for="majAddress"> Address : </label>
                <input type="text" name="majAddress" id="majAddress" required <?php
                                                                                foreach (mysqli_query($pdo, "SELECT * FROM stash WHERE id = '$_GET[update]'") as $stash) {
                                                                                    echo 'value="' . $stash['address'] . '" ';
                                                                                }

                                                                                ?>>
                <label for="majType"> Type : </label>
                <input type="text" name="majType" id="majType" required <?php
                                                                        foreach (mysqli_query($pdo, "SELECT * FROM stash WHERE id = '$_GET[update]'") as $stash) {
                                                                            echo 'value="' . $stash['type'] . '" ';
                                                                        }

                                                                        ?>>
                <label for="majCountry"> Country : </label>
                <select name="majCountry" id="">
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


                        echo '<option value="' . $country['id'] . '">' . $country['name'] . '</option>';
                    }

                    ?>
                </select>
                <label for="majMis"> Mission : </label>
                <select name="majMis" id="">
                    <?php

                    $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                    foreach (mysqli_query($pdo, 'SELECT * FROM missions') as $mission) {


                        echo '<option value="' . $mission['id'] . '">' . $mission['title'] . '</option>';
                    }

                    ?>
                </select>
                <!-- <label for="majCountry"> Country : </label> -->
                <!-- <input type="number" name="majCountry" id="majCountry" required> -->
                <br><br>
                <input type="submit" value="Confirm" name='upd' class="hover:bg-sky-600 hover:text-slate-900" />
            </form>

        </div>
        <br>
        <br>
        <div class="justify-self-center">
            <a href="planque.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600">Back</a>
        </div>


    </div>

    <!-- update-->

    <?php

    try {
        $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
        // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        if (!isset($_POST['upd'])) {
            foreach (mysqli_query($pdo, "SELECT * FROM stash WHERE id = '$_GET[update]'") as $stash) {
                $sql = "UPDATE stash SET
                 code = $stash[code],
                 address = $stash[address],
                 type = $stash[type],
                 country_id = $stash[country_id],
                 mission_id = $stash[mission_id]
                  WHERE id = '$_GET[update]'";
            }
        } else {
            $sql = "UPDATE stash SET
            code = '$_POST[majCode]',
            address = '$_POST[majAddress]',
            type = '$_POST[majType]',
            country = '$_POST[majCountry]',
            mission_id ='$_POST[majMis]'
             WHERE id = '$_GET[update]'";
            foreach (mysqli_query($pdo, "SELECT name FROM country WHERE id = '$_POST[majCountry]'") as $country) {
                foreach (mysqli_query($pdo, "SELECT country FROM missions WHERE id = '$_POST[majMis]'") as $mission) {
                    if (($country['name'] != $mission['country'])) {
                        echo "<p>The hideout must be in the country of the mission</p>";
                        header('Location:updateStash.php');
                    } else {
                        mysqli_query($pdo, $sql);
                        echo 'Add in Database';
                    }
                }
            }
            mysqli_query($pdo, $sql);
        }
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>
</body>

</html>