<?php
# fonctions en lien avec la table article
# chargement des articles classés par `create_date` DESC
function getArticles(PDO $pdo): array
{
    $query = $pdo->query('
        SELECT * FROM article ORDER BY create_date DESC
    ');

    return $query->fetchAll();
}

function createArticles(PDO $pdo, string $surname, string $email, string $message): bool
{
    $prepare = $pdo->prepare('
        INSERT INTO article (surname, email, message) VALUES (?, ?, ?)
    ');
    $insertSurnom = trim(htmlspecialchars(strip_tags($surname)));
    $insertEmail = filter_var($email, FILTER_SANITIZE_EMAIL);
    $insertMessage = trim(htmlspecialchars(strip_tags($message)));
    
    $allInsert = [$insertSurnom, $insertEmail, $insertMessage];
    $prepare->execute($allInsert);
    if (empty($allInsert)) {
        return false;
    }
    return true;
}
