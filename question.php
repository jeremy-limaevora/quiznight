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
            
        </div>
    </header>
    <main>
    <div class="container">
          <div class="current"> question 1 sur 5</div>
          <p class="question">
            Pourquoi utilise-ton php ?
          </p>
          <form method="post" action="process.php">
            <ul class="choices">
            <li><input name="choices" type="radio" value="1">PHP hypertext processor</li>
            <li><input name="choices" type="radio" value="1">Page priver</li>
            <li><input name="choices" type="radio" value="1">Page personels</li>
            <li><input name="choices" type="radio" value="1">Personal hypertext</li>
            </ul>
            <button type="sumbit" value="sumbit">Valider</button>
          </form>
        </div>
    </main>
    <footer>
    <div class="container">
            <!-- mettre un copyrigt -->
        </div>
    </footer>
</body>
</html>