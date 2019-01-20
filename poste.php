<?php

  session_start();

  // On recupere les valeurs
  $poste = isset($_POST["poste"])?$_POST["poste"] : "";
  $error = "";

  // On teste si les champs ne sont pas vide sinon on affiche un message d'erreur
  if($poste == "")
  {
   $error .= "Pas de poste<br/>";
  }

  // Si il n'y a pas d'erreur
  if ($error != "")
  {
    echo "Erreur :<br> $error";
  }
  else
  {
    // Essayer de se connecter à la base de données
    try
    {
      $bdd = new PDO('mysql:host=localhost;dbname=netpool;charset=utf8', 'root', '');
      // Modifier le poste
      $requete = $bdd->prepare('UPDATE utilisateur SET poste = ? WHERE id_utilisateur = ?');
      $requete->execute(array($poste, $_SESSION['$id_utilisateur']));
      // Récupérer le résultat
      $resultat = $requete->fetch();
      // Enregistrer dans la variable
      $_SESSION['$poste'] = $poste;
      $bdd = null;
      header('Location:../pages/profil.php');
    }
    catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }

  }
?>
