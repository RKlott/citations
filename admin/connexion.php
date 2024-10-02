<?php
session_start();
require_once 'pdo.php';

if (!empty($_POST['mail']) && !empty($_POST['password'])) { //Si l'email et le mot de passe envoyé ne sont pas vides :
    $sql = 'SELECT users.password FROM users WHERE users.mail = ?'; //*Récupère le Mot de passe dans la table Users lié à l'Email renseignée en requête préparée (?)
    $q = $pdo->prepare($sql); //On instancie la requête préparée
    $q->execute([$_POST['mail']]); //On passe en paramètre à la requête préparée la valeur de l'email récupérée depuis la méthode POST et on exécute la requête
    $hash = $q->fetchColumn(); //récupération du mot de passe en base de donnée
    $hash = (!$hash) ? '000000' : $hash; //si le mot de passe est null, on passe à notre variable $hash la valeur par défaut "000000", sinon on lui passe la valeur du mdp en bdd
    if (password_verify($_POST['password'], $hash)) { //on vérifie que le mot de passe recupérée depuis la méthode POST corresponds au mot de passe stocké en bdd lié à l'email
        /**connexion de l'utilisateur */
        $sql = 'SELECT users.id, users.firstname, users.lastname, users.mail FROM users WHERE users.mail = ?'; //*Récupère l'ID, le Prénom et le Nom dans la table Users lié à l'Email renseignée en requête préparée
        $q = $pdo->prepare($sql); //On instancie la requête préparée
        $q->execute([$_POST['mail']]); //On passe en paramètre à la requête préparée la valeur de l'email récupérée depuis la méthode POST et on exécute la requête
        $profil = $q->fetch(); //On récupère toutes les informations demandées dans la requête SQL

        $_SESSION['profil'] = $profil;
    } else { //Si le mot de passe récupérée en requête POST ne corresponds pas au mot de passe lié à l'email dans la base de donnée :
        $msg = [
            'code' => 'bg-warning',
            'text' => 'Identifiants incorrects!'
        ]; //Message d'erreur de connexion
    }
}

if (isset($_SESSION['profil'])) {
    header('Location: index.php');
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./public/css/styles.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Connexion | Citations</title>
</head>

<body>
    <?php if (isset($msg)): ?> <!--Si le message d'erreur est défini :-->
        <div class="msg <?= $msg['code'] ?>"> <!--On l'affiche, et on lui passe en class la couleur du code erreur-->
            <?= $msg['text'] ?> <!--Puis on affiche le message défini dans la variable 'text' du message-->
        </div>
    <?php endif ?>

    <form action="connexion.php" method="post"> <!-- Méthode post pour ENVOYER les données-->
        <h1 class="title">Se connecter</h1>
        <div class="field">
            <label for="mail">Votre mail</label>
            <input type="email" name="mail" id="mail"> <!--Variable email qui sera envoyé par la méthode POST -->
        </div>
        <div class="field">
            <label for="password">Votre mot de passe</label>
            <input type="password" name="password" id="password"> <!--Variable password qui sera envoyé par la méthode POST -->
        </div>
        <button type="submit" class="btn btn-primary">Se connecter</button> <!-- Envoi des données du formulaire (email & password) -->
    </form>
</body>

</html>