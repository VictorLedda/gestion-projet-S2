<?php
require_once('header.php');
$bdd = new PDO("mysql:host=127.0.0.1; dbname=gestion_projet", "root", "");

$articles = $bdd->query('SELECT * FROM articles ORDER BY id DESC LIMIT 4');

if(isset($_POST['valider'])){
    if(isset($_POST['auteur']) AND !empty($_POST['auteur']) AND isset($_POST['message']) AND !empty($_POST['message'])){
        $auteur = htmlspecialchars($_POST['auteur']);
        $message = htmlspecialchars($_POST['message']);
        $id_article =  htmlspecialchars($_GET['id']);
    
        $insert_commentaire = $bdd->prepare('INSERT INTO commentaires(id_article, auteur, commentaire) VALUES(?,?,?)');
        $insert_commentaire->execute(array( $id_article, $auteur, $message ));
    }
    }

    $comments = $bdd->query('SELECT * FROM commentaires ORDER BY id DESC ');
     
if(isset($_GET['id']) AND !empty($_GET['id'])){
    $get_id = htmlspecialchars($_GET['id']);
    $article = $bdd= $bdd->prepare('SELECT * FROM articles WHERE id = ?');
$article->execute(array($get_id));
if($article->rowCount() == 1){
    $article = $article->fetch();
    $titre = $article['titre'];
    $contenu = $article['contenu'];
    $image = $article['image_principale'];
}else{
    die('Cet article n\'existe pas');
}
}else{
    die('Erreur');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="css/article-style.css">
    <title>Article</title>
</head>
<body>
    <section id="image-haut">
    <div id="image"><img id="image-top" src="images/<?= $image ?>"></div>
</section>
<aside>
    <h2 id="titre_section_article">Derniers articles mis en ligne</h2>
<?php

while($a = $articles->fetch()){
?>
<div id="article_recent">
<a href="tpl-article.php?id=<?= $a['id'] ?>"><h3 id="titre_derniers_articles"><?= $a['titre'] ; ?></h3></a>

<a href="tpl-article.php?id=<?= $a['id'] ?>"><img id="image_derniers_articles" src="images/<?= $a['image_principale'] ?>"></a>
<div id="trait"></div>
</div>
<?php } ?>



</aside>
<section id="contenu">
    <div id="contenu-article">
    <h1><?= $titre ?></h1>
    <p><?= $contenu ?></p>
</div>
</section>

<form id="espace_commentaire" method="POST">
    <h1>Ajouter un commentaire</h1>
<div><input type="text" id="auteur" placeholder="Votre prénom" name="auteur"><div>
<div><textarea id="message" placeholder="Votre commentaire" name="message"></textarea></div>
<div><input id="bouton_valider" type="submit" value="Ajouter un commentaire" name="valider"></div>
</form>
<div id="tous-commentaires">
<?php  while($c = $comments ->fetch()){ ?> 
    <div>
<h4><?= $c['auteur']; ?><h4></br></br>
<p><?= $c['commentaire']; ?></p>
</div>
<?php } ?>
</div>
</div>
</div>
</form>

    

</body>

