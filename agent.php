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

    <div class="grid grid-rows-1 grid-flow-col gap-2">

        <div class="">

            <?php


            try {
                $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                foreach ($pdo->query('SELECT * FROM agents') as $agent) {
                    echo "<div class='border border-black'>";
                    echo "<br>";
                    // echo "Mission: " . $mission['title'] . ' Description: ' . $mission['description'] . '';
                    echo "Nom: " . $agent['name'];
                    echo '<br>';
                    echo "Prénom: " . $agent['firstname'];
                    echo "<br>";
                    echo "Date de naissance: " . $agent['date_of_birth'];
                    echo "<br>";
                    echo "Code Agent: " . $agent['authentificationCode'];
                    echo "<br>";
                    echo "Nationalité: ";
                    echo "<br>";

                    switch ($agent['nationality_id']) {
                        case 1:
                            echo "<img src='https://img.icons8.com/color/48/000000/ukraine.png'/>";
                            break;
                        case 2:
                            echo "<img src='https://img.icons8.com/color/48/000000/north-korea.png'/>";
                            break;
                        case 3:
                            echo "<img src='https://img.icons8.com/color/48/000000/france.png'/>";
                            break;
                        case 4:
                            echo "<img src='https://img.icons8.com/color/48/000000/russian-federation.png'/>";
                            break;
                        case 5:
                            echo "<img src='https://img.icons8.com/color/48/000000/china.png'/>";
                            break;
                        case 6:
                            echo "<img src='https://img.icons8.com/color/48/000000/philippines.png'/>";
                            break;
                        case 7:
                            echo "<img src='https://img.icons8.com/color/48/000000/usa.png'/>";
                            break;
                        case 8:
                            echo "<img src='https://img.icons8.com/color/48/000000/brazil.png'/>";
                            break;
                        case 9:
                            echo "<img src='https://img.icons8.com/color/48/000000/turkey.png'/>";
                            break;
                        case 10:
                            echo "<img src='https://img.icons8.com/color/48/000000/indonesia.png'/>";
                            break;
                        case 11:
                            echo "<img src='https://img.icons8.com/color/48/000000/poland.png'/>";
                            break;
                        case 12:
                            echo "<img src='https://img.icons8.com/color/48/000000/malaisia.png'/>";
                            break;
                        case 13:
                            echo "<img src='https://img.icons8.com/color/48/000000/south-korea.png'/>";
                            break;
                        case 14:
                            echo "<img src='https://img.icons8.com/color/48/000000/germany.png'/>";
                            break;
                        case 15:
                            echo "<img src='https://img.icons8.com/color/48/000000/austria.png'/>";
                            break;
                        case 16:
                            echo "<img src='https://img.icons8.com/color/48/000000/great-britain.png'/>";
                            break;
                        case 17:
                            echo "<img src='https://img.icons8.com/color/48/000000/syria.png'/>";
                            break;
                    }
                    echo "<br>";

                    echo "<button class='border border-black bg-lime-500 hover:bg-lime-700'>Modifier</button>";
                    echo "<button class='border border-black bg-red-500 hover:bg-red-700'>Supprimer</button>";
                    echo "</div>";
                }
            } catch (PDOException $e) {
                echo "<p>Erreur connexion à la base de données </p>";
            }


            ?>
        </div>
        </ul>
</body>

</html>