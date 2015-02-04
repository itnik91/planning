<?php 

include_once('config.php');

$color = "blue";

if(isset($_POST['action'])){
	if($_POST['action']=="getSemaine"){
?>

<?php if($user['type']==0): ?>
<table class="table table-bordered">
	<tr>
		<th><div>Lundi</div></th>
		<th><div>Mardi</div></th>
		<th><div>Mercredi</div></th>
		<th><div>Jeudi</div></th>
		<th><div>Vendredi</div></th>
	</tr>
	<tr>
		<?php
		for($i=1;$i<=5;$i++):
			$query = getEleve(0,0,$i);
			$planning = $bdd->prepare($query);
			$planning->execute(array(
				'id_classe' => $user['classe'],
				'semaine'   => $_POST['semaine']
				));
			$dPlanning = $planning->fetch();

			$query = getEleve(1,0,$i);
			$matin = $bdd->prepare($query);
			$matin->execute(array(
				'id_matiere' => $dPlanning['id_matiere'],
				'id_salle'   => $dPlanning['id_salle'],
				'id_prof'    => $dPlanning['id_prof']
				));
			$dMatin = $matin->fetch();
		?>
		<td style="background-color:<?= $dMatin['couleur']; ?>">
			<div>
				<?= $dMatin['matiere']."<br/>".ucfirst($dMatin['prenom'])." ".$dMatin['nom']."<br/>".$dMatin['salle']; ?>
			</div>
		</td>
		<?php endfor; ?>
	</tr>
	<tr>
		<?php
		for($i=1;$i<=5;$i++):
			$query = getEleve(0,1,$i);
			$planning = $bdd->prepare($query);
			$planning->execute(array(
				'id_classe' => $user['classe'],
				'semaine'   => $_POST['semaine']
				));
			$dPlanning = $planning->fetch();

			$query = getEleve(1,1,$i);
			$aprem = $bdd->prepare($query);
			$aprem->execute(array(
				'id_matiere' => $dPlanning['id_matiere'],
				'id_salle'   => $dPlanning['id_salle'],
				'id_prof'    => $dPlanning['id_prof']
				));
			$dAprem = $aprem->fetch();
		?>
		<td style="background-color:<?= $dAprem['couleur']; ?>">
			<div>
				<?= $dAprem['matiere']."<br/>".ucfirst($dAprem['prenom'])." ".$dAprem['nom']."<br/>".$dAprem['salle']; ?>
			</div>
		</td>
		<?php endfor; ?>
	</tr>
</table>

<?php else: ?>

<table class="table table-bordered">
	<tr>
		<th><div>Lundi</div></th>
		<th><div>Mardi</div></th>
		<th><div>Mercredi</div></th>
		<th><div>Jeudi</div></th>
		<th><div>Vendredi</div></th>
	</tr>
	<tr>
		<?php

		for($i=1;$i<=5;$i++):
			$query = getProf(0,0,$i);
			$planning = $bdd->prepare($query);
			$planning->execute(array(
				'id_prof'    => $user['id'],
				'semaine'    => $_POST['semaine']
				));
			$dPlanning = $planning->fetch();

			$query = getProf(1,0,$i);
			$matin = $bdd->prepare($query);
			$matin->execute(array(
				'id_matiere' => $user['id_matiere'],
				'id_classe'  => $dPlanning['id_classe'],
				'id_salle'   => $dPlanning['id_salle']
				));
			$dMatin = $matin->fetch();
		?>
		<td style="background-color:<?= $dMatin['couleur']; ?>">
			<div>
				<?= $dMatin['matiere']."<br/>".$dMatin['classe']."<br/>".$dMatin['salle']; ?>
			</div>
		</td>
		<?php endfor; ?>
	</tr>
	<tr>
		<?php
		for($i=1;$i<=5;$i++):
			$query = getProf(0,1,$i);
			$planning = $bdd->prepare($query);
			$planning->execute(array(
				'id_prof'    => $user['id'],
				'semaine'    => $_POST['semaine']
				));
			$dPlanning = $planning->fetch();

			$query = getProf(1,1,$i);
			$aprem = $bdd->prepare($query);
			$aprem->execute(array(
				'id_matiere' => $user['id_matiere'],
				'id_classe'  => $dPlanning['id_classe'],
				'id_salle'   => $dPlanning['id_salle']
				));
			$dAprem = $aprem->fetch();
		?>
		<td style="background-color:<?= $dAprem['couleur']; ?>">
			<div>
				<?= $dAprem['matiere']."<br/>".$dAprem['classe']."<br/>".$dAprem['salle']; ?>
			</div>
		</td>
		<?php endfor; ?>
	</tr>
</table>

<?php endif; ?>

<?php	
	}
}

?>