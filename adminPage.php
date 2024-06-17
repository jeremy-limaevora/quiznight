<?php
include 'config.php';
include 'addQuiz.php';

// Récupérer des quiz existants s'il y en a
$quizzes = [];
$query = $pdo->query("SELECT quizzes.id, quizzes.name, categories.name AS category FROM quizzes LEFT JOIN categories ON quizzes.category_id = categories.id");

if ($query) {
    $quizzes = $query->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Gestion de l'erreur si la requête échoue
    echo "Erreur lors de la récupération des quizzes.";
}

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Quiz</title>
    <style>
        body {
            background: #1E1523;
            color: #E2DDFE;
            font-family: Arial, sans-serif;
        }

        .navbar {
            background: #3D224E;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .navbar .left-align {
            display: flex;
            align-items: center;
        }

        .navbar a {
            color: #BAA7FF;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 5px;
            transition: transform 0.3s ease;
        }

        .navbar a:hover {
            background: #6E56CF;
            transform: scale(1.1);
        }

        .navbar .right-align {
            margin-left: auto;
        }

        .container {
            width: 80%;
            margin: 0 auto;
        }

        h1,
        h2 {
            border-bottom: 2px solid #54346B;
            padding-bottom: 5px;
        }

        ul {
            list-style-type: none;
            padding: 0;
        }

        ul li {
            margin-bottom: 10px;
        }

        form {
            background: #3D224E;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin-bottom: 10px;
            color: #E2DDFE;
        }

        form input[type="text"],
        form select {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #8457AA;
            border-radius: 5px;
            background-color: #1E1523;
            color: #E2DDFE;
        }

        form button[type="button"],
        form button[type="submit"],
        form button[type="reset"] {
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background-color: #6E56CF;
            color: #E2DDFE;
            cursor: pointer;
            transition: background-color 0.3s ease;
            margin-right: 10px;
        }

        form button[type="button"]:hover,
        form button[type="submit"]:hover,
        form button[type="reset"]:hover {
            background-color: #8457AA;
        }

        .question {
            background: #54346B;
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 8px;
        }

        .question label {
            display: block;
            margin-bottom: 5px;
            color: #E2DDFE;
        }

        .question input[type="text"] {
            width: calc(100% - 20px); /* Prend en compte le padding interne */
            padding: 8px;
            margin-bottom: 5px;
            border: 1px solid #8457AA;
            border-radius: 5px;
            background-color: #1E1523;
            color: #E2DDFE;
        }

        .question input[type="checkbox"] {
            margin-right: 5px;
        }

        .question > div {
            margin-bottom: 10px; /* Espace entre chaque bloc de réponse et la question suivante */
        }

        /* Style du select */
        form select {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #8457AA;
            border-radius: 5px;
            background-color: #1E1523;
            color: #E2DDFE;
        }

        /* Style des options du select */
        form select option {
            background-color: #3D224E;
            color: #BAA7FF;
        }
    </style>
</head>
<body>
    <div class="navbar">
        <div class="left-align">
            <a href="#">Liste des Quiz</a>
            <a href="#">Ajouter un Quiz</a>
        </div>
        <a href="#" class="right-align">Se connecter</a>
    </div>

    <div class="container">
        <h1>Admin - Quiz</h1>
        <ul>
            <?php if (!empty($quizzes)): ?>
                <!-- Liste des quiz -->
                <?php foreach ($quizzes as $quiz): ?>
                    <li><?php echo htmlspecialchars($quiz['name']) . ' - ' . htmlspecialchars($quiz['category']); ?></li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>Pas de quiz disponible.</li>
            <?php endif; ?>
        </ul>

        <h2>Ajouter un nouveau quiz</h2>
        <form action="addQuiz.php" method="post">
            <div>
                <label for="quiz_name">Nom du quiz :</label>
                <input type="text" id="quiz_name" name="quiz_name" required>
            </div>
            <div>
                <label for="category_id">Catégorie :</label>
                <select id="category_id" name="category_id" required>
                    <option value="1">Sport</option>
                    <option value="2">Nature</option>
                    <option value="3">Culture générale</option>
                    <option value="4">Géographie</option>
                    <option value="5">Histoire</option>
                    <option value="6">Musique</option>
                </select>
            </div>
            <div id="questions">
                <h3>Questions</h3>
                <div class="question">
                    <label>Question:</label>
                    <input type="text" name="questions[]" required>
                    <div>
                        <label>Réponse 1 :</label>
                        <input type="text" name="responses[0][][text]" required>
                        <input type="checkbox" name="responses[0][][is_correct]"> Correct
                    </div>
                    <div>
                        <label>Réponse 2 :</label>
                        <input type="text" name="responses[0][][text]" required>
                        <input type="checkbox" name="responses[0][][is_correct]"> Correct
                    </div>
                    <div>
                        <label>Réponse 3 :</label>
                        <input type="text" name="responses[0][][text]" required>
                        <input type="checkbox" name="responses[0][][is_correct]"> Correct
                    </div>
                    <div>
                        <label>Réponse 4 :</label>
                        <input type="text" name="responses[0][][text]" required>
                        <input type="checkbox" name="responses[0][][is_correct]"> Correct
                    </div>
                </div>
            </div>
            <button type="button" onclick="addQuestion()">Ajouter une question</button>
            <button type="submit">Ajouter</button>
            <button type="reset">Réinitialiser</button>
        </form>
    </div>

    <script>
        function addQuestion() {
            const questionsDiv = document.getElementById('questions');
            const questionCount = questionsDiv.querySelectorAll('.question').length;
            const questionDiv = document.createElement('div');
            questionDiv.className = 'question';
            questionDiv.innerHTML = `
                <label>Question:</label>
                <input type="text" name="questions[]" required>
                <div>
                    <label>Réponse 1 :</label>
                    <input type="text" name="responses[${questionCount}][][text]" required>
                    <input type="checkbox" name="responses[${questionCount}][][is_correct]"> Correct
                </div>
                <div>
                    <label>Réponse 2 :</label>
                    <input type="text" name="responses[${questionCount}][][text]" required>
                    <input type="checkbox" name="responses[${questionCount}][][is_correct]"> Correct
                </div>
                <div>
                    <label>Réponse 3 :</label>
                    <input type="text" name="responses[${questionCount}][][text]" required>
                    <input type="checkbox" name="responses[${questionCount}][][is_correct]"> Correct
                </div>
                <div>
                    <label>Réponse 4 :</label>
                    <input type="text" name="responses[${questionCount}][][text]" required>
                    <input type="checkbox" name="responses[${questionCount}][][is_correct]"> Correct
                </div>
            `;
            questionsDiv.appendChild(questionDiv);
        }
    </script>
</body>
</html>
