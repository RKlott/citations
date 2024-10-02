<?php
session_start();

require_once 'pdo.php';

//récupération des citations
/**
 * Récupère l'ID des citations (qu'on utilisera avec "id_citations"), récupère les citations avec 'citations.citation', RECUPERE l'ID des auteurs (qu'on utilisera avec id_auteurs),
 * récupère les auteurs avec 'auteurs.auteur'. 
 * Récupère tout cela depuis la table 'citations' (pour la première partie de la requête)
 * Fait une jointure avec la table 'auteurs' en liant l'ID de l'auteur (auteurs.id) avec l'id des citations (citations.id)
 */
$sql = 'SELECT citations.id as id_citations, citations.citation, auteurs.id as id_auteurs, auteurs.auteur
FROM citations
LEFT JOIN auteurs ON auteurs.id = citations.id';

$q = $pdo->query($sql); //Execute la requête sql

$citations = $q->fetchAll(); //récupère toutes les informations demandées dans la requêtes et sauvegarde-les dans la variable "citations"

?>

<?php require_once __DIR__ . '/include/head.php' ?>

<?php if (isset($_SESSION['msg'])): ?> <!--Si la variable de session 'msg' est définie :-->
    <div class="msg <?= $_SESSION['msg']['code'] ?>"> <!--Ajoute le code couleur définie dans le tableau de variable 'msg' en class-->
        <?= $_SESSION['msg']['text'] ?> <!--Ajoute le texte contenu dans la variable 'text' du tableau de variables 'msg'-->
    </div>
<?php unset($_SESSION['msg']); //on supprime le tableau de variable de session 'msg'
endif ?>


<main class="container">
    <h1 class="title">Les citations</h1>
    <ul class="list-group">
        <?php foreach ($citations as $citation): ?> <!--Utilisation d'une boucle forEach pour parcourir les informations des citations stocké dans la dite variable :-->
            <li class="list-group-item my-2">
                <blockquote>
                    <a href="citation.php?id=<?= $citation['id_citations'] ?>"> <!--Ajout de l'id de la citation à l'URL en utilisant l'id stocké en bdd-->
                        <?= $citation['citation'] ?> <!--Affichage de la citation actuellement parcourue en contenu de lien-->
                        
                    </a>
                </blockquote>

                <cite>
                    <?= $citation['auteur'] ?> <!--Affichage de l'auteur de la citation (grâce à la liaison des ID d'auteur et de citation, on as la possibilité de récupérer l'auteur-->
                                                <!--ayant un ID correspondant à celle de la citation-->
                </cite>
            </li>

        <?php endforeach ?> <!--Fin de la boucle forEach-->

    </ul>
</main>

<?php require_once __DIR__ . '/include/tail.php' ?>