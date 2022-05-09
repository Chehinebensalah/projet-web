<?php
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
            <li><a href="deconnexion.php">Deconnexion</a></li>

        </ul>
    </nav>
    <div></div>
    <div class="content">

        <div class="container">
            <div class="wrapper">
                <title class="title">Ajouter Etudiant </title>
                    <div id="demo"></div>
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
                            <input type="text" id="classe" name="classe" placeholder="Classe:" required />
                        </div>
                        <div class="row">
                            <input type="text" id="adresse" name="adresse" placeholder="Adresse:" required />
                        </div>
                        <div>
                            <button class="btnajouter" type="button" name="valider" onclick="ajouter()">Ajouter</button>
                        </div>
                    </form>
                
            </div>
        </div>

    </div>
    <script>
        function ajouter() {
            var xmlhttp = new XMLHttpRequest();
            var url = "http://localhost/webENICAR/ajouter.php";

            //Envoie Req
            xmlhttp.open("POST", url, true);

            form = document.getElementById("myForm");
            formdata = new FormData(form);

            xmlhttp.send(formdata);

            //Traiter Res

            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // alert(this.responseText);
                    if (this.responseText == "OK") {
                        document.getElementById("demo").innerHTML = "L'ajout de l'étudiant a été bien effectué";
                        document.getElementById("demo").style.backgroundColor = "white";
                    } else {
                        document.getElementById("demo").innerHTML = " Merci de vérifier le CIN";
                        document.getElementById("demo").style.backgroundColor = "#fba";
                    }
                }
            }


        }
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