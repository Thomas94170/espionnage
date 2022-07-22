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
        $sql = "SELECT * FROM contacts";
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
                <label for="majName"> Name : </label>
                <input type="text" name="majName" id="majName" required>
                <label for="majFirstname"> Firstname : </label>
                <input type="text" name="majFirstname" id="majFirstname" required>
                <label for="majDob"> Date of birth : </label>
                <input type="date" name="majDob" id="majDob" required>
                <label for="majCode"> Code : </label>
                <input type="text" name="majCode" id="majCode" required>
                <select name="majNat" id="">
                    <?php
                    try {
                        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                        foreach ($pdo->query('SELECT * FROM nationality') as $nationality) {
                            // echo '<input type="radio" class="checked:bg-blue-500" name="majNat" value= "' . $nationality['id'] . '" />';

                            echo '<option value="' . $nationality['id'] . '">' . $nationality['name'] . '</option>';
                        }
                    } catch (PDOException $e) {
                        echo "<p>Erreur connexion à la base de données </p>";
                    }
                    ?>
                </select>
                <label for="skill"> Skill : </label>
                <select name="skill_id" id="">
                    <br>
                    <?php
                    try {
                        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
                        foreach ($pdo->query('SELECT * FROM skill') as $skill) {
                            echo '<option value="' . $skillAgent['id'] . '">' . $skill['speciality'] . '</option>';

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
                <input type="submit" value="Valider" class="hover:bg-sky-600 hover:text-slate-900" />
            </form>

        </div>
        <br>
        <br>
        <div class="justify-self-center">
            <a href="agent.php" class="font-medium px-3 py-2 text-slate-700 rounded-lg hover:text-slate-900 bg-white-600 hover:bg-sky-600">Retour</a>
        </div>


    </div>

    <!-- update-->

    <?php

    try {
        $pdo = new PDO('mysql:host=localhost;dbname=espionstudi', 'root', '');
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE agents SET name ='$_POST[majName]',firstname = '$_POST[majFirstname]',date_of_birth = '$_POST[majDob]',authentificationCode = '$_POST[majCode]',nationality_id = '$_POST[majNat]' WHERE id = '$_GET[update]'";
        $sqlSkill = "UPDATE skillagent SET skill_id =  '$_POST[skill_id]";
        $pdo->exec($sql);
    } catch (PDOException $e) {
        echo $sql . '<br>' . $e->getMessage();
    }

    $pdo = null;

    ?>
</body>

</html>