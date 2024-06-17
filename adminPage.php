<?php
include 'config.php';

// Gérer la soumission du formulaire pour ajouter un nouveau quiz
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $quiz_name = $_POST['quiz_name'];
    $category_id = $_POST['category_id'];
    $questions = $_POST['questions'];
    $responses = $_POST['responses'];

    // Ajouter un nouveau quiz
    $stmt = $pdo->prepare("INSERT INTO quizzes (name, category_id) VALUES (:name, :category_id)");
    $stmt->execute(['name' => $quiz_name, 'category_id' => $category_id]);
    $quiz_id = $pdo->lastInsertId();

    // ajouter les questions et réponses
    foreach ($questions as $index => $question_text) {
        $stmt = $pdo->prepare("INSERT INTO questions (quiz_id, question_text) VALUES (:quiz_id, :question_text)");
        $stmt->execute(['quiz_id' => $quiz_id, 'question_text' => $question_text]);
        $question_id = $pdo->lastInsertId();

        foreach ($responses[$index] as $answer) {
            $stmt = $pdo->prepare("INSERT INTO responses (question_id, answer_text, is_correct) VALUES (:question_id, :answer_text, :is_correct)");
            $stmt->execute([
                'question_id' => $question_id,
                'answer_text' => $answer['text'],
                'is_correct' => isset($answer['is_correct']) ? 1 : 0
            ]);
        }
    }
}

// Récupérer des quiz existants
$quizzes = $pdo->query("SELECT quizzes.id, quizzes.name, categories.name AS category FROM quizzes LEFT JOIN categories ON quizzes.category_id = categories.id")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les catégories
$categories = [
    ['id' => 1, 'name' => 'Sport'],
    ['id' => 2, 'name' => 'Cinéma'],
    ['id' => 3, 'name' => 'Culture générale'],
    ['id' => 4, 'name' => 'Science'],
    ['id' => 5, 'name' => 'Nature'],
];
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Admin - Quiz</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        h1, h2 {
            color: #333;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            background: #eee;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"], select {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background: #28a745;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        button[type="button"] {
            background: #007bff;
        }

        button:hover {
            opacity: 0.9;
        }

        .question {
            margin-bottom: 15px;
            padding: 10px;
            background: #f9f9f9;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .question div {
            margin-bottom: 10px;
        }

        .question label {
            margin-bottom: 0;
        }

        input[type="checkbox"] {
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admin - Quiz</h1>
        <ul>
            <?php foreach ($quizzes as $quiz): ?>
                <li><?php echo htmlspecialchars($quiz['name']) . ' - ' . htmlspecialchars($quiz['category']); ?></li>
            <?php endforeach; ?>
        </ul>

        <h2>Ajouter un nouveau quiz</h2>
        <form action="admin.php" method="post">
            <div>
                <label for="quiz_name">Nom du quiz :</label>
                <input type="text" id="quiz_name" name="quiz_name" required>
            </div>
            <div>
                <label for="category_id">Categorie :</label>
                <select id="category_id" name="category_id" required>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?php echo $category['id']; ?>"><?php echo htmlspecialchars($category['name']); ?></option>
                    <?php endforeach; ?>
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
            <div>
                <button type="submit">Ajouter</button>
            </div>
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
                    <label>Réponse 1:</label>
                    <input type="text" name="responses[${questionCount}][][text]" required>
                    <input type="checkbox" name="responses[${questionCount}][][is_correct]"> Correct
                </div>
                <div>
                    <label>Réponse 2:</label>
                    <input type="text" name="responses[${questionCount}][][text]" required>
                    <input type="checkbox" name="responses[${questionCount}][][is_correct]"> Correct
                </div>
                <div>
                    <label>Réponse 3:</label>
                    <input type="text" name="responses[${questionCount}][][text]" required>
                    <input type="checkbox" name="responses[${questionCount}][][is_correct]"> Correct
                </div>
                <div>
                    <label>Réponse 4:</label>
                    <input type="text" name="responses[${questionCount}][][text]" required>
                    <input type="checkbox" name="responses[${questionCount}][][is_correct]"> Correct
                </div>
            `;
            questionsDiv.appendChild(questionDiv);
        }
    </script>dd 
</body>
</html>
