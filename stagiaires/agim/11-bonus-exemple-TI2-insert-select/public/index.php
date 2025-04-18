<?php




require_once('../config.dev.php');
require_once('../models/messageModel.php');

try {
    $conn = new PDO(DB_DSN, DB_USER, DB_PWD, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (Exception $e) {
    die("Connexion impossible : " . $e->getMessage());
}



$recupMessage = getMessageByDesc($conn);
$totalMessageSousEntier = recup_total_messages_sous_entier($conn);


if(isset($_POST['name'],$_POST['email'],$_POST['message'])){

    // on va tenter l'insertion, car on a protégé addMessage()
    $insert = enregistrement_nom_message_utilisateur($db,$_POST['name'],$_POST['message']);

    if($insert===true){
        $thanks = "Merci pour votre nouveau message";
    }else{
        $error = $insert;
    }

}





if(isset($_GET[PAGINATION_GET])&& ctype_digit($_GET[PAGINATION_GET])){
    $page = (int) $_GET[PAGINATION_GET];
}else{
    $page = 1;
}

$nbTotMessage = recup_total_messages_sous_entier($conn);

$pagination = pagination($nbTotMessage, PAGINATION_GET, $page, PAGINATION_NB);

$offset = ($page-1)*PAGINATION_NB;

$messages = recup_messages_par_page($conn,  $offset, PAGINATION_NB);

require_once('../views/page.view.php');

$conn = null;
