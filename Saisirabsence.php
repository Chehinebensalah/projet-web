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
            <?php
            if (isset($_POST['ajouter'])) {
                $dateAbs = trim($_POST['deb']);
                $classe = trim($_POST['classe']);
                $module = trim($_POST['module']);
                $type = trim($_POST['type']);
                $nom = trim($_POST['nom']);
                $sql = "INSERT INTO absence (nomEtd, classe, module, dateAbs, typeAbs) values (:nomEtd, :classe, :module, :dateAbs, :typeAbs)";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':dateAbs' => $dateAbs,
                    ':classe' => $classe,
                    ':module' => $module,
                    ':typeAbs' => $type,
                    ':nomEtd' => $nom,
                ]);
            }

            ?>
            <div class="wrapper">
                <title class="title">Saisir Absence </title>
                <div id="demo"></div>
                <form action="notsaisirabsence.php" method="POST" id="myForm">
                    <h4><?php if (isset($_POST['ajouter'])){ echo "Ajout d'absence effectué";} ?></h4>
                    <div class="row">
                        <div class="select-box">

                            <h3 for="deb">Selectionner la date d'absence:</h3><br>
                            <input class="calandrier" type="date" id="deb" name="deb" value="2022-05-01" min="1980-01-01" max="2022-12-31">

                        </div>
                    </div>
                    <div class="row">
                        <div class="select-box">
                            <h3 for="module">Selectionner un module:</h3>
                            <select id="module" name="module" class="select">
                                <option value="Tech.Web">Tech. Web</option>
                                <option value="SGBD">SGBD</option>
                                <option value="Struct.Don">Struct.Don</option>
                                <option value="Anl.Num">Anl.Num</option>
                                <option value="Stat">Stat</option>
                                <option value="POO">POO</option>
                                <option value="TP.POO">TP.POO</option>
                                <option value="Ang">Ang</option>
                                <option value="Fr">Fr</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="select-box">
                            <h3 for="classe">Selectionner la Classe:</h3>
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
                        <div class="select-box">
                            <h3 for="nom">Choisir l'étudiant:</h3>
                            <select name="nom" id="classe" class="select">
                                <?php
                                $sql0 = "SELECT * FROM etudiant ";
                                $stmt0 = $pdo->prepare($sql0);
                                $stmt0->execute();
                                while ($cats = $stmt0->fetch(PDO::FETCH_ASSOC)) { ?>
                                    <option value="<?php echo $cats['nom']; ?>">
                                        <?php echo $cats['nom']; ?>
                                    </option>
                                <?php }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="select-box">
                            <h3 for="type">Selectionner le type d'absence: </h3>
                            <select id="type" name="type" class="select">
                                <option value="Justifieé">Justifièe</option>
                                <option value="NoNJustifieé">Non justifièe</option>
                            </select>
                        </div>
                    </div>
                    <button class="btnajouter" type="submit" name="ajouter" value="ajouter">Ajouter</button>
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