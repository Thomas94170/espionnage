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
                <a href="gestionContact.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600"><i class="fa-solid fa-plus"></i>Add Contact</a>
            </div>
        </div>
        <br>
        <br>
        <br>
        <form action="#" method="GET">
            <label class="relative block">
                <span class="sr-only">Search</span>
                <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                    <svg class="h-5 w-5 fill-slate-300" viewBox="0 0 20 20">

                    </svg>
                </span>
                <input class="placeholder:italic placeholder:text-slate-400 block bg-white w-full border border-slate-300 rounded-md py-2 pl-9 pr-3 shadow-sm focus:outline-none focus:border-sky-500 focus:ring-sky-500 focus:ring-1 sm:text-sm" placeholder="Search by name..." type="text" name="searchContact" />
            </label>
            <button type="submit" value="searchContact" name="searchC" class="mt-2 p-2 rounded-lg bg-blue-600 hover:bg-gradient-to-r from-cyan-500 to-blue-500 text-white" style="cursor: pointer">Search</button>
            <br>
        </form>
        <br>

        <div class="">

            <?php


            try {
                $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                if (isset($_GET['searchC']) && !empty(trim($_GET['searchContact']))) {
                    $sql = "SELECT * FROM contacts WHERE name = '$_GET[searchContact]'";
                } else {
                    $sql = "SELECT * FROM contacts WHERE name = name";
                }
                foreach ($pdo->query($sql) as $contact) {
                    echo "<div class='border border-black bg-gradient-to-r from-gray-400 to-black-500 hover:from-black-500 hover:to-gray-400 text-white'>";
                    echo "<br>";
                    // echo "Mission: " . $mission['title'] . ' Description: ' . $mission['description'] . '';
                    echo "Name: " . $contact['name'];
                    echo '<br>';
                    echo "Firstanme: " . $contact['firstname'];
                    echo "<br>";
                    echo "Date of birth: " . $contact['date_of_birth'];
                    echo "<br>";
                    echo "Contact code: " . $contact['codeName'];
                    echo "<br>";
                    echo "Nationality: ";
                    echo "<br>";

                    switch ($contact['nationality_id']) {
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
                            echo "<img src='https://img.icons8.com/color/48/000000/malaysia.png'/>";
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
                    echo '<form action="updateContact.php" method="GET">';
                    echo '<button type="submit" value="' . $contact['id'] . '" name="update" class="mt-2 p-2 rounded-lg bg-green-600 hover:bg-gradient-to-r from-lime-300 to-green-500 text-white" style="cursor: pointer;">';
                    echo 'Update';
                    echo '</button>';
                    echo '</form>';
                    echo '<form action="#" method="POST">';
                    echo '<button type="submit" value="' . $contact['id'] . '" name="deleteContact" class="mt-2 p-2 rounded-lg bg-red-600 hover:bg-gradient-to-r from-orange-500 to-red-700 text-white" style="cursor: pointer;">';
                    echo 'Delete';
                    echo '</button>';
                    echo '</form>';
                    echo "</div>";
                }
            } catch (PDOException $e) {
                echo "<p>Erreur connexion à la base de données </p>";
            }

            ?>

            <!-- supprimer les contacts -->
            <?php

            try {
                $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DELETE FROM contacts WHERE id = '$_POST[deleteContact]'";
                $sql1 = "DELETE FROM missioncontact WHERE contact_id = '$_POST[deleteContact]'";
                $pdo->exec($sql1);
                $pdo->exec($sql);
            } catch (PDOException $e) {
                echo $sql . '<br>' . $e->getMessage();
            }

            $pdo = null;

            ?>
        </div>
        </ul>
</body>

</html>