<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="styleIndex.css">
    <title>Evaluation KGB</title>
</head>

<body>


    <br>

    <div class="grid justify-center">
        <div class="justify-self-center">

            <a class="bg-white hover:bg-gradient-to-r from-orange-500 to-red-700 rounded-md" href="login.php">Login</a>

        </div>
    </div>




    <div class="text-center text-gray-300">
        <p>
            <?php
            $cleardb_url = parse_url(getenv("mysql://b993bfa7bc6b92:e2103544@eu-cdbr-west-03.cleardb.net/heroku_94efd7f137d0ee9?reconnect=true"));
            $cleardb_server = $cleardb_url["eu-cdbr-west-03.cleardb.net"];
            $cleardb_username = $cleardb_url["b993bfa7bc6b92"];
            $cleardb_password = $cleardb_url["e2103544"];
            $cleardb_db = substr($cleardb_url["heroku_94efd7f137d0ee9"], 1);
            $active_group = 'default';
            $query_builder = TRUE;
            // Connect to DB
            $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
            ?>

            <?php



            try {
                $conn = mysqli_connect($cleardb_server, $cleardb_username, $cleardb_password, $cleardb_db);
                // $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                foreach ($conn->query('SELECT * FROM missions') as $mission) {
                    echo "<br>";
                    echo "Mission: " . $mission['title'];
                    echo '<br>';
                    echo "Description: " . $mission['description'];
                    echo "<br>";
                    echo "Nom de code: " . $mission['nameCode'];
                    echo "<br>";
                    echo "Lieu: " . $mission['country'];
                    echo "<br>";
                }
            } catch (PDOException $e) {
                echo "<p>Erreur connexion à la base de données </p>";
            }

            ?>
        </p>
    </div>

</body>

</html>