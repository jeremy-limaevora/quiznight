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
           <h2>Add question</h2>
           <form method="post" action="add.php">
            <p>
                <label for="">question n°</label>
                <input type="number" name="question_number">
            </p>
            <p>
                <label for="">question text</label>
                <input type="text" name="question_text">
            </p>
            <p>
                <label for="">Choix 1</label>
                <input type="text" name="choix1">
            </p>
            <p>
                <label for="">Choix 2</label>
                <input type="text" name="choix2">
            </p>
            <p>
                <label for="">Choix 3</label>
                <input type="text" name="choix3">
            </p>
            <p>
                <label for="">Choix 4</label>
                <input type="text" name="choix4">
            </p>
            <p>
                <label for="">Choix 5</label>
                <input type="text" name="choix5">
            </p>
            <p>
                <label for="">Choix correct n°: </label>
                <input type="number" name="correct_choix">
            </p>
            <p>
            <button type="number" name="sumbit" value="Sumbit">envoyer</button>
            </p>
           </form>
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