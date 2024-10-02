<?php
session_start();
require 'pdo.php';

if (!isset($_GET['id'])) { //Si la variable id n'est pas définie en URL :
    $_SESSION['msg'] = [
        "code" => "bg-warning",
        "text" => "L'auteur demandé n'existe pas."
    ];
    header('Location : auteurs.php'); //retour à la page des auteurs
}

$sql = 'SELECT * FROM auteurs
WHERE auteurs.id = ?'; //Récupère TOUTES les informations dans la table 'auteurs' liés à l'ID '?' définie en requête préparée
$q = $pdo->prepare($sql); //Instanciation de la requête préparée
$q->execute([(int) $_GET['id']]); //On passe en paramètre la valeur ID définie en URL (qu'on cast bien en INT (par défaut, c'est un string)) et on exécute la requête

$auteur = $q->fetch(); //on récupère les informations demandées à la base de données

?>

<?php require_once "include/head.php"; ?>
<main class="container">
    <h1 class="title"><?= $auteur['auteur'] ?> <br></h1> <!--On affiche le nom de l'auteur correspondant, stocké dans la variable $auteur-->
    <img src="public/<?= $auteur['image_src'] ?>" class="img-fluid" alt="<?= $auteur['auteur'] ?>"> <!--On affiche le lien de l'image de l'auteur, et on ajoute son nom en alt-->
    <h2 class="title">Naissance : <?= $auteur['naissance'] ?> <br></h2> <!--On ajoute sa date de naissance, stocké dans la variable $auteur-->
    <?php if (!is_null($auteur['bio'])): ?> <!--Si la bio de l'auteur n'est pas null : -->
        <div><?= $auteur['bio'] ?></div> <!--On ajoute sa bio, sinon, si elle est null, rien ne s'affichera-->
    <?php endif ?> <!--Fin de la boucle if-->
</main>
<?php require_once 'include/tail.php'; ?>