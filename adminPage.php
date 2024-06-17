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