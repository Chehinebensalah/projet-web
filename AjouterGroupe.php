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
        SCO ENICARTHAGE
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
                justify-content: space-around;
            }

            .select-box .select {
                height: 30px;
                width: 100%;
                position: relative;
                border-radius: 20px;
                font-weight: 400;
                font-size: large;
                justify-content: center;
                align-items: center;
                background: white;
                color: #17789e;
                margin-top: auto;
            }

            .select-box .select option {
                text-align: center;
            }

            input[type="date"] {
                background-color: white;
                color: #17789e;
                padding: 15px;
                top: 50%;
                left: 50%;
                font-family: "Roboto Mono", monospace;

                font-size: 44px;
                border: none;
                outline: none;
                border-radius: 5px;
                position: absolute;
                transform: translate(-50%);
            }

            ::-webkit-calendar-picker-indicator {
                background-color: #17789e;

                padding: 5px;
                cursor: pointer;
                border-radius: 3px;
            }
        </style>
        <div class="container">

            <div class="wrapper">
                <title class="title">Ajouter Groupe </title>
                <form action="AjouterGroupe.php" method="POST" id="myForm">
                    <?php

                    include("connexion.php");
                    if (isset($_POST['ajouter'])) {
                        $niveau = trim($_POST['niveau']);
                        $specialite = trim($_POST['specialite']);
                        $groupe = trim($_POST['groupe']);
                        $name_classe = "$niveau.$specialite.$groupe";
                        $sqlverif = " select * from classe where name_classe=?";
                        $stmtverif = $pdo->prepare($sqlverif);
                        $stmtverif->execute(array($name_classe));
                        $res = $stmtverif->fetchAll();
                        if (count($res) > 0) {
                            echo " groupe existe deja ";
                        } else {
                            $sql = "INSERT INTO classe values (:name_classe)";
                            $stmt = $pdo->prepare($sql);
                            $stmt->execute([
                                ':name_classe' => $name_classe,
                            ]);
                            echo " le groupe : $name_classe est ajouté avec succées " ;
                        }
                    }
                    ?>
                    <div class="row">
                        <div class="select-box">
                            <h3 for="niveau">Selectionner le niveau</h3>
                            <select id="niveau" name="niveau" class="select">
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="select-box">
                            <h3 for="specialite">Selectionner la specialite</h3>
                            <select id="specialite" name="specialite" class="select">
                                <option selected value="INFO"> genie informatique</option>
                                <option value="GSI"> genie infotronique</option>
                                <option value="MECA"> genie mecatronique</option>
                                <option value="GSIL"> genie industriel</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="select-box">
                            <h3 for="groupe">Selectionner le groupe</h3>
                            <select id="groupe" name="groupe" class="select">
                                <option value="A"> A </option>
                                <option value="B"> B </option>
                                <option value="C"> C </option>
                                <option value="D"> D </option>
                                <option value="E"> E </option>
                            </select>
                        </div>
                    </div>
                    <div class="row">

                    </div>
                    <button class="btnajouter" type="submit" name="ajouter" value="ajouter">Ajouter</button>

            </div>
        </div>
        </form>

    </div>
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