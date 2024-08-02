<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un monument</title>
</head>
<body>
    <h1>Modifier un monument</h1><?php 
    
    if(isset($success)) {
        echo "<p style='color:green'>$success</p>";
    }else{
        if(isset($error)){
            echo '<p style="color:red">'.$error->getMessage().'</p>';
        }?>
        <form method="post">

            <label for="nom">Nom du monument : </label>
            <input type="text" id="nom" name="nom" value="<?=htmlentities($_POST['nom']??$monument->getNom()??'')?>"><br><br>

            <label for="pays">Pays : </label>
            <input type="text" id="pays" name="pays" value="<?=htmlentities($_POST['pays']??$monument->getPays()??'')?>"><br><br>

            <label for="ville">Ville : </label>
            <input type="text" id="ville" name="ville" value="<?=htmlentities($_POST['ville']??$monument->getVille()??'')?>"><br><br>

            <label for="nbVisitesAn">Nombre de visites annuelles : </label>
            <input type="number" id="nbVisitesAn" name="nbVisitesAn" value="<?=htmlentities($_POST['nbVisitesAn']??$monument->getNbVisitesAn()??'')?>"><br><br>

            <input type="submit" value="Modifier">

        </form><?php
    } ?>
    
    <p><a href="?page=monument">Retour à la liste des monuments</a></p>
</body>
</html>