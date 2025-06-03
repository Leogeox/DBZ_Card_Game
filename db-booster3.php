<?php
require_once("session.php");
require_once("connexion.php");
include "includes/header.html";

$user = $_SESSION["iduser"];

// etch countdown from DB
$stmt = $pdo->prepare("SELECT time_started, duration FROM user WHERE iduser = ?");
$stmt->execute([$user]);
$countdown = $stmt->fetch(PDO::FETCH_ASSOC);


// set time_started and duration when "restart" is clicked
if ($countdown['time_started'] == 0 && (isset($_GET["action"]) && $_GET["action"] === "restart")) {
    sleep(3);
    $duration = 10;
    $timeStarted = time(); 

    $stmt = $pdo->prepare("UPDATE user SET time_started = :time_started, duration = :duration WHERE iduser = :iduser");
    $stmt->execute([
        'time_started' => $timeStarted,
        'duration' => $duration,
        'iduser' => $user
    ]);
}

// calculate countdown if data exists
if ($countdown && $countdown['time_started'] && $countdown['duration']) {
    $timeSince = time() - $countdown['time_started'];
    $remaining = max(0, $countdown['duration'] - $timeSince);

    if ($remaining <= 0) {
        // ✅ Optionally clear countdown after it's finished
        $stmt = $pdo->prepare("UPDATE user SET time_started = NULL, duration = NULL WHERE iduser = :iduser");
        $stmt->execute(['iduser' => $user]);
        // echo "Countdown finished!";
    } else {
        // echo "$remaining seconds remaining.";
    }
    
} else {
    // echo "No countdown started";
}

// echo "<pre>";
// print_r($_GET);
// echo "</pre>";


?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Votre sélection de cartes Dragonball favorites : suivez, admirez et complétez votre deck parfait.">
    <title>DragonballTCG Booster</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/icons/favicon.png">
</head>

<body id="body">

    <main class="main_bg">
        <section>
            <nav class="top_text">
                <ul>
                    <li>
                        <a href="#" class="nav_text tab_1 tab_active">Your boosters</a>
                        <div class="content tab1">
                            <h1 class="tab_title">Boosters</h1>
                            <div class="tabs_container">
                                <div class="inside_tab">
                                    <a href="db-booster1.php"><img src="img/boosters/DB Booster 1.png" alt=""></a>
                                </div>
                            <div class="inside_tab">
                                <a href="db-booster2.php"><img src="img/boosters/DB Booster 2.png" alt=""></a>
                            </div>
                            <div class="inside_tab">
                                <a href="db-booster3.php"><img src="img/boosters/DB Booster 3.png" alt=""></a>
                            </div>
                        </div>
                    </li>
                        
                    <!-- <li>
                        <a href="cards.php" class="nav_text tab_2" >??</a>
                        <div class="content tab2">
                            <h1 class="tab_title"></h1>
                            <div class="tabs_container">
                            </div>
                        </div>
                    </li>   -->
                </ul>
            </nav>
        </section>

        <section>
            <div class="openbooster_container">
                <img class="booster " src="img/boosters/DB Booster 3.png" alt="">
                <a class="openBtn btnB3" href="?action=restart">Open Booster</a>
            </div>
        </section>

        <section class="container containerBottom"> <!-- booster -->
            <div class="cards-booster boosternone">
            s<script>
                const remaining = parseInt('<?php echo $remaining ?>');   
                let openBtn = document.querySelector('.openBtn');
                let cards = document.querySelectorAll('.boosternone');

                document.addEventListener('DOMContentLoaded', function () {

                    openBtn.addEventListener('click', function () {
                        if (remaining === 0) {

                            cards.forEach((card) => {
                                card.classList.add('boostershow');
                                card.classList.remove('boosternone');
                            });

                            async function fetchCharacters(count = 5) {
                                let response = await fetch('https://dragonball-api.com/api/characters?limit=58');
                                const data = await response.json();
                                let min = 39;
                                let max = 58;
                                let random = data.items.slice(min, max);
                                let randomId = random.sort(() => 0.5 - Math.random()).slice(0, count);
                                return randomId;
                            }

                            //affichage infos perso dans les cartes
                            async function displayCharacters() {
                                let data = await fetchCharacters();
                                const booster = document.querySelector('.cards-booster');
                                booster.innerHTML = ''; //vide contenu du container

                                //creer div pour chaque carte creer
                                data.forEach(character => {
                                    let card = document.createElement('div')
                                    card.classList.add('card');

                                    //contenu de la carte (data)
                                    card.innerHTML = `
                                        <img class="cardsImg" src="${character.image}" alt="${character.name}" />
                                        <h2>${character.name}</h2>
                                        <h5>${character.race}</h5>
                                        <h5>${character.affiliation}</h5>
                                        <div class="powerContainer">
                                            <h4>Power: ${character.ki}</h4>
                                        </div>
                                    `;

                                    booster.appendChild(card);

                                    fetch("readJSON.php", {
                                        "method": "POST",
                                        "headers": {
                                            "Content-Type": "application/json; charset=utf-8"
                                        },
                                        "body": JSON.stringify(character)
                                    }).then(function(response){
                                        return response.text();
                                    }).then(function(data){
                                        console.log(data);
                                    });

                                });
                            }
                            

                            displayCharacters();

                        } else {
                            alert(`Please wait ${remaining} seconds before opening again.`);
                        }
                    });
                });
            </script>
            </div>
        </section>

        <div class="trade_container">
            <img class="trade" src="img/icons/trade.png" alt="Trading cards">
        </div>

        <div class="none_trade" id="interaction">
            <h2 class="trade_title">Trade Center</h2>
            <form class="interact_form" action="">
                <h3> Would like to make trade with</h3>
                <select name="friend" id="frient_select">
                    <option value="">friend's username</option>
                    <option value="name">Gérard</option>
                    <option value="name">Jean-Batispte</option>
                </select>
                <h3>with</h3>
                <select name="cardToGive" id="card_to_give">
                    <option value="">your card's name</option>
                    <option value="dog">Goku</option>
                    <option value="cat">Vegeta</option>
                    <option value="dog">Chichi</option>
                    <option value="cat">Gohan</option>
                </select>
                <h3>for</h3>
                <select name="cardToGet" id="card_to_get">
                    <option value="">their card's name</option>
                    <option value="dog">Goku</option>
                    <option value="cat">Vegeta</option>
                    <option value="dog">Chichi</option>
                    <option value="cat">Gohan</option>
                </select>
            </form>
            <button id="trade_finish">Send</button>
        </div>
    </main>

    <?php
    include "includes/footer.html";
    ?>
    <script src="js/index.js"></script>
</body>
</html>
