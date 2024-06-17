<?php include "database.php"; ?>
<?php 
// set question
$number= (int) $_GET["n"];
//    get total question
$query="SELECT * FROM Question";
// get result
$result=$mysqli->query($query)or die ($mysqli->error.__LINE__);
$total=$result->num_rows;

// get question
$query = "SELECT * FROM Question WHERE question_number = $number";
$result = $mysqli->query($query) or die($mysqli->error.__LINE__);
$question=$result->fetch_assoc();

// get choices

// get result
$choices=$mysqli->query($query) or die ($mysqli->error.__LINE__);
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
            
        </div>
    </header>
    <main>
    <div class="container">
          <div class="current"> question <?php echo $question['question_number'];?> sur <?php echo $total;?></div>
          <p class="question">
            <?php echo $question["text"];?>
          </p>
          <form method="post" action="process.php">
            <ul class="choices">
              <?php while($row= $choices->fetch_assoc()):?>
                <li><input name="choices" type="radio" value="<?php echo $row[$number];?>"><?php echo $row["answer"] ?></li>
              <?php endwhile ?>
            <button type="sumbit" value="sumbit">Valider</button>
            <input type="hidden" name="number" value="<?php echo $number;?>" />
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