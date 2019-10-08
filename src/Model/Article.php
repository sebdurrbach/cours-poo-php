<?php

namespace App\Model;

require_once "src/Model/Model.php";

class Article extends Model
{

    /**
     * Retourne l'ensemble des articles triés par date de création
     *
     * @return array
     */
    public function findAll(): array
    {
        $resultats = $this->db->query('SELECT * FROM articles ORDER BY created_at DESC');
        return $resultats->fetchAll();
    }

    /**
     * Retourne un article grâce à son id
     *
     * @param integer $id L'identifiant de l'article qu'on veut récupérer
     * @return array|boolean
     */
    public function find(int $id)
    {
        $query = $this->db->prepare("SELECT * FROM articles WHERE id = :article_id");
        $query->execute(['article_id' => $id]);
        $article = $query->fetch();
        return $article ?? false;
    }

    /**
     * Supprime un article à partir de son ID
     *
     * @param integer $id
     * @return void
     */
    function delete(int $id): void
    {
        $query = $this->db->prepare('DELETE FROM articles WHERE id = :id');
        $query->execute(['id' => $id]);
    }
}
