<?php
// faire la page qui liste les produits dans un tableau HTML
// tous les champs sauf la description
// bonus :
// afficher le nom de la categorie au lieu de son id
require_once __DIR__ . '/../include/init.php';

adminSecurity();

// p et c sont les alias des tables produit et categorie
// categorie_nopm est l'alias du champ nom de la table categorie
// p.* veut dire : tous les champs de la table produit

$query = <<<EOS
SELECT p.*, c.nom AS categorie_nom
FROM produit p
JOIN categorie c ON p.categorie_id = c.id
EOS;

$stmt = $pdo->query($query);
$produits = $stmt->fetchAll();
?>

<?php
include __DIR__ . '/../layout/top.php';
?>

<h1>Gestion produits</h1>

<p><a class="btn btn-info" href="produit-edit.php">Ajouter un produit</a></p>

<!-- Le tableau HTML ici-->

<table class="table">
  <thead>
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Nom</th>
      <th scope="col">Reference</th>
      <th scope="col">Prix</th>
      <th scope="col">Catégorie</th>
      <th width="250px"></th>
    </tr> 

	<?php
	foreach ($produits as $produit) : 
	?>
			<tr>
				<td><?=$produit['id']; ?></td>
				<td><?=$produit['nom']; ?></td>
				<td><?=$produit['reference']; ?></td>
				<td><?=prixFr($produit['prix']); ?></td>
				<td><?=$produit['categorie_nom']; ?></td>
				<td>
					<a class="btn btn-info" href="produit-edit.php?id=<?=$produit['id']; ?>">Modifier</a>
					<a class="btn btn-danger" href="produit-delete.php?id=<?=$produit['id']; ?>">Supprimer</a>
				</td>
			</tr>

	<?php
	endforeach;
	?>

 
</table>

<?php
include __DIR__ . '/../layout/bottom.php';
?>

<!-- Le tableau HTML ici-->

<?php
include __DIR__ . '/../layout/bottom.php';
?>