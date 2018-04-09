<?php
require_once __DIR__ . '/../include/init.php';

adminSecurity();

?>
<!-- Lister les catégories dans un tableau HTML -->
<!-- Le requêtage ici -->
<?php
$query = 'SELECT * FROM categorie';
$stmt = $pdo->query($query);
$categorie = $stmt->fetchAll();
?>

<?php
include __DIR__ . '/../layout/top.php';
?>

<h1>Gestion catégories</h1>

<p><a class="btn btn-info" href="categorie-edit.php">Ajouter une catégorie</a></p>

<!-- Le tableau HTML ici-->

<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">nom</th>
      <th width="250px"></th>
    </tr> 
	<?php
	// une boucle pour avoir un tr avec 2 td pour chaque catégorie

	foreach ($categorie as $category) : 
		?>
			<tr>
				<td><?=$category['ID']; ?></td>
				<td><?=$category['nom']; ?></td>
				<td>
					<a class="btn btn-info" href="categorie-edit.php?id=<?=$category['ID']; ?>">Modifier</a>
					<a class="btn btn-danger" href="categorie-delete.php?id=<?=$category['ID']; ?>">Supprimer</a>
				</td>
			</tr>

	<?php
	endforeach;
	?>

  <!--  une boucle pour avoir un tr avec 2 td pour chaque catégorie -->	

  

</table>



<!-- Le tableau HTML ici-->

<?php
include __DIR__ . '/../layout/bottom.php';
?>