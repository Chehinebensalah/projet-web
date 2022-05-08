<?php
session_start();
@$login = $_POST["login"];
@$pass = md5($_POST["pass"]);
@$valider = $_POST["valider"];
$erreur = "";
if (isset($valider)) {
   include("connexion.php");
   $sel = $pdo->prepare("select * from enseignant where login=? and pass=? limit 1");
   $sel->execute(array($login, $pass));
   $tab = $sel->fetchAll();
   if (count($tab) > 0) {
      $_SESSION["prenomNom"] = ucfirst(strtolower($tab[0]["prenom"])) .
         " " . strtoupper($tab[0]["nom"]);
      $_SESSION["autoriser"] = "oui";
      header("location:index.php");
   } else
      $erreur = "Mauvais login ou mot de passe!";
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />
   <title> Login </title>
   <link rel="stylesheet" href="style1.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />

</head>

<body onLoad="document.fo.login.focus()">
   <div class="container">
      <div class="wrapper">
         <div class="erreur"><?php echo $erreur ?></div>
         <div class="title"> Login </div>
         <form name="fo" method="post" action="">
            <div class="row">
               <i class="fas fa-user"></i>
               <input type="text" name="login" placeholder="Login" />
            </div>
            <div class="row">
               <i class="fas fa-lock"></i>
               <input type="password" name="pass" placeholder="Mot de passe" />
            </div>
            <div class="row button">
               <input type="submit" name="valider" value="S'authentifier" />
            </div>
            <div class="signup-link">
               <a href="inscription.php"> S'inscrire </a>
            </div>
         </form>
      </div>
   </div>
</body>

</html>