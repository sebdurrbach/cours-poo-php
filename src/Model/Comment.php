<?php

namespace App\Model;

require_once "src/Model/Model.php";

class Comment extends Model
{

    /**
     * Retourne les commentaires d'un article
     *
     * @param integer $article_id Identifiant de l'article dont on veut les commentaires
     * @return array
     */
    function findAll(int $article_id): array
    {
        $query = $this->db->prepare("SELECT * FROM comments WHERE article_id = :article_id");
        $query->execute(['article_id' => $article_id]);
        return $query->fetchAll();
    }

    function find(int $id): array
    {
        $query = $this->db->prepare('SELECT * FROM comments WHERE id = :id');
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
    function delete(int $id): void
    {
        $query = $this->db->prepare('DELETE FROM comments WHERE id = :id');
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
    function create(string $author, string $content, int $article_id): void
    {
        $query = $this->db->prepare('INSERT INTO comments SET author = :author, content = :content, article_id = :article_id, created_at = NOW()');
        $query->execute(compact('author', 'content', 'article_id'));
    }
}
