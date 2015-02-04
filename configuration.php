 <?php 
session_start();

try{
	$bdd = new PDO('mysql:host=sql2.olympe.in;dbname=fhnc0use', 'fhnc0use', '942332trolle');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

$_SESSION['id_user'] = 6;
if(isset($_SESSION['id_user'])){
	$req = $bdd->prepare("SELECT id, UPPER(nom) as nom, prenom, email, pass, type, classe, id_matiere FROM utilisateurs WHERE id = :id");
	$req->execute(array('id' => $_SESSION['id_user']));
	$user = $req->fetch();
}else{
	header("Location: login.php");
}

function getEleve($order, $horaire, $i){
	if($order==0){
		$query = "SELECT id_prof,id_salle,id_matiere FROM planning,utilisateurs 
				WHERE id_classe = :id_classe
				AND semaine = :semaine
				AND id_jour = $i
				AND horaire = $horaire
				AND utilisateurs.id = id_prof";
	}else{
		$query = "SELECT couleur,matiere,salle,UPPER(nom) as nom,prenom 
				FROM matieres,salles,utilisateurs
				WHERE matieres.id = :id_matiere
				AND salles.id = :id_salle
				AND utilisateurs.id = :id_prof";
	}
	return $query;			
}

function getProf($order, $horaire, $i){
	if($order==0){
		$query = "SELECT id_classe,id_salle FROM planning 
				WHERE id_prof = :id_prof 
				AND semaine = :semaine
				AND id_jour = $i
				AND horaire = $horaire";
	}else{
		$query = "SELECT couleur,matiere,classe,salle 
				FROM matieres,classes,salles
				WHERE matieres.id = :id_matiere
				AND classes.id = :id_classe
				AND salles.id = :id_salle";
	}
	return $query;
}


?>