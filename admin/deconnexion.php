<?php
session_start();

unset($_SESSION['profil']); //On supprime la variable de session 'profil' avec tout son contenu (on déconnecte donc l'utilisateur, nous n'avons pour ses informations)
header('Location: index.php'); //on le redirige vers la page de connexion