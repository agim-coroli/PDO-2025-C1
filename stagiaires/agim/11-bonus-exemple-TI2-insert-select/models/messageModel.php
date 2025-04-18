<?php
require_once('utilities.php');
function getMessageByDesc(PDO $db): array
{
    $query = $db->query('SELECT * FROM messages ORDER BY message, created_at DESC');
    return $query->fetchAll();
}

function enregistrement_nom_message_utilisateur(PDO $db, string $nom, string $message): bool|string
{
    $error = "";
    // Nettoyage des entrées utilisateur pour éviter les failles XSS
    $cleanNom = trim(htmlspecialchars(strip_tags($nom)));
    $cleanMessage = trim(htmlspecialchars(strip_tags($message)));

    // Vérification si les champs sont vides
    if (empty($cleanNom) || empty($cleanMessage)) {
        $error .= "Tous les champs sont obligatoires.";
    } elseif (strlen($cleanNom) > 100 || strlen($cleanMessage) > 500) {
        $error .= "Votre nom ou votre message est trop long";
    }

    if (!empty($error)) return $error;
    // Préparation de la requête SQL pour insérer les données
    $prepar = $db->prepare("INSERT INTO messages (name, message) VALUES (?, ?)");

    // Liaison des paramètres nettoyés
    $prepar->bindParam(1, $cleanNom, PDO::PARAM_STR);
    $prepar->bindParam(2, $cleanMessage, PDO::PARAM_STR);
    try {

        // Exécution de la requête
        $prepar->execute([$cleanNom, $cleanMessage]);
        return true; // Retourne un booléen en cas de succès
    } catch (Exception $e) {
        return $e->getMessage();
    }
}







function recup_total_messages_sous_entier(PDO $db): int
{
        $query = $db->query("SELECT COUNT(*) as nb FROM `messages` ");
        return $query->fetch()['nb'];
}

function recup_messages_par_page(PDO $db, int $offset, int $limite): array
{
    $prepare = $db->prepare(
        "SELECT * FROM `messages`
        ORDER BY `messages`.`created_at` DESC
        LIMIT ?,?"
    );
    try{
        $prepare->bindParam(1,$offset,PDO::PARAM_INT);
        $prepare->bindParam(2,$limite,PDO::PARAM_INT);
        $prepare->execute();
        return $prepare->fetchAll();

    }catch(Exception $e){
        die($e->getMessage());
    }
}
function pagination(int $nbtotalMessage, string $get="page", int $pageActu=1, int $perPage=5 ): string
{

    $sortie = "";

    if ($nbtotalMessage === 0) return "";

    $nbPages = ceil($nbtotalMessage / $perPage);

    if ($nbPages == 1) return "";

    $sortie .= "<p>";


    for ($i = 1; $i <= $nbPages; $i++) {
        if ($i === 1) {
            if ($pageActu === 1) {
                $sortie .= "<< < 1 |";
            } elseif ($pageActu === 2) {
                $sortie .= " <a href='./'><<</a> <a href='./'><</a> <a href='./'>1</a> |";
            } else {
                $sortie .= " <a href='./'><<</a> <a href='?$get=" . ($pageActu - 1) . "'><</a> <a href='./'>1</a> |";
            }
        } elseif ($i < $nbPages) {
            if ($i === $pageActu) {
                $sortie .= "  $i |";
            } else {
                $sortie .= "  <a href='?$get=$i'>$i</a> |";
            }
        } else {
            if ($pageActu >= $nbPages) {
                $sortie .= "  $nbPages > >>";
            } else {
                $sortie .= "  <a href='?$get=$nbPages'>$nbPages</a> <a href='?$get=" . ($pageActu + 1) . "'>></a> <a href='?$get=$nbPages'>>></a>";
            }
        }
    }
        $sortie .= "</p>";
        return $sortie;

    }