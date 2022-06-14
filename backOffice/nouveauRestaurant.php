<?php
session_start();
$servname = "localhost";
$user = "root";
$pass = "";
$dbname = "enlight_meal";
$Nom = addslashes(valid_donnees($_POST['Nom']));
$Adresse = addslashes(valid_donnees($_POST['Adresse']));
$Telephone = addslashes(valid_donnees($_POST['Telephone']));
$Etoiles = addslashes(valid_donnees($_POST['Etoiles']));
$Images = addslashes(valid_donnees($_POST['Images']));
$id_Categorie = addslashes(valid_donnees($_POST['id_Categorie']));
$Image1 = addslashes(valid_donnees($_POST['Image1']));
$Image2 = addslashes(valid_donnees($_POST['Image2']));
$Image3 = addslashes(valid_donnees($_POST['Image3']));
$noteService = addslashes(valid_donnees($_POST['noteService']));
$noteCuisson = addslashes(valid_donnees($_POST['noteCuisson']));
$noteCarte = addslashes(valid_donnees($_POST['noteCarte']));
$notePrix = addslashes(valid_donnees($_POST['notePrix']));
$Critique = addslashes(valid_donnees($_POST['Critique']));

function valid_donnees($donnees){
    $donnees = trim($donnees);
    $donnees = stripslashes($donnees);
    $donnees = htmlspecialchars($donnees);
    return $donnees;
}
try {
    
    if(isset($_SESSION['pseudo'])){  
    }else{
        header ('location: ../index.php');
    }

    $conn = new PDO("mysql:host=$servname;dbname=$dbname;charset=utf8",$user, $pass);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sth = $conn->prepare ("INSERT INTO restaurant (Nom, Adresse, Telephone, Etoiles, Images, id_Categorie, Image1, Image2, Image3, noteService, noteCuisson, noteCarte, notePrix, Critique)
                            VALUES ('$Nom', '$Adresse', '$Telephone', $Etoiles, '$Images', $id_Categorie, '$Image1', '$Image2', '$Image3', $noteService, $noteCuisson, $noteCarte, $notePrix, '$Critique')");
    $sth->execute();

    $_SESSION['ajout'] = 1;
    header("Location: backAcceuil.php");
}
catch (PDOException $e){
    echo "Erreur : " . $e->getMessage();
}
?>