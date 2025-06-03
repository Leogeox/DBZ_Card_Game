<?php
require_once("session.php");
require_once("connexion.php");
include "includes/header.html";


//si pas connecter diriger vers login
if(!isset($_SESSION["iduser"])) {
    header("Location: login.php");
}

    // je vide ma session quand appuie sur deconnecter
if(isset($_GET["action"]) && $_GET["action"] == "deconnexion") {
    unset($_SESSION["iduser"]);
    unset($_SESSION["email"]);
    header("Location: login.php"); // redirection login
}

try {
    $stmt = $pdo->prepare("SELECT * FROM cardsowned WHERE iduser = :iduser");
    $stmt->execute(['iduser' => $_SESSION["iduser"]]);
    $cards = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}


try {
    $stmt = $pdo->prepare("SELECT favorite FROM cardsowned WHERE iduser = :iduser");
    $stmt->execute(['iduser' => $_SESSION["iduser"]]);
    $favorite = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}

// echo "<pre>";
// echo var_dump($favorite) . "<br>";
// echo "</pre>";

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Votre sélection de cartes Dragonball favorites : suivez, admirez et complétez votre deck parfait.">
    <title>Dragonball Profil</title>
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
            <div class="profilName">
                <?php
                    echo $_SESSION["name"];
                ?>
            </div>

            <div class="profilInfos">
                <h2 class="h2Infos">Your email</h2>
                <div class="profilEmail">
                    <?php
                        echo $_SESSION["email"];
                    ?>
                </div>
            </div>

        </section>

        <section class="profilInfos">
            <h2 class="h2Infos">CARDS OWNED</h2>
            <div class="cardsSection">
                <script>
                    const cards = <?php echo json_encode($cards); ?>;
                    const favorites = <?php echo json_encode($favorite); ?>;

                    function displayOwnedCards() {
                        const cardContainer = document.querySelector('.cardsSection');
                        cardContainer.innerHTML = ''; // clear

                        cards.forEach(card => {
                            let section = document.createElement('div');
                            let cardDiv = document.createElement('div');
                            cardDiv.classList.add('card');
                            let favDiv = document.createElement('div');

                            cardDiv.innerHTML = `
                                <img class="cardsImg" src="${card.image}" alt="${card.name}" />
                                <h2>${card.name}</h2>
                                <h5>${card.race}</h5>
                                <h5>${card.affiliation}</h5>
                                <div class="powerContainer">
                                    <h4>Power: ${card.ki}</h4>
                                </div>
                            `;

                            favDiv.innerHTML = `
                                <img class="fav" src="img/icons/fav.png" alt="" data-id="favorite">
                                <img class="favfull favnone" src="img/icons/fullfav.png" alt="" data-id="favorite">
                            `;

                            section.appendChild(cardDiv);
                            section.appendChild(favDiv);
                            cardContainer.appendChild(section);
                        });
                    }
                    
                    displayOwnedCards();
                    

                    let favs = document.querySelectorAll('.fav')
                    let favfulls = document.querySelectorAll('.favfull')  

                    favs.forEach((fav, index) => {
                        fav.addEventListener('click', function() {
                            fav.classList.add('favnone')
                            favfulls[index].classList.remove('favnone')
                            favfulls[index].addEventListener('click', function() {
                                fav.classList.remove('favnone')
                                favfulls[index].classList.add('favnone')
                            })
                        })
                    })
                    
                </script>
            </div>
        </section>

        <div class="profilDeconnexion">
            <a href="?action=deconnexion">Se déconnecter</a>
        </div>

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