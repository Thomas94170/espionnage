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

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM skill";
        $pdo->exec($sql);
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;
    ?>

    <?php
    require_once('menu.php');
    // require_once('sidebar.php');
    ?>
    <br>
    <h1 class="text-center text-white">Mettre à jour</h1>
    <br>
    <div class="grid grid justify-items-stretch">
        <br>
        <div class=" justify-self-center border border-black text-center bg-slate-100">
            <form action="#" method="POST">
                <label for="majCode"> Code : </label>
                <input type="text" name="majCode" id="majCode" required>
                <label for="majAddress"> Address : </label>
                <input type="text" name="majAddress" id="majAddress" required>
                <label for="majType"> Type : </label>
                <input type="text" name="majType" id="majType" required>
                <label for="majCountry"> Country : </label>
                <select name="majCountry" id="">
                    <?php
                    try {
                        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                        foreach ($pdo->query('SELECT * FROM country') as $country) {


                            echo '<option value="' . $country['id'] . '">' . $country['name'] . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                <label for="majMis"> Mission : </label>
                <select name="majMis" id="">
                    <?php
                    try {
                        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                        foreach ($pdo->query('SELECT * FROM missions') as $mission) {


                            echo '<option value="' . $mission['id'] . '">' . $mission['title'] . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                <!-- <label for="majCountry"> Country : </label> -->
                <!-- <input type="number" name="majCountry" id="majCountry" required> -->
                <br><br>
                <input type="submit" value="Valider" class="hover:bg-sky-600 hover:text-slate-900" />
            </form>

        </div>
        <br>
        <br>
        <div class="justify-self-center">
            <a href="planque.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600">Retour</a>
        </div>


    </div>

    <!-- update-->

    <?php

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE stash SET code ='$_POST[majCode]',address = '$_POST[majAddress]',type = '$_POST[majType]',country_id = '$_POST[majCountry]',mission_id = '$_POST[majMis]'  WHERE id = '$_GET[update]'";
        $pdo->exec($sql);
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>
</body>

</html>