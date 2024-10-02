<?php
session_start();
require_once 'pdo.php';

    if(!isset($_GET['id'])){ //si la variable 'id' n'est pas définie en url :
        $_SESSION['msg'] = [ //le message d'erreur stocké dans une variable de session "msg"
            "code" => "bg-warning",
            "text" => "La citation demandée n'existe pas."
        ];
        header('Location : index.php'); //retour à la page d'accueil, qui affichera le message d'erreur
    }

    $sql = 'SELECT * FROM citations
    WHERE id=?'; //Récupère TOUTE les informations contenues dans la table citations, où l'id corresponds avec la valeur passée plus tard en requête préparée

    $q = $pdo -> prepare($sql); //Instanciation de la requête préparée
    $q -> execute([$_GET['id']]); //On passe en paramètre l'id en URL à la requête préparée et on l'exécute

    $citation = $q -> fetch(); //On récupère toutes les informations demandées à la base de données et on les sauvegarde dans la variable $citation

?>

<?php require_once "include/head.php"; ?>
<main class="container">
    <h1 class="title">Une citation</h1>
    <div class="citation">
        <blockquote>
            <?= $citation['citation'] ?> <!--On affiche la citation complète récupérée en bdd-->
        </blockquote>

        <?php if(!is_null($citation['explication'])): ?> <!--Si la colonne 'explication' de la citation parcourue n'est pas vide en bdd : -->
        <div class="explication">
            <h2>Explication</h2>
            <div class="content">
                <?= $citation['explication'] ?> <!--On affiche l'explication ici, si elle est null, on affiche rien-->
            </div>
        </div>
        <?php endif ?> <!--Fin de la boucle if-->
    </div>
</main>
<?php require_once "include/tail.php"; ?>