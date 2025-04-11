<?php
# Modèle de la table messages
# Tout ce qui concerne les données se trouvent
# dans ce fichier

//
//

/**
 * on crée une fonction qui va récupérer tous les messages par
 * created_at DESC
 */
function getAllMessagesByDateDesc(PDO $connectDB): string|array
{
    try {
        $recup = $connectDB->query("
        SELECT * 
        FROM `messages` 
        ORDER BY `created_at` DESC
");
        // pas de résultats, on envoie un (string)
        if ($recup->rowCount() === 0) return "Pas encore de message";

        // si on a au moins un résultat
        // on envoie un tableau indexé (array)
        return $recup->fetchAll();
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

// on veut insérer le formulaire dans la db
function setArticle(PDO $pdo, string $name, string $email, string $message): bool
{
    $prepare = $pdo->prepare(
        "
INSERT INTO `messages` (`name`,`email`,`message`) 
VALUES (?,?,?);
"
    );
    try {
        $prepare->execute([$name, $email, $message]);
        return true;
    } catch (Exception $e) {
        die($e->getMessage());
    }
}

function creerArticles(PDO $db, $name, $email, $message)
{
    // Préparer la requête d'insertion
    $req = $db->prepare('INSERT INTO messages (name, email, message) VALUES (?, ?, ?)');
    try {

        // Exécuter la requête avec des paramètres sécurisés

        $req->execute([$name, $email, $message]);

        return true;
    } catch (PDOException $e) {
        return 'Erreur lors de la création de l\'article : ' . $e->getMessage();
    }
}
