<?php

$dsn = 'mysql:host=localhost;dbname=citations'; //variable contenant le lien de connexion et la bdd

try {
    $pdo = new PDO($dsn, 'root', ''); //Instanciation de l'objet PDO pour initialiser la connexion avec le lien et la bdd, l'utilisateur, et le mot de passe
    $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //ajout de l'attribut ERRMODE pour déclarer une erreur en cas de problème
                                                                    //ajout de l'attribut ERRMODE_EXCEPTION pour récupérer le message d'erreur en cas de problème

    $pdo -> setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC); //ajout de l'attribut DEFAULT_FETCH_MODE pour ensuite avec FETCH_ASSOC récupérer les données sous forme de tableau associatif
} catch (PDOException $e) { //Si le try échoue, on affiche le message d'erreur en dessous

    die('Probleme avec la base de donnees : ' . $e -> getMessage()); //le message en question

}