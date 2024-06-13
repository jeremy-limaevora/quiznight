<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>
    <form action="traitement_inscription.php" method="post">
        <label for="nom">Nom :</label><br>
        <input type="text" id="nom" name="nom"><br>
        <label for="prenom">Prénom :</label><br>
        <input type="text" id="prenom" name="prenom"><br>
        <label for="email">Email :</label><br>
        <input type="email" id="email" name="email"><br>
        <label for="motdepasse">Mot de passe :</label><br>
        <input type="password" id="motdepasse" name="motdepasse"><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>