<?php
session_start();
            include("connexion.php");
            @$cin = $_GET["cin"];
                $sel = $pdo->prepare("delete from etudiant where cin=? limit 1 ");
                $sel->execute(array($cin));
                $results = $sel->fetchAll();
                
                header("location:notmodifiergroupe.php"); 
                echo" la suppression est effectué "  ;
            ?>