<?php

require_once("connexion.php");

if($_POST){
    //infos
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    //ajoute info dans la bdd
    $sql = "INSERT INTO user (name, email, password) VALUES(:name, :email, :password)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_DEFAULT)
    ]);
    header("location:profil.php"); //redirige vers login
    exit;
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Votre sélection de cartes Undertale favorites : suivez, admirez et complétez votre deck parfait.">
    <title>Sign Up</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/x-icon" href="img/icons/favicon.png">
</head>

<body class="background" id="body">

    <section class="connection">
        <a href="menu.php"><img src="img/icons/logo.png" id="logo_account" alt="Icon du logo"></a>
    
        <div class="message-error">
            <ul> </ul>
        </div>
            
        <div class="message-success">
            <ul> </ul>
        </div>

        <form method="POST" id="form">
            <h1>Create your account</h1>
            <input type="text" name="name" id="name" placeholder="Name" class="enter" size="50" required>
            <input type="email" name="email" id="email" autocomplete="email" placeholder="Email" class="enter" size="50" required>
            <input type="password" name="password" id="password" placeholder="Password" class="enter" size="50" required>
            <input type="password" name="password2" id="password2" placeholder="Verify password" class="enter" size="50" required>
    
            <input class="signup" type="submit" value="Sign Up">
            <p class="border"></p>
        </form>
    </section>
    
    <script src="js/form.js"></script>
</body>
</html>
