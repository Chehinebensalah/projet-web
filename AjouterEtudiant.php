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

    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
</head>

<body>
    <div class="btn">
        <span class="fas fa-bars"></span>
    </div>
    <nav class="sidebar">
        <div class="text">
            Side Menu
        </div>
        <ul>
            <li class="active"><a href="#">Dashboard</a></li>
            <li>
                <a href="index.php" class="feat-btn">home

            </li>
            <li>
                <a href="#" class="serv-btn">Gestion Etudiant
                    <span class="fas fa-caret-down second"></span>
                </a>
                <ul class="serv-show">
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
    <div></div>
    <div class="content">
        <style>
            .select-box {
                width: 100%;
                color: #17789e;
                background-color: white;
            }

            .select-box .select {
                height: 40px;
                width: 100%;
                position: relative;
                border-radius: 20px;
                font-weight: 400;
                font-size: large;
                justify-content: center;
                align-items: center;
                background: white;
                color: #17789e;
            }

            .select-box .select option {
                text-align: center;
            }
        </style>

        <div class="container">
            <div class="wrapper">
                <title class="title">Ajouter Etudiant </title>
                <?php

include("connexion.php");
if (isset($_POST['ajouter'])) {
    $Classe = trim($_POST['classe']);
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $pwd= $_POST['pwd'];
    $cpwd= $_POST['cpwd'];
    $cin = $_POST['cin'];
    $email = $_POST['email'];
    $adresse = $_POST['adresse'];
    $sqlverif = " select * from etudiant where cin=?";
    $stmtverif = $pdo->prepare($sqlverif);
    $stmtverif->execute(array($cin));
    $res = $stmtverif->fetchAll();
    if (count($res) > 0) {
        echo " CIN existe deja ";
    } else {
        $sql = "INSERT INTO etudiant(cin,email,password,cpassword,nom,prenom,adresse,Classe)  values (?,?,?,?,?,?,?,?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(array($cin,$email,$pwd,$cpwd,$nom,$prenom,$adresse,$Classe,));
        echo "  ajouté avec succées " ;
    }
}
?>
                <form id="myForm" method="POST">
                    <div class="row">
                        <input type="text" id="nom" name="nom" placeholder="Nom:" required />
                    </div>
                    <div class="row">
                        <input type="text" id="prenom" name="prenom" placeholder="Prenom:" required />
                    </div>
                    <div class="row">
                        <input type="number_format" id="cin" name="cin" placeholder="CIN:" required />
                    </div>
                    <div class="row">
                        <input type="password" id="pwd" name="pwd" placeholder="Mot de passe:" required />
                    </div>
                    <div class="row">
                        <input type="password" id="cpwd" name="cpwd" placeholder="Confirmer Mot de passe:" required />
                    </div>
                    <div class="row">
                        <input type="email" id="email" name="email" placeholder="E-mail:" required />
                    </div>
                    <div class="row">
                        <div class="select-box">
                            <select name="classe" id="classe" class="select">
                                <?php
                                $sql0 = "SELECT * FROM classe";
                                $stmt0 = $pdo->prepare($sql0);
                                $stmt0->execute();
                                while ($cats = $stmt0->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $cats['name_classe']; ?>">
                                        <?php echo $cats['name_classe']; ?>
                                    </option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <input type="text" id="adresse" name="adresse" placeholder="Adresse:" required />
                    </div>
                    <div>
                    <button class="btnajouter" type="submit" name="ajouter" value="ajouter">Ajouter</button>
                    </div>
                </form>

            </div>
        </div>

    </div>
    
    </script>
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
