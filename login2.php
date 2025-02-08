<?php
require "file/database.php";
require "file/functions.php";

$db = database();
$err = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if (empty($username)) {
        $err["username"] = "Veuillez entrer votre login";
    }

    if (empty($password)) {
        $err["password"] = "Veuillez entrer votre mot de passe";
    }

    if (empty($err)) {
        $sttm = $db->prepare("SELECT * FROM utilisateur WHERE login = ?");
        $sttm->execute([$username]);
        $user = $sttm->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            session_start(); // Démarrer la session après validation
            $_SESSION["id"] = $user["id"];
            $_SESSION["login"] = $user["login"];
            $_SESSION["type"] = $user["type"];
            $_SESSION["message"] = "Vous êtes maintenant connecté !";

            switch ($user["type"]) {
                case "directeur":
                    $sttm2 = $db->prepare("SELECT * FROM directeur WHERE id_user = ?");
                    $sttm2->execute([$user["id"]]);
                    $directeur = $sttm2->fetch(PDO::FETCH_ASSOC);
                    if ($directeur) {
                        $_SESSION["nom"] = $directeur["nom"];
                        $_SESSION["prenom"] = $directeur["prenom"];
                        $_SESSION["matricule"] = $directeur["matricule"];
                        header("Location: compt_directeur2.php");
                        exit();
                    }
                    break;

                case "formateur":
                    $sttm2 = $db->prepare("SELECT * FROM formateur WHERE id_user = ?");
                    $sttm2->execute([$user["id"]]);
                    $formateur = $sttm2->fetch(PDO::FETCH_ASSOC);
                    if ($formateur) {
                        $_SESSION["nom"] = $formateur["nom"];
                        $_SESSION["prenom"] = $formateur["prenom"];
                        $_SESSION["matricule"] = $formateur["matricule"];
                        header("Location: compt_formateur.php");
                        exit();
                    }
                    break;

                case "gestionnaire":
                    $sttm2 = $db->prepare("SELECT * FROM gestionnaire WHERE id_user = :id");
                    $sttm2->bindParam(':id', $user["id"]);
                    $sttm2->execute();
                    $gestionnaire = $sttm2->fetch(PDO::FETCH_ASSOC);
                    if ($gestionnaire) {
                        $_SESSION["nom"] = $gestionnaire["nom"];
                        $_SESSION["prenom"] = $gestionnaire["prenom"];
                        $_SESSION["matricule"] = $gestionnaire["matricule"];
                        header("Location: compt_gestionnaire.php");
                        exit();
                    }
                    break;
            }
        } else {
            $err["login"] = "Mot de passe / username invalid!";
        }
    }
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
    <!--[if lt IE 9]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
    <![endif]-->
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
                    <?php if (!empty($err)): ?>
                        <div class="alert alert-danger">
                            <?php foreach ($err as $error) echo '<p>' . $error . '</p>'; ?>
                        </div>
                    <?php endif; ?>
                    <form action="login2.php" autocomplete="off" method="POST" class="form-signin">
                        <div class="form-group">
                            <label>Username</label>
                            <input type="text" id="username" name="username" class="form-control" value="<?php echo htmlspecialchars($username ?? '', ENT_QUOTES); ?>">
                            <?php if (isset($err["username"])) echo '<p class="text-danger">' . $err["username"] . '</p>'; ?>
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" id="password" name="password" class="form-control">
                            <?php if (isset($err["password"])) echo '<p class="text-danger">' . $err["password"] . '</p>'; ?>
                        </div>
                        <div class="form-group text-center">
                            <button type="submit" name="connexion" class="btn btn-primary account-btn">Login</button>
                        </div>
                        <div class="text-center register-link">
                            Don't have an account? <a href="signup.php">Register Now</a>
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