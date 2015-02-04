<?php 

$semaine = 1;

if(!isset($_SESSION['id_user'])){
	header('Location: login.php');
}

?>

<div class="planning">
	<div class="btn-toolbar" role="toolbar" aria-label="group">
		<div id="number">
		<?php for($i=1;$i<=3;$i++): ?>
  		<a href="<?= $i; ?>" class="plng"><button type="button" class="btn btn-default semaine"><?= $i; ?></button></a>
  		<?php endfor; ?>
  		</div>
	</div>
	<div class="planningjs center"><p>Choisissez une semaine.</p></div>
</div>
<script src="js/planning.js" ></script>