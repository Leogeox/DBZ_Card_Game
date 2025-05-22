<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Description</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/icons/favicon.png">
</head>
<body>
    <script>
        async function fetchCharactersChoosen() {
            // nouveau parametre 
            let urlParams = new URLSearchParams(window.location.search); // utiliser pour extraire l'id du perso qui est dans l'url apres le ? (mit en place dans la page menu) ex lorsque l'on appuie sur la carte Goku, l'url montre "id=1". Ce parametre prend cette expression
            let characterId = urlParams.get('id'); // fait un let qui prend l'id 

            let response = await fetch(`https://dragonball-api.com/api/characters/${characterId}`); // qui est alors utiliser ici pour chercher le personna selon son id
            const data = await response.json();
            return data; 
        }

        async function displayCharacter() {
            let data = await fetchCharactersChoosen();
            // recupere le personnage selon son id
            let body = document.querySelector('body');
            body.classList.add('cardDescription');
            body.innerHTML = `
                <div class="desc">
                <img src="${data.image}" alt="${data.name}" />
                </div>
                <div class="desc">
                <h1>${data.name}</h1>
                <h2>${data.race}</h2>
                <h2>${data.affiliation}</h2>
                <h3>Ki: ${data.ki}</h3>
                <h3>Maximum Ki:${data.maxKi}</h3>
                <h2>${data.gender}</h2>
                <p>${data.description}</p>
                </div>
            `; 
        }

        window.addEventListener('DOMContentLoaded', displayCharacter);
    </script>
</body>
</html>