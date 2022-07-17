<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
    <link rel="stylesheet" href="styleMenu.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>

<body>
    <input type="checkbox" id="check">
    <label for="check">
        <i class="fas fa-bars" id="btn"></i>
        <i class="fas fa-times" id="cancel"></i>
    </label>
    <div class="sidebar text-center">
        <header>SPY App</header>

        <ul>
            <li>
                <a href="indexAdmin.php"><i class="fas fa-qrcode"></i> Dashboard</a>
            </li>

            <li>
                <a href="agent.php"><i class="fa-solid fa-person-rifle"></i> Agent</a>
            </li>

            <li>
                <a href="contact.php"><i class="fa-solid fa-person-military-to-person"></i> Contact</a>
            </li>

            <li>
                <a href="cibles.php"><i class="fa-solid fa-arrows-down-to-people"></i> Target</a>
            </li>

            <li>
                <a href="competences.php"><i class="fas fa-brain"></i> Skill</a>
            </li>

            <li>
                <a href="planque.php"><i class="fa-solid fa-house-user"></i> Stash</a>
            </li>

            <li>
                <a href="logout.php"><i class="fa-solid fa-power-off"></i> Logout</a>
            </li>
        </ul>
    </div>
    <section></section>
</body>

</html>