<?php
require_once('header.php');
$bdd = new PDO("mysql:host=127.0.0.1; dbname=gestion_projet", "root", "");

$articles = $bdd->query('SELECT * FROM articles ORDER BY id DESC ')

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/style.css">
    <title>Blog</title>
</head>
<body>
    <h1>Bienvenue sur le blog</h1>
    <h3>Vous retrouverez ici tous les articles publiés sur le site</h3>
<?php while($a = $articles ->fetch()){  ?>

<div  class="template-article">
<div class="titre"><?= $a['titre'] ?></div>
<div id="zone-contenu">
<div><img class="image-presentation" src="images/<?= $a['image_principale'] ?>"></div>
<div class="contenu"><?= $a['contenu'] ?></div>
</div>
<button class="button"><a href="tpl-article.php?id=<?= $a['id'] ?>">Lire l'article</a></button>
</div>

<?php } ?>
    
</body>
</html>