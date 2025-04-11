<?php
# public/index.php

/*
 * Contrôleur frontal
 */

# chargement des constantes de connexion en mode prod
require_once "../config.php";
# chargement du modèle (fonctions)
require_once "../model/MessagesModel.php";


# connexion à PDO
try {
    $db = new PDO(
        DB_DSN,
        DB_CONNECT_USER,
        DB_CONNECT_PWD,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (Exception $e) {
    $e->getMessage();
}

# ici notre code de traitement de la page

if (isset($_POST['surname'], $_POST['email'], $_POST['message'])) {
    if (!empty($_POST['surname']) && !empty($_POST['email']) && !empty($_POST['message'])) {
        $surname = $_POST['surname'];
        $email = $_POST['email'];
        $message = $_POST['message'];

        if (createArticles($db, $surname, $email, $message)) {
            echo "Données insérées avec succès !";
            header('Location: ./'); 
            exit();
        } else {
            echo "Erreur lors de l'insertion des données.";
        }
    } else {
        echo "Tous les champs du formulaire sont obligatoires. Veuillez remplir tous les champs.";
    }
} else {
    echo "Données du formulaire non reçues.";
}
// on veut récupérer tous les messages de la table `article` par date DESC
$message = getArticles($db);




# chargement de la vue
require_once "../view/homepage.view.php";

# bonne pratique
# fermeture de connexion
$db = null;
