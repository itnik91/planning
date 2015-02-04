<div class="cours">
	<?php if($user['type']==0): 
	$eleve = $bdd->query("SELECT matiere,UPPER(nom) as nom,prenom,utilisateurs.id as id_prof FROM matieres,utilisateurs 
					WHERE matieres.id = id_matiere");
	?>
	<table class="table table-bordered">
		<thead> 
		<tr>
			<th><div>Matière</div></th>
			<th><div>Professeur</div></th>
			<th><div>Durée</div></th>
			<th><div>Nombre</div></th>
		</tr>
		</thead> 
		<?php while($data = $eleve->fetch()): 
		$nbCours = $bdd->prepare("SELECT COUNT(id_prof) as nbCours FROM planning WHERE id_classe = :id_classe AND id_prof = :id_prof");
		$nbCours->execute(array(
			'id_classe' => $user['classe'],
			'id_prof'   => $data['id_prof']
			));
		$dNbCours = $nbCours->fetch();
		?>
		<tbody>
		<tr>
			<td><div><?= $data['matiere']; ?></div></td>
			<td><div><?= ucfirst($data['prenom'])." ".$data['nom']; ?></div></td>
			<td><div><?= $dNbCours['nbCours']*4; ?>h</div></td>
			<td><div><?= $dNbCours['nbCours']; ?></div></td>
		</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
	<?php else: 
	$prof = $bdd->prepare("SELECT DISTINCT classes.id as id_classe,classe FROM classes,planning WHERE classes.id = id_classe AND id_prof = :id_user");
	$prof->execute(array('id_user' => $user['id']));
	?>
	<table class="table table-bordered">
		<thead> 
		<tr>
			<th><div>Classe</div></th>
			<th><div>Durée</div></th>
			<th><div>Nombre</div></th>
		</tr>
		</thead> 
		<?php while($data = $prof->fetch()): 
		$nbClasse = $bdd->prepare("SELECT COUNT(id_classe) as nbClasse FROM planning WHERE id_prof = :id_user AND id_classe = :id_classe");
		$nbClasse->execute(array(
			'id_user'   => $user['id'],
			'id_classe' => $data['id_classe']
			));
		$dNbClasse = $nbClasse->fetch();
		?>
		<tbody>
		<tr>
			<td><div><?= $data['classe']; ?></div></td>
			<td><div><?= $dNbClasse['nbClasse']*4; ?>h</div></td>
			<td><div><?= $dNbClasse['nbClasse']; ?></div></td>
		</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
	<?php endif; ?>
</div>