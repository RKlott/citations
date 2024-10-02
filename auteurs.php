<?php
session_start();
require_once 'pdo.php';

$sql = 'SELECT * FROM auteurs'; //Récupère TOUTES les informations de la table auteur
$q = $pdo->query($sql); //On exécute la requête
$auteurs = $q->fetchAll(); //On récupère toutes les informations demandées à la base de données et on les sauvegardes dans la variables '$auteurs'

?>

<?php require_once 'include/head.php'; ?>

<?php if (isset($_SESSION['msg'])): ?> <!--Si la variable de session 'msg' est définie : -->
    <div class="msg <?= $_SESSION['msg']['code'] ?>"> <!--On ajoute le code couleur contenue dans la variable à la class de cette div-->
        <?= $_SESSION['msg']['text'] ?><!--On ajoute le texte contenu dans la variable "text" de la variable(tableau) de session 'msg'-->
    </div>
<?php unset($_SESSION['msg']); //on supprime la variable de session 'msg'
endif ?>

<main class="container">
    <h2 class="title">Les Auteurs</h2>

    <div class="cards">
        <?php foreach ($auteurs as $auteur): ?> <!--On utilise la boucle forEach pour parcourir les informations de la table 'auteurs' récupérée en bdd, actuellement stockées dans la variable locale '$auteurs'-->
            <div class="card" style="width: 18rem;">
                <img src="public/<?= $auteur['image_src'] ?>" class="card-img-top" alt="<?= $auteur['auteur']?>"> <!--On récupère le chemin d'image stocké en bdd pour l'auteur actuellement parcouru-->
                <div class="card-body">
                    <h5 class="card-title"><?= $auteur['auteur']?></h5> <!--On récupère le nom de l'auteur stocké pour l'auteur actuellement parcouru-->

                    <?php if(!is_null($auteur['bio'])): ?> <!--Si la bio de l'ateur n'est pas null : -->
                    <div class="card-text"><?= substr($auteur['bio'], 0, 100)?></div> <!--On l'affiche ici sur 100 caractères max-->
                    <?php endif ?> <!--Fin de la boucle if-->

                    <a href="auteur.php?id=<?= $auteur['id']?>" class="btn btn-primary">Lire la suite</a> <!--On définie en URL l'id de l'auteur pour rediriger l'utilisateur vers une page dédiée à l'auteur contenant d'avantage d'informations spécifiques le concernant-->
                </div>
            </div>
    </div>
<?php endforeach ?> <!--Fin de la boucle forEach-->

</main>
<?php require_once 'include/tail.php'; ?>