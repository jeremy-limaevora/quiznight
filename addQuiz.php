<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données soumises par le formulaire
    $quizName = $_POST['quiz_name'] ?? '';
    $categoryId = $_POST['category_id'] ?? '';
    $questions = $_POST['questions'] ?? [];
    $responses = $_POST['responses'] ?? [];

    // Validation des données (à adapter selon vos besoins)
    if (empty($quizName) || empty($categoryId) || empty($questions) || empty($responses)) {
        echo "Tous les champs du formulaire doivent être remplis.";
        exit; // Arrêter l'exécution si les données sont invalides
    }

    // Insertion du nouveau quiz dans la base de données
    try {
        // Commencer la transaction
        $pdo->beginTransaction();

        // Insérer le quiz
        $insertQuiz = $pdo->prepare("INSERT INTO quizzes (name, category_id) VALUES (:name, :category_id)");
        $insertQuiz->execute([
            'name' => $quizName,
            'category_id' => $categoryId
        ]);
        $quizId = $pdo->lastInsertId(); // Récupérer l'ID du quiz inséré

        // Insérer les questions et réponses
        $insertQuestion = $pdo->prepare("INSERT INTO questions (quiz_id, question_text) VALUES (:quiz_id, :question_text)");
        $insertResponse = $pdo->prepare("INSERT INTO responses (question_id, response_text, is_correct) VALUES (:question_id, :response_text, :is_correct)");

        foreach ($questions as $key => $question) {
            // Insérer la question
            $insertQuestion->execute([
                'quiz_id' => $quizId,
                'question_text' => $question
            ]);
            $questionId = $pdo->lastInsertId(); // Récupérer l'ID de la question insérée

            foreach ($responses[$key] as $response) {
                // Insérer chaque réponse
                $insertResponse->execute([
                    'question_id' => $questionId,
                    'response_text' => $response['text'],
                    'is_correct' => isset($response['is_correct']) ? 1 : 0 // Convertir le checkbox en 1 ou 0
                ]);
            }
        }

        // Valider la transaction
        $pdo->commit();
        echo "Le quiz a été ajouté avec succès.";

    } catch (PDOException $e) {
        // Annuler la transaction en cas d'erreur
        $pdo->rollBack();
        echo "Erreur lors de l'ajout u quiz : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée pour accéder à cette page.";
}
?>
