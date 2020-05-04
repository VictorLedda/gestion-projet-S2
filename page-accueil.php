<?php
require_once('header.php');
$bdd = new PDO("mysql:host=127.0.0.1; dbname=gestion_projet", "root", "");

$articles = $bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT 3')

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/style-page-accueil.css">
    <title>Blog</title>
</head>
<body>
    <h1>Voici les derniers articles publiés</h1>
    <section id="dernieres-actualites">
<?php while($a = $articles ->fetch()){  ?>
    <div>
    <div class="titre"><?= $a['titre'] ?></div>
    <div><img class="image" src="images/<?= $a['image_principale'] ?>"></div>
    <button class="button"><a href="tpl-article.php?id=<?= $a['id'] ?>">Lire l'article</a></button>
</div>
<?php } ?>
</section>