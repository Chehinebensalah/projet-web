<?php
session_start();
include("connexion.php");
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
            <li><a href="Saisirabsence.php"></a> Saisir Absence</li>
            <li><a href="Afficherabsence.php"></a>Afficher Absence</li>
            <li><a href="deconnexion.php">Deconnexion</a></li>

        </ul>
    </nav>
    <div></div>
    <div class="content">
        <div class="container">
            <div class="wrapper">
                <?php 
                $query=$pdo->prepare('select * from etudiant where cin=:cin');
                $query->bindValue(':cin',$_GET['cin'],PDO::PARAM_INT);
                $results=$query->execute();
                $etudiant=$query->fetch();
                
                ?>
                <title class="title">*  Données de l'etudiant  * </title>
                    <div id="demo"></div>
                    <form id="myForm" method="POST">
                        <div class="row">
                            <input type="text" id="nom" name="nom" placeholder="Nom:" value="<?=$etudiant['nom']?>" required />
                        </div>
                        <div class="row">
                            <input type="text" id="prenom" name="prenom" placeholder="Prenom:" value="<?=$etudiant['prenom']?>" required />
                        </div>
                        <div class="row">
                            <input type="default" id="cin" name="cin" placeholder="CIN:" value="<?=$etudiant['cin']?>" required />
                        </div>
                        <div class="row">
                            <input type="email" id="email" name="email" placeholder="E-mail:" value="<?=$etudiant['email']?>" required />
                        </div>
                        <div class="row">
                            <input type="text" id="classe" name="classe" placeholder="Classe:" value="<?=$etudiant['Classe']?>" required />
                        </div>
                        <div class="row">
                            <input type="text" id="adresse" name="adresse" placeholder="Adresse:" value="<?=$etudiant['adresse']?>" required />
                        </div>
                        <div class="row button">
                        <input type="submit" name='valider' value="valider" />
                        </div>
                      <?php  
                    @$nom=$_POST["nom"];
                    @$prenom=$_POST["prenom"];
                    @$cin=$etudiant['cin'];
                    @$email=$_POST["email"];
                    @$classe=$_POST["classe"];
                    @$adresse=$_POST["adresse"];
                    if(isset($_POST["valider"])){
                        $data = [
                            'nom' => $nom,
                            'prenom' => $prenom,
                            'adresse' =>$adresse,
                            'Classe' => $classe,
                            'email' => $email,
                            'cin' => $cin,
                        ];
                        $sql = "UPDATE etudiant SET email=:email, nom=:nom, prenom=:prenom, adresse=:adresse, Classe=:Classe  WHERE cin=:cin";
                        $stmt= $pdo->prepare($sql);
                        $stmt->execute($data);
                          if($stmt) {header("location:modifier.php?cin=$cin");}
                        
                    }
                    ?>
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