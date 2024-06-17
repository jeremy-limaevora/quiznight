<?php include "database.php"; ?>
<?php 
// get total question 
$query = "SELECT * FROM Question";
// get result
$result = $mysql->query($query) or die ($mysql->error.__LINE__);
$total = $result->num_rows;

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>QuizzNihgt</title>
</head>
<body>
    <header>
        <div class="container">
            <h1>QuizzNight</h1>
            <p>Ceci est un quizz a choix multiples</p>
            <ul>
                <li><strong>Nombre de question: </strong>5</li>
                <li><strong>Type: </strong>Choix multiple</li>
                <li><strong>Temps estimer: </strong>4 min</li>
            </ul>
            <!-- n=la valeur donc 1 pour la premier question -->
            <a href="question.php?n=1" class="start">Commencer le quiz</a>
        </div>
    </header>
    <main>
    <div class="container">
           <h2>Test tes competence en php</h2>
        </div>
    </main>
    <footer>
    <div class="container">
            <!-- mettre un copyrigt -->
        </div>
    </footer>
</body>
</html>