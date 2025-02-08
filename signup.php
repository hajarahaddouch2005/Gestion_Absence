<?php
require "file/database.php";
require "file/functions.php";

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $username = $_POST['username'] ?? '';
    $matricule = $_POST['matricule'] ?? '';
    $type = $_POST['type'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($nom)) {
        $errors['nom'] = "Veuillez entrer votre nom";
    }

    if (empty($prenom)) {
        $errors['prenom'] = "Veuillez entrer votre prénom";
    }

    if (empty($username)) {
        $errors['username'] = "Veuillez entrer votre nom d'utilisateur";
    }

    if (empty($matricule)) {
        $errors['matricule'] = "Veuillez entrer votre matricule";
    }

    if (empty($type)) {
        $errors['type'] = "Veuillez sélectionner votre type";
    }

    if (empty($password)) {
        $errors['password'] = "Veuillez entrer votre mot de passe";
    }

    if (empty($errors)) {
        try {
            $db = database();
            $stmt = $db->prepare("INSERT INTO users (nom, prenom, username, matricule, type, password) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->execute([$nom, $prenom, $username, $matricule, $type, password_hash($password, PASSWORD_DEFAULT)]);
            session_start(); // Démarrer la session après validation de l'inscription
            $_SESSION["message"] = "Inscription réussie";
            header("Location: login2.php");
            exit();
        } catch (PDOException $e) {
            $errors['database'] = 'Erreur : ' . $e->getMessage();
        }
    }
}

function getPostValue($field) {
    return $_POST[$field] ?? '';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <link rel="shortcut icon" type="image/x-icon" href="assets/img/OFPPT.png">
    <title>Projet</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <style>
        body {
            background-image: url('assets/img/bg.jpg');
        }
    </style>
</head>
<body>
    <div class="main-wrapper account-wrapper">
        <div class="account-page">
            <div class="account-center">
                <div class="account-box">
                    <?php if (isset($errors['database'])): ?>
                        <div class="alert alert-danger">
                            <?php echo $errors['database']; ?>
                        </div>
                    <?php endif; ?>
                    <form action="signup.php" autocomplete="off" method="POST" class="form-signin">
                        <div class="form-group">
                            <label>Nom</label>
                            <input type="text" id="nom" name="nom" class="form-control" value="<?php echo getPostValue('nom'); ?>">
                            <?php if (isset($errors['nom'])): ?>
                                <p class="text-danger"><?php echo $errors['nom']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Prenom</label>
                            <input type="text" id="prenom" name="prenom" class="form-control" value="<?php echo getPostValue('prenom'); ?>">
                            <?php if (isset($errors['prenom'])): ?>
                                <p class="text-danger"><?php echo $errors['prenom']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?php echo getPostValue('username'); ?>">
                            <?php if (isset($errors['username'])): ?>
                                <p class="text-danger"><?php echo $errors['username']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Matricule</label>
                            <input type="text" id="matricule" name="matricule" class="form-control" value="<?php echo getPostValue('matricule'); ?>">
                            <?php if (isset($errors['matricule'])): ?>
                                <p class="text-danger"><?php echo $errors['matricule']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Type</label>
                            <select id="type" class="form-control" name="type">
                                <option value="" disabled <?php echo empty(getPostValue('type')) ? 'selected' : ''; ?>>Sélectionnez le type</option>
                                <option value="directeur" <?php echo getPostValue('type') === 'directeur' ? 'selected' : ''; ?>>directeur</option>
                                <option value="gestionnaire" <?php echo getPostValue('type') === 'gestionnaire' ? 'selected' : ''; ?>>gestionnaire</option>
                                <option value="formateur" <?php echo getPostValue('type') === 'formateur' ? 'selected' : ''; ?>>formateur</option>
                            </select>
                            <?php if (isset($errors['type'])): ?>
                                <p class="text-danger"><?php echo $errors['type']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <?php if (isset($errors['password'])): ?>
                                <p class="text-danger"><?php echo $errors['password']; ?></p>
                            <?php endif; ?>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="signup" class="btn btn-primary account-btn">S'inscrire</button>
                        </div>
                        <div class="text-center register-link">
                            Vous avez un compte? <a href="login2.php">Connectez-vous</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/app.js"></script>
</body>
</html>