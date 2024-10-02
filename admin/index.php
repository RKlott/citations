<?php
session_start();

if (!isset($_SESSION['profil'])) { //Si la variable de session profil n'est pas définie :
    header('Location: connexion.php'); //retour à la page de connexion
}

if(isset($_POST['action'])){
    switch ($_POST['action']) {
        case 'fn_modifier':
            $newFirstName = isset($_POST['fn_modifier']) ? $_POST['fn_modifier'] : '';
            //appel de la fonction de modification de prenom ici
            break;
        
        default:
            # code...
            break;
    }
}


?>


<?php require_once './include/head.php'; ?>

<main class="container">
    <h1>Informations du profil</h1>

    <form action="index.php" method="post">
        <span>
            <label for="fn_modifier">Prénom : <?= $_SESSION['profil']['firstname'] ?></label> <br>
            <input type="text" name="fn_modifier" id="fn_modifier"> <!--firstname_modifier-->
            <button type="submit" name="action" value="fn_modifier" class="btn btn-primary">Modifier</button> <br>
        </span>

        <span>
            <label for="ln_modifier">Prénom : <?= $_SESSION['profil']['lastname'] ?></label> <br>
            <input type="text" name="ln_modifier" id="ln_modifier"> <!--lastname_modifier-->
            <button type="submit" name="action" value="ln_modifier" class="btn btn-primary">Modifier</button> <br>
        </span>

        <label for="mail_modifier">Mail : <?= $_SESSION['profil']['mail'] ?></label> <br>
        <input type="text" name="mail_modifier" id="mail_modifier"> <!--mail_modifier-->
        <button type="submit" name="action" value="mail_modifier" class="btn btn-primary">Modifier</button> <br>
    </form>

</main>

<?php require_once './include/tail.php'; ?>