<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styleLogin.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Login</title>
</head>

<body class="login">


    <div class="text-center grid justify-center texte">
        <div class="justify-self-center">
            <br>
            <form class="border border-black decoration-white bg-slate-400 justify-self-center" action="verif.php" method="POST">


                <h1>Connexion</h1>
                <br>
                <label>Username</label>
                <input type="text" placeholder="Username" name="username" required>

                <label>Password</label>
                <input type="password" placeholder="Password" name="password" required>
                <br>
                <br>
                <input class="border border-black rounded-md bg-lime-500 hover:bg-lime-700 btn" type="submit" id="submit" value="Login">
                <br><br>
                <?php
                if (isset($_POST['erreur'])) {
                    $error = $_POST['erreur'];
                    if ($error == 1 || $error == 2);
                    echo "<p class='decoration-red-800 bg-red-500'>Erreur</p>";
                }
                ?>

            </form>
        </div>

        <br><br><br><br><br>
    </div>
</body>

</html>