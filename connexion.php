<?php
$servername = "localhost";
$username = "root";
$password = "Laplateforme1";
$dbname = "quiznight";

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $user = isset($_POST['username']) ? trim($_POST['username']) : null;
    $pass = isset($_POST['password']) ? trim($_POST['password']) : null;
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;

    // Validation des données
    if (empty($user) || empty($pass) || empty($email)) {
        echo "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Format d'email invalide.";
    } else {
        // Vérifier si l'utilisateur existe déjà
        $stmt = $conn->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $user, $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            echo "Le nom d'utilisateur ou l'email est déjà utilisé.";
        } else {
            // Hacher le mot de passe
            $hashed_password = password_hash($pass, PASSWORD_DEFAULT);

            // Insérer les données dans la base de données
            $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $user, $hashed_password, $email);

            if ($stmt->execute()) {
                echo "Inscription réussie !";
            } else {
                echo "Erreur : " . $stmt->error;
            }
        }
        $stmt->close();
    }
}
$conn->close();
?>
