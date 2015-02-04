<?php 
session_start();

try{
  $bdd = new PDO('mysql:host=localhost;dbname=planning', 'root', '');
}
catch(Exception $e){
    die('Erreur : '.$e->getMessage());
}

if(isset($_POST['connection'])){
    $email = $_POST['email'];
    $pass = sha1('it'.$_POST['pass']);

    $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE email = :email AND pass = :pass");
    $req->execute(array(
        'email' => $email,
        'pass' => $pass
        ));
    $result = $req->fetch();
    if(!$result){
        $msg = "Email ou mot de passe invalide";
    }
    elseif ($result['type'] == 2) {
      $_SESSION['id_user'] = $result['id'];
      $_SESSION['type'] = $result['type'];
        header("Location: admin/index.php");
    }
    else{
      $_SESSION['id_user'] = $result['id'];
        header("Location: index.php");
    } 
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="shortcut icon" type="image/jpeg" href="" />
  <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="css/style.css" rel="stylesheet" media="screen">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Planning</title>
</head>
<body>
  <br>
  <div style="text-align:center">eleve@gmail.com / test<br>prof@gmail.com / test</div>
    <div class="container log">
        <form class="form-signin" method="post">
            <h3 class="form-signin-heading">Connectez-vous</h3>
            <input type="text" name="email" class="input-block-level" value="<?php if(isset($email)) echo $email; ?>" placeholder="Adresse email" pattern="^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-z]{2,4}$" required>
            <input type="password" name="pass" class="input-block-level" placeholder="Mot de passe" required>
            <div class="control-group">
                <div class="controls">
                  <button type="submit" name="connection" class="btn btn-primary">Connection</button>
                </div>
            </div>
            <span class="label label-important"><?php if(isset($msg)) echo $msg; ?></span>
        </form>
    </div>
</body>
</html>