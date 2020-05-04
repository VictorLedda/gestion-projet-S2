<?php 
$bdd = new PDO("mysql:host=127.0.0.1; dbname=gestion_projet", "root", "");

$erreur = null;






if(isset($_POST['validation'])){

    if(!empty($_POST['titre']) AND !empty($_POST['contenu'])){

        if(!empty($nbr)){
            $nbr++;
        }

        
$titre = htmlspecialchars($_POST['titre']);
$contenu = htmlspecialchars($_POST['contenu']);

 
    
    
    
       
        $chemin = "images/".$_FILES['image']['name'] ;
        $nom = $_FILES['image']['name'];
    move_uploaded_file($_FILES['image']['tmp_name'], $chemin);
        

        

        

    $insertion = $bdd->prepare('INSERT INTO articles(titre, contenu, image_principale) VALUES( ?, ?, ?)');
    $insertion->execute(array($titre, $contenu, $nom));

    $erreur = "Votre artcile vient d'être ajouté " ;
                         
    }
}



?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="style.css">
    <title>Ajouter un article</title>
</head>
<body>
    <h1>Ajouter un article</h1>
   
   <form  method="POST" enctype="multipart/form-data">
       
       <div><input type="text" name="titre" placeholder="Titre"></div>
       <div><input type="text" name="contenu" placeholder="Contenu de l'article"></div>
       <div><input type="file" name="image"></div>
       

       <input id="valider"  type="submit" name="validation" value="valider">
       <div id="erreur"><?php if(isset($erreur) AND !empty($erreur)){echo $erreur; }?></div>
</form>
</div>

</body>
</html>