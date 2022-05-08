<?php
session_start();
@$nom = $_POST["nom"];
@$prenom = $_POST["prenom"];
@$login = $_POST["login"];
@$pass = $_POST["pass"];
@$repass = $_POST["repass"];
@$valider = $_POST["valider"];
$erreur = "";
if (isset($valider)) {
   if (empty($nom)) $erreur = "Nom laissé vide!";
   elseif (empty($prenom)) $erreur = "Prénom laissé vide!";
   elseif (empty($prenom)) $erreur = "Prénom laissé vide!";
   elseif (empty($login)) $erreur = "Login laissé vide!";
   elseif (empty($pass)) $erreur = "Mot de passe laissé vide!";
   elseif ($pass != $repass) $erreur = "Mots de passe non identiques!";
   else {
      include("connexion.php");
      $sel = $pdo->prepare("select id from enseignant where login=? limit 1");
      $sel->execute(array($login));
      $tab = $sel->fetchAll();
      if (count($tab) > 0)
         $erreur = "Login existe déjà!";
      else {
         $ins = $pdo->prepare("insert into enseignant(nom,prenom,login,pass) values(?,?,?,?)");
         if ($ins->execute(array($nom, $prenom, $login, md5($pass))))
            header("location:login.php");
      }
   }
}
?>
<!DOCTYPE html>
<html>

<head>
   <meta charset="utf-8" />
   <link rel="stylesheet" href="style1.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    
   
   <div class="container">
      <div class="wrapper">
      <div class="title"> inscription </div>
      <div class="erreur">
         <?php echo $erreur ?>    
         <form name="fo" method="post" action="">
         
            <div class="row">
            <i class="fas fa-user"></i>
               <input type="text" name="nom" placeholder="Nom" value="<?php echo $nom ?>" />
            </div>
            <div class="row">
            <i class="fas fa-user"></i>
               <input type="text" name="prenom" placeholder="Prénom" value="<?php echo $prenom ?>" />
            </div>
            <div class="row">
            <i class="fas fa-archive"></i>
               <input type="text" name="login" placeholder="Email" value="<?php echo $login ?>" />
            </div>
            <div class="row">
               <i class="fas fa-lock"></i>
               <input type="password" name="pass" placeholder="Mot de passe" />
            </div>
            <div class="row">
               <i class="fas fa-lock"></i>
               <input type="password" name="repass" placeholder="Confirmer Mot de passe" />
            </div>
            <div class="row button">
               <input type="submit" name="valider" value="S'inscrire" />
            </div>
            </div>
         </form>
      </div>
   </div>
</body>

</html>