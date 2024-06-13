<?php
// Connexion à la base de données
$servername = "localhost";
$username = "votre_username";
$password = "votre_password";
$dbname = "monsite";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: ". $conn->connect_error);
}

// Préparation de la requête SQL
$stmt = $conn->prepare("INSERT INTO utilisateurs (nom, prenom, email, mot_de_passe) VALUES (?,?,?,?)");
$stmt->bind_param("ssss", $_POST['nom'], $_POST['prenom'], $_POST['email'], password_hash($_POST['motdepasse'], PASSWORD_DEFAULT));

// Exécution de la requête
if ($stmt->execute()) {
    echo "Inscription réussie!";
} else {
    echo "Erreur : ". $stmt->error;
}

// Fermeture de la connexion
$stmt->close();
$conn->close();
?>