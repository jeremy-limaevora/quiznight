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
              <?php while($row= choices ->fetch_assoc()):?>
                <li><input name="choices" type="radio" value="<?php echo $row["id"];?>"><?php echo $row["text"] ?></li>
              <?php endwhile ?>
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