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
    $email = isset($_POST['email']) ? trim($_POST['email']) : null;
    $pass = isset($_POST['password']) ? trim($_POST['password']) : null;

    // Validation des données
    if (empty($email) || empty($pass)) {
        echo "Tous les champs sont obligatoires.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Format d'email invalide.";
    } else {
        // Vérifier si l'utilisateur existe
        $stmt = $conn->prepare("SELECT id, mot_de_passe FROM utilisateurs WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // Récupérer le mot de passe haché de l'utilisateur
            $stmt->bind_result($user_id, $hashed_password);
            $stmt->fetch();

            // Vérifier si le mot de passe est correct
            if (password_verify($pass, $hashed_password)) {
                echo "Connexion réussie !";
                // Redirection après une connexion réussie
                header('Location: index.php');
                exit;
            } else {
                echo "Mot de passe incorrect.";
            }
        } else {
            echo "Utilisateur non trouvé.";
        }
        $stmt->close();
    }
}
$conn->close();
?>
