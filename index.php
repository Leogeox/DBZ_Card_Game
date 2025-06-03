<?php 
require_once("connexion.php");
require_once("session.php");
include "includes/header.html";

?> 


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Votre sélection de cartes Dragonball favorites : suivez, admirez et complétez votre deck parfait.">
    <title>DragonballTCG Menu</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
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
        
        <div class="swiper mySwiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide"><img class="img" src="img/swiper/swiper1.png" alt=""></div>
                <div class="swiper-slide"><img class="img" src="img/swiper/swiper2.png" alt=""></div>
                <div class="swiper-slide"><img class="img" src="img/swiper/swiper3.png" alt=""></div>
            </div>
            <div class="swiper-pagination"></div>
                <div class="autoplay-progress">
                <span></span>
            </div>
        </div>

         <section class="container_filters">
            <nav class="filters">
                <ul>
                    <li class="txt_filters" id="saiyan_tab">
                        <p>Saiyan</p>
                    </li>
                    <li class="txt_filters" id="god_tab">
                        <p>God</p>
                    </li>
                    <li class="txt_filters" id="human_tab">
                        <p>Human</p>
                    </li>
                    <li class="txt_filters" id="android_tab">
                        <p>Android</p>
                    </li>
                    <li>
                        <form id="form_search">
                            <input type="text" name="search" id="search" placeholder="Vegeta..."> 
                        </form>
                    </li>
                    <li>
                        <button id="reset_btn">reset</button>
                    </li>
                </ul>
            </nav>
            <script>
                //rechercher perso
                window.onload = function () {
                    var searchCard = document.getElementById("search");

                    //prend valeur input (barre de recher) -> comparer infos avec les datas dans les cartes
                    if (searchCard) {
                        searchCard.addEventListener("input", function () {
                            var searchText = searchCard.value.toLowerCase();
                            var insideCards = document.querySelectorAll(".card-container .card");

                            insideCards.forEach(function (card) {
                                var cardText = card.textContent.toLowerCase();

                                //si info existe le montre si pas le cas cache
                                if (cardText.includes(searchText)) {
                                    card.style.display = "";
                                } else {
                                    card.style.display = "none";
                                }
                            });
                        });
                    }
                };  
            </script>
        </section>

        <section class="card-container" >
            <script>
                //recup personnages de l'api
                async function fetchCharacters() {
                   let response = await fetch('https://dragonball-api.com/api/characters?limit=58');
                    const data = await response.json();
                    return data['items'];
                }

                //affichage infos perso dans les cartes
                async function displayCharacters() {
                    let data = await  fetchCharacters();
                    let container = document.querySelector('.card-container');
                    container.innerHTML = ''; //vide contenu du container
                    
                    //creer div pour chaque carte creer
                    data.forEach(character => {
                        let card = document.createElement('div')
                        card.classList.add('card', character.race.replace(/\s+/g, ''));

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
                        
                        card.addEventListener('click', function () {
                            let url = `card.php?id=${character.id}`;
                            window.open(url);
                        });

                        container.appendChild(card);
                    });
                }

                window.addEventListener('DOMContentLoaded', displayCharacters);
            </script>
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
                    <option value="card">Goku</option>
                    <option value="card">Vegeta</option>
                    <option value="card">Chichi</option>
                    <option value="card">Gohan</option>
                </select>
                <h3>for</h3>
                <select name="cardToGet" id="card_to_get">
                    <option value="">their card's name</option>
                    <option value="card">Goku</option>
                    <option value="card">Vegeta</option>
                    <option value="card">Chichi</option>
                    <option value="card">Gohan</option>
                </select>
            </form>
            <button id="trade_finish">Send</button>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
        
            //recup filtres
            let btnSaiyan = document.getElementById("saiyan_tab");
            let btnGods = document.getElementById("god_tab");
            let btnHuman = document.getElementById("human_tab");
            let btnAndroid = document.getElementById("android_tab");

            //recup tte cartes
            function getAllCards() {
                return document.querySelectorAll(".card");
            }

            //afficher cartes d'une race
            function showOnly(race) {
                getAllCards().forEach(card => {
                    if (card.classList.contains(race)) {
                        card.style.display = "";
                    } else {
                        card.style.display = "none";
                    }
                });
            }

            //1 filtre => 1 race 
            btnSaiyan.addEventListener("click", function () {
            showOnly("Saiyan");
            });

            btnGods.addEventListener('click', function(){
                showOnly('God');
            })

            btnHuman.addEventListener('click', function(){
                showOnly('Human');
            })

            btnAndroid.addEventListener('click', function(){
                showOnly('Android');
            })
        });

        //fonction afficher cartes
        function showAllCards() {
            document.querySelectorAll(".card").forEach(card => {
                card.style.display = "";
            });
        }

        //reset affichage carte
        let resetButton = document.getElementById("reset_btn");
        resetButton.addEventListener("click", function () {
            showAllCards();

            //vide bare recherche
            document.getElementById("search").value = "";
        });
    </script>

    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script>
        var swiper = new Swiper(".mySwiper", {
            spaceBetween: 30,
            centeredSlides: true,
            autoplay: {
                delay: 2500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            }
        });
    </script>

    <?php
    include "includes/footer.html";
    ?>
    <script src="js/index.js"></script>
</body>
</html>
