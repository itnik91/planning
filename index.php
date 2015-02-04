<?php include_once('configuration.php'); ?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8" />
	<link rel="shortcut icon" type="image/jpeg" href="img/icon.jpg" />
	<link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
	<link href="css/style.css" rel="stylesheet" media="screen">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Planning</title>
</head>
<body>
	<div id="container">
		<header>
			<div class="navbar navbar-inverse">
			  <div class="navbar-inner">
			  	<?php if($user['type'] == 0): ?>
			    <a class="brand" href="home">Espace Etudiants</a>
				<?php else: ?>
				<a class="brand" href="home">Espace Professeurs</a>
				<?php endif; ?>
			    <ul class="nav">
			      	<li class="active"><a href="home"><i class="icon-home icon-white"></i> Home</a></li>
			      	<li><a href="planning"><i class="icon-calendar"></i> Planning</a></li>
      				<li><a href="cours">Récapitulatif des cours</a></li>
			    </ul>
			    <ul class="nav pull-right">
			    <li class="dropdown">
			      	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			      		<i class="icon-user icon-white"></i>
			      		<?= $user['nom']." ".ucfirst($user['prenom']); ?> 
			      	<b class="caret"></b></a>
			      	<ul class="dropdown-menu">
			      		<li><a href="profil">    Profil</a></li>
			      		<li><a href="deconnection"><i class="icon-off"></i> Déconnection</a></li>
			      	</ul>
			    </li>
			    </ul>
			  </div>
			</div>
		</header>
		<section>
			<?php 
				if(isset($_GET['page']) && file_exists('page/'.$_GET['page'].'.php')){
					include_once('page/'.$_GET['page'].'.php');
				}
				else if(!isset($_GET['page'])){
					include_once('page/home.php');
				}else{
					include_once('page/404.php');
				}
			?>
		</section>
		<footer>
		</footer>
		<script src="http://code.jquery.com/jquery.js"></script>
    	<script src="js/bootstrap.min.js"></script>
    	<script src="js/planning.js"></script>
		<script src="js/jquery.js"></script>
		<script src="js/profil.js"></script>
	</div>
</body>
</html>