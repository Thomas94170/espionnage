<!DOCTYPE html>
<html lang="fr">

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
    require_once('menu.php');
    // require_once('sidebar.php');
    ?>


    <div class="bg-black">
        <br>
        <div class="grid justify-items-stretch">
            <div class="justify-self-center">
                <a href="gestionSkill.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600"><i class="fa-solid fa-plus"></i>Add Skill</a>
            </div>
        </div>
        <br>

        <div class="">

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
                // $pdo = new PDO($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db());
                foreach (mysqli_query($pdo, 'SELECT * FROM skill') as $skill) {
                    $spec = '';
                    echo "<div class=' flex justify-between border border-black bg-gradient-to-r from-gray-400 to-black-500 hover:from-black-500 hover:to-gray-400 text-white'>";
                    echo "<br>";
                    echo "Spéciality: " . $skill['speciality'];
                    echo '<br>';
                    echo "<br>";
                    echo '<form action="updateSkill.php" method="GET">';
                    echo '<button type="submit" value="' . $skill['id'] . '" name="update" class="mt-2 p-2 rounded-lg bg-green-600 hover:bg-gradient-to-r from-lime-300 to-green-500 text-white" style="cursor: pointer;">';
                    echo 'Update';
                    echo '</button>';
                    echo '</form>';
                    echo '<form action="#" method="POST">';
                    echo '<button type="submit" value="' . $skill['speciality'] . '" name="delete" class="mt-2 p-2 rounded-lg bg-red-600 hover:bg-gradient-to-r from-orange-500 to-red-700 text-white" style="cursor: pointer;">';
                    echo 'Delete';
                    echo '</button>';
                    echo '</form>';
                    echo '</div>';
                }
            } catch (PDOException $e) {
                echo "<p>Erreur connexion à la base de données </p>";
            }


            ?>
        </div>
        </ul>


        <!-- supprimer  -->
        <?php

        try {
            // $pdo = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
            // $pdo = new PDO($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db());
            // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "DELETE FROM skill WHERE speciality = '$_POST[delete]'";
            mysqli_query($pdo, $sql);
        } catch (PDOException $e) {
            echo $sql . '<br>' . $e->getMessage();
        }

        $pdo = null;

        ?>





</body>



</html>