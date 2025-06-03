<?php
require_once("session.php");
require_once("connexion.php");


$user = isset($_SESSION["iduser"]);


if(isset($_POST)){
    $data = file_get_contents(filename: "php://input");
    $characters = json_decode(json: $data, associative: true);
    $user = $_SESSION["iduser"];
    // echo $characters["id"], $user;


    $idcard = $characters["id"];
    $image = $characters["image"];
    $name = $characters["name"];
    $race = $characters["race"];
    $affiliation = $characters["affiliation"];
    $ki = $characters["ki"];
    $favorite = null;
    // echo $favorite;
    // echo $user;
    echo $idcard, $image, $name, $race, $affiliation, $ki;

    //ajoute info dans la bdd
    $sql = "INSERT INTO cardsowned (idcard, image, name, race, affiliation, ki, favorite, iduser) VALUES(:idcard, :image, :name, :race, :affiliation, :ki, :favorite, :iduser)";

    $stmt = $pdo->prepare(query: $sql);
    $stmt->execute(params: [
        'idcard' => $idcard,
        'image' => $image,
        'name' => $name,
        'race' => $race,
        'affiliation' => $affiliation,
        'ki' => $ki,
        'iduser' => $user,
        'favorite' => $favorite,
    ]);
}

