<?php
include("connexion.php");
session_start();
if ($_SESSION["autoriser"] != "oui") {
    header("location:login.php");
    exit();
}
if (date("H") < 18)
    $bienvenue = "Bonjour et bienvenue " .
        $_SESSION["prenomNom"] .
        " dans votre espace personnel";
else
    $bienvenue = "Bonsoir et bienvenue " .
        $_SESSION["prenomNom"] .
        " dans votre espace personnel";
?>
<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title>HOME </title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="style1.css">
    <link rel="stylesheet" href="boxstyle.css">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="navbar">
        <div class="btn">
            <span class="fas fa-bars"></span>
        </div>
        <nav class="sidebar">
            <div class="text">
            SCO ENICARTHAGE
            </div>
            <ul>
                <li class="active"><a href="#">Dashboard</a></li>
                <li>
                    <a href="index.php" class="feat-btn">home
                </li>
                <li>
                    <a href="#" class="feat-btn">Gestion Etudiant
                        <span class="fas fa-caret-down second"></span>
                    </a>
                    <ul class="feat-show">
                        <li><a href="AjouterEtudiant.php">Ajouter Etudiant</a></li>
                        <li><a href="SupprimerEtudiant.php">Supprimer Etudiant</a></li>
                        <li><a href="ModifierEtudiant.php">Modifier Etudiant</a></li>
                        <li><a href="ChercherEtudiant.php">Chercher Etudiant</a></li>

                    </ul>
                </li>
                <li>
                    <a href="#" class="serv-btn">Gestion Groupe
                        <span class="fas fa-caret-down second"></span>
                    </a>
                    <ul class="serv-show">
                        <li><a href="AjouterGroupe.php">Ajouter Groupe</a></li>
                        <li><a href="SupprimerGroupe.php">Supprimer Groupe</a></li>
                        <li><a href="ModifierGroupe.php">Modifier Groupe</a></li>
                        <li><a href="ChercherGroupe.php">Chercher Groupe</a></li>
                    </ul>
                </li>
                <li><a href="Saisirabsence.php">saisir Absence</a></li>
                <li><a href="Afficherabsence.php">Afficher Absence</a></li>
                <li><a href="deconnexion.php">Deconnexion</a></li>

            </ul>
        </nav>
    </div>
    <div class="contenu">
        <div class="box">
            <div class="title">Saisir le cin de l'etudiant à modifier</div>
            <form action="" method="POST">
                <div class="row">
                    <input type="text" name='cin' placeholder="Donner le CIN" />
                </div>
                <div class="row button">
                    <input type="submit" name='valider' value="Chercher" />
                </div>
            </form>
        </div>
        <div class="tab">
            <?php
            @$valide = $_POST["valider"];
            @$cin = $_POST["cin"];
            if (isset($valide)) {

                $sel = $pdo->prepare("select * from etudiant where cin=? limit 1 ");
                $sel->execute(array($cin));
                $results = $sel->fetchAll();
                if (count($results) > 0) {
                    foreach ($results as $row) {
                        $cin = $row['cin'];
                        $nom = $row['nom'];
                        $prenom = $row['prenom'];
                        $email = $row['email'];
                        $classe = $row['Classe'];
                    }
                    header("location:modifier.php?cin=$cin");
                } else {
                    echo " Etudiant Non Disponible ou CIN incorrecte";
                }
            }
            ?>
        </div>
    </div>
    <script>
        $('.btn').click(function() {
            $(this).toggleClass("click");
            $('.sidebar').toggleClass("show");
        });
        $('.feat-btn').click(function() {
            $('nav ul .feat-show').toggleClass("show");
            $('nav ul .first').toggleClass("rotate");
        });
        $('.serv-btn').click(function() {
            $('nav ul .serv-show').toggleClass("show1");
            $('nav ul .second').toggleClass("rotate");
        });
        $('nav ul li').click(function() {
            $(this).addClass("active").siblings().removeClass("active");
        });
    </script>
</body>

</html>