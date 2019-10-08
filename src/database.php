<?php

/**
 * Créé une connexion PDO
 *
 * @return PDO
 */
function getPdo(): PDO
{
    return $pdo = new PDO('mysql:host=localhost;dbname=blogpoo;charset=utf8', 'root', '', [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
}

/**
 * Retourne l'ensemble des articles triés par date de création
 *
 * @return array
 */
function findAllArticles(): array
{
    $pdo = getPdo();
    $resultats = $pdo->query('SELECT * FROM articles ORDER BY created_at DESC');
    return $resultats->fetchAll();
}

/**
 * Retourne un article grâce à son id
 *
 * @param integer $id L'identifiant de l'article qu'on veut récupérer
 * @return array|boolean
 */
function findArticle(int $id)
{
    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM articles WHERE id = :article_id");
    $query->execute(['article_id' => $id]);
    $article = $query->fetch();
    return $article ?? false;
}

/**
 * Retourne les commentaires d'un article
 *
 * @param integer $article_id Identifiant de l'article dont on veut les commentaires
 * @return array
 */
function findAllComments(int $article_id): array
{
    $pdo = getPdo();
    $query = $pdo->prepare("SELECT * FROM comments WHERE article_id = :article_id");
    $query->execute(['article_id' => $article_id]);
    return $query->fetchAll();
}

/**
 * Supprime un article à partir de son ID
 *
 * @param integer $id
 * @return void
 */
function deleteArticle(int $id): void
{
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM articles WHERE id = :id');
    $query->execute(['id' => $id]);
}

function findComment(int $id): array
{
    $pdo = getPdo();
    $query = $pdo->prepare('SELECT * FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);

    $comment = $query->fetch();

    return $comment ?? [];
}

/**
 * Supprime un commentaire
 *
 * @param integer $id ID du commentaire à supprimer
 * @return void
 */
function deleteComment(int $id): void
{
    $pdo = getPdo();
    $query = $pdo->prepare('DELETE FROM comments WHERE id = :id');
    $query->execute(['id' => $id]);
}

/**
 * Créé un commentaire
 *
 * @param string $author Auteur de l'article
 * @param string $content Contenu de l'article
 * @param integer $article_id ID de l'article
 * @return void
 */
function createComment(string $author, string $content, int $article_id): void
{
    $pdo = getPdo();
    $query = $pdo->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
    $query->execute(compact('author', 'content', 'article_id'));
}
