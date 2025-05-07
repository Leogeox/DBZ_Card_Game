<?php

require_once("connexion.php");

//si pas connecter diriger vers login
if(!isset($_SESSION["iduser"])) {
    header("location:login.php");
}

    // je vide ma session quand appuie sur deconnecter
if(isset($_GET["action"]) && $_GET["action"] == "deconnexion") {
    unset($_SESSION["iduser"]);
    unset($_SESSION["email"]);
    header("location:log-in.php"); // redirection login
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Votre sélection de cartes Undertale favorites : suivez, admirez et complétez votre deck parfait.">
    <title>Profil</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/icons/favicon.png">
</head>

<body class=background id="body">

<header class="header">
        <div class="container">

            <svg xmlns="http://www.w3.org/2000/svg" id="menu" height="40px" viewBox="0 -960 960 960" width="40px" fill="currentColor"><path d="M120-240v-66.67h720V-240H120Zm0-206.67v-66.66h720v66.66H120Zm0-206.66V-720h720v66.67H120Z"/></svg>

            <nav class="account_container">
                <ul>
                    <li>
                        <a href="log-in.php"><svg xmlns="http://www.w3.org/2000/svg" class="size_icon" height="40px" viewBox="0 -960 960 960" width="40px" fill="currentColor"><path d="M226-262q59-42.33 121.33-65.5 62.34-23.17 132.67-23.17 70.33 0 133 23.17T734.67-262q41-49.67 59.83-103.67T813.33-480q0-141-96.16-237.17Q621-813.33 480-813.33t-237.17 96.16Q146.67-621 146.67-480q0 60.33 19.16 114.33Q185-311.67 226-262Zm253.88-184.67q-58.21 0-98.05-39.95Q342-526.58 342-584.79t39.96-98.04q39.95-39.84 98.16-39.84 58.21 0 98.05 39.96Q618-642.75 618-584.54t-39.96 98.04q-39.95 39.83-98.16 39.83ZM480.31-80q-82.64 0-155.64-31.5-73-31.5-127.34-85.83Q143-251.67 111.5-324.51T80-480.18q0-82.82 31.5-155.49 31.5-72.66 85.83-127Q251.67-817 324.51-848.5T480.18-880q82.82 0 155.49 31.5 72.66 31.5 127 85.83Q817-708.33 848.5-635.65 880-562.96 880-480.31q0 82.64-31.5 155.64-31.5 73-85.83 127.34Q708.33-143 635.65-111.5 562.96-80 480.31-80Zm-.31-66.67q54.33 0 105-15.83t97.67-52.17q-47-33.66-98-51.5Q533.67-284 480-284t-104.67 17.83q-51 17.84-98 51.5 47 36.34 97.67 52.17 50.67 15.83 105 15.83Zm0-366.66q31.33 0 51.33-20t20-51.34q0-31.33-20-51.33T480-656q-31.33 0-51.33 20t-20 51.33q0 31.34 20 51.34 20 20 51.33 20Zm0-71.34Zm0 369.34Z"/></svg></a>
                    </li>
                    <li class="header_account">
                        <a href="log-in.php">Log In | Sign Up</a>
                    </li>
                </ul>
            </nav>

            <a href="menu.php"><img src="img/icons/logo.png" id="logo" alt="Icon du logo"></a>

            <div class="search_container">
                <ul>
                    <li>
                        <a href=""><svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="size_icon" height="40px" viewBox="0 -960 960 960" width="40px" ><path d="M792-120.67 532.67-380q-30 25.33-69.64 39.67Q423.39-326 378.67-326q-108.44 0-183.56-75.17Q120-476.33 120-583.33t75.17-182.17q75.16-75.17 182.5-75.17 107.33 0 182.16 75.17 74.84 75.17 74.84 182.27 0 43.23-14 82.9-14 39.66-40.67 73l260 258.66-48 48Zm-414-272q79.17 0 134.58-55.83Q568-504.33 568-583.33q0-79-55.42-134.84Q457.17-774 378-774q-79.72 0-135.53 55.83-55.8 55.84-55.8 134.84t55.8 134.83q55.81 55.83 135.53 55.83Z"/></svg></a>
                    </li>
                    <li>
                        <svg xmlns="http://www.w3.org/2000/svg" id="dmode"  fill="currentColor" class="size_icon" height="40px" viewBox="0 -960 960 960" width="40px"><path d="M480-120q-150 0-255-105T120-480q0-150 105-255t255-105q10 0 20.5.67 10.5.66 24.17 2-37.67 31-59.17 77.83T444-660q0 90 63 153t153 63q53 0 99.67-20.5 46.66-20.5 77.66-56.17 1.34 12.34 2 21.84.67 9.5.67 18.83 0 150-105 255T480-120Zm0-66.67q102 0 179.33-61.16Q736.67-309 760.67-395.67q-23.34 9-49.11 13.67-25.78 4.67-51.56 4.67-117.46 0-200.06-82.61-82.61-82.6-82.61-200.06 0-22.67 4.34-47.67 4.33-25 14.66-55-91.33 28.67-150.5 107-59.16 78.34-59.16 175.67 0 122 85.66 207.67Q358-186.67 480-186.67Zm-6-288Z"/></svg>
                    </li>
                </ul>  
            </div>
        </div> 

        <script>
            //darkmode
            let button = document.getElementById ('button');
            let body = document.getElementById ('body');
            let dmode = document.getElementById('dmode');

            dmode.addEventListener('click', function(){
                body.classList.toggle('darkmode')
            });
        </script>
    </header>

    <main>
        <section>
            <div class="profilName">
                <?php
                    echo $_SESSION["name"];
                ?>
            </div>
        </section>

        <section class="profilInfos">
            <h2 class="h2Infos">Your email</h2>
            <div class="profilEmail">
                <?php
                    echo $_SESSION["email"];
                ?>
            </div>
        </section>

        <div class="profilDeconnexion">
            <a href="?action=deconnexion">Se déconnecter</a>
        </div>
        
    </main>

</body>
</html>