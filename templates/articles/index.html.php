<h1>Nos articles</h1>

<?php foreach ($articles as $article) : ?>
    <h2><?= $article['title'] ?></h2>
    <small>Ecrit le <?= $article['created_at'] ?></small>
    <p><?= $article['introduction'] ?></p>
    <a href="/article/<?= $article['id'] ?>">Lire la suite</a>
    <a href="/article/<?= $article['id'] ?>/delete" onclick="return window.confirm(`Êtes vous sur de vouloir supprimer cet article ?!`)">Supprimer</a>
<?php endforeach ?>