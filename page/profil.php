<?php 

if(isset($_POST['modifMail'])){
	if($_POST['email']!=$_POST['email2']){
		$msg = "Les adresses mail ne correspondent pas";
	}
    $email = $_POST['email'];
    $pass = sha1('it'.$_POST['pass']);

    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email AND pass = :pass");
    $req->execute(array(
        'email' => $user['email'],
        'pass' => $pass
        ));
    $result = $req->fetch();
    if(!$result){
        $msgMail = "Mot de passe invalide";
    }else{
    	$existMail = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email");
	    $existMail->execute(array('email' => $email));
	    $resultMail = $existMail->fetch();

	    if($resultMail){
	    	$msgMail = "Cette adresse mail existe déjà";
	    }else{
	    	$req = $bdd->prepare("UPDATE utilisateurs SET email = :email WHERE id = :id_user");
	     	$req->execute(array(
	        'email' => $email,
	        'id_user' => $user['id']
	        ));
	        $msg2 = "Modification réussie !";
	        unset($email);
	    }
    } 
}

if(isset($_POST['modifPass'])){
	if($_POST['pass1']!=$_POST['pass2']){
		$msg = "Les mots de passe ne correspondent pas";
	}
    $pass = sha1('it'.$_POST['old_pass']);
    $new_pass = sha1('it'.$_POST['pass1']);

    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email AND pass = :pass");
    $req->execute(array(
        'email' => $user['email'],
        'pass' => $pass
        ));
    $result = $req->fetch();
    if(!$result){
        $msgPass = "Mot de passe invalide";
    }else{
     	$req = $bdd->prepare("UPDATE utilisateurs SET pass = :pass WHERE id = :id_user");
     	$req->execute(array(
        'pass' => $new_pass,
        'id_user' => $user['id']
        ));
        $msg2 = "Modification réussie !";
    } 
}

$classe = $bdd->prepare("SELECT classe from classes WHERE id = :id_classe");
$classe->execute(array('id_classe' => $user['classe']));
$dClasse = $classe->fetch();

?>

<div class="containeur">
	<div class="home">
		<p><?= $user['nom']." ".ucfirst($user['prenom']); ?></p>
		<p><?= $dClasse['classe']; ?></p>
		<p><?= $user['email']; ?></p>
		<button type="button" class="btn btn-primary btn-xs mail">Changer d'adresse mail</button>
		<button type="button" class="btn btn-primary btn-xs pass">Changer de mot de passe</button><br><br>
		<span class="label label-success"><?php if(isset($msg2)) echo $msg2; ?></span>
	</div>
	<div class="changePass">
		<div class="container log">
	        <form class="form-signin" method="post">
	            <h4 class="form-signin-heading">Changement mot de passe</h4>
	            <hr>
	            <input type="password" name="old_pass" class="input-block-level" placeholder="Mot de passe actuel" required>
	            <input type="password" name="pass1" class="input-block-level"  placeholder="Nouveau mot de passe" required>
	            <input type="password" name="pass2" class="input-block-level" placeholder="Confirmation mot de passe" required>
	            <div class="control-group">
	                <div class="controls">
		                <button type="submit" name="modifPass" class="btn btn-primary modifPass">Modifier</button>
		                <span class="label label-important confirPass"><?php if(isset($msgPass)) echo $msgPass; ?></span>
	                </div>
	            </div>
	        </form>
		</div>
	</div>
	<div class="changeMail">
		<div class="container log">
	        <form class="form-signin" method="post">
	            <h4 class="form-signin-heading">Changement d'adresse mail</h4>
	            <hr>
	            <input type="password" name="pass" class="input-block-level" placeholder="Mot de passe" required>
	            <input type="text" name="email" class="input-block-level"  placeholder="Nouvelle adresse mail" value="<?php if(isset($email)) echo $email; ?>" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$" required>
	            <input type="text" name="email2" class="input-block-level" placeholder="Confirmation adresse mail" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$" required>
	            <div class="control-group">
	                <div class="controls">
		                <button type="submit" name="modifMail" class="btn btn-primary modifMail">Modifier</button>
		                <span class="label label-important confirMail"><?php if(isset($msgMail)) echo $msgMail; ?></span>
	                </div>
	            </div>
	        </form>
		</div>
	</div>
</div>