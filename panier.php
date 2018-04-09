<?php
/*
- si le panier est vide : afficher un message
- sinon afficher un tableau HTML avec pour chaque produit du panier :
nom du produit, prix unitaire, quantite, prix total pour le produit
- faire une fonction getTotalPanier() qui calcule le moment total du panier et l'utiliser le tableau pour afficher le total

- Remplacer l'affichage de la quantité par un formulaire avec 
	- un <input type="number"> pour la quantité,
	- un input hidden pour voir l'id du produit dont on modifie la qté
	- un bouton submit
Faire une fonction modifierQuantitePanier($produitId, $quantite) qui met à jour la quantité pour le produit si la quantité n'est pas 0, et qui supprime le produit du panier sinon 
Appeler cette fonction quand un des formulaire est envoyé
*/

require_once __DIR__ .'/include/init.php';

if(isset($_POST['commander'])) {
	$query = <<<EOS

	INSERT INTO commande (
				utilisateur_id,
				montant_total
			) VALUES(
				:utilisateur_id,
				:montant_total
			)

EOS;

	$stmt = $pdo->prepare($query);
	$stmt-> bindValue(':utilisateur_id', $_SESSION['utilisateur']['id']);
	$stmt-> bindValue(':montant_total', getTotalPanier());
	$stmt->execute();

	$commandeId = $pdo->lastInsertId();

$query = <<<EOS

	INSERT INTO detail_commande (
				commande_id,
				produit_id,
				prix,
				quantite
			) VALUES(
				:commande_id,
				:produit_id,
				:prix,
				:quantite
			)

EOS;

	$stmt = $pdo->prepare($query);
	$stmt->bindValue(':commande_id', $commandeId);

	foreach ($_SESSION['panier'] as $produitId => $produit) {
		$stmt->bindValue(':produit_id', $produitId);
		$stmt->bindValue(':prix', $produit['prix']);
		$stmt->bindValue(':quantite',$produit['quantite']);
		$stmt->execute();
	}
	setFlashMessage('La commande est enregistrée');
	// on vide le panier
	$_SESSION['panier'] = [];
}
	/*
	Enregistrer la commande et son détail en bdd
	Afficher un message de confirmation
	vider le panier
	*/


if (isset($_POST['modifier-quantite'])) {
	modifierQuantitePanier($_POST['produit-id'], $_POST['quantite']);
	setFlashMessage('La quantité a été modifiée');
}

include __DIR__ . '/layout/top.php';
?>
	<h1>Panier</h1>

<?php
if (empty($_SESSION['panier'])) :
?>

	<div class="alert alert-info">
		le panier est vide
	</div>

<?php
else :
?>

<table class="table">
		<tr>
			<th>nom produit</th>
			<th>Prix unitaire</th>
			<th>Quantité</th>
			<th>Total</th>
		</tr>

<?php
foreach ($_SESSION['panier'] as $produitId => $produit) :	
?>
	<tr>
		<td><?=$produit['nom']; ?></td>
		<td><?=prixFr($produit['prix']); ?></td>
		<td>
			<form method="post" class="form-inline">
				<input type="number" 
						value="<?= $produit['quantite'];?>" 
						name="quantite" 
						class="form-control col-sm-2"
						min="0">
				<input type="hidden" 
						value="<?= $produitId;?>" 
						name="produit-id">
				<button type="submit" 
						class="btn btn-primary" 
						name="modifier-quantite">
					Modifier
				</button>
			</form>
		</td>

		<td><?=prixFr($produit['prix'] * $produit['quantite']); ?></td>

	</tr>

<?php
endforeach;
?>

<tr>
	<th colspan="3">Total</<th>
	<td><?=prixFr(getTotalPanier());?></td>
</tr>

<?php
endif;
?>

</table>

<?php
if (isUserConnected()) :
?>

<form method="post">
	<p class="text-right">
		<button type="submit" name="commander" class="btn btn-primary">
			Valider la commande
		</button>
	</p>
</form>

<?php
else :
?>

 <div class="alert alert-info">
 	Vous devez vous connecter ou vous inscrire pour valider la commande
 </div>

<?php
endif;
?>

<?php
include __DIR__ . '/layout/bottom.php';
?>

<!-- - Remplacer l'affichage de la quantité par un formulaire avec 
	- un <input type="number"> pour la quantité,
	- un input hidden pour voir l'id du produit dont on modifie la qté
	- un bouton submit
Faire une fonction modifierQuantitePanier($produitId, $quantite) qui met à jour la quantité pour le produit si la quantité n'est pas 0, et qui supprime le produit du panier sinon 
Appeler cette fonction quand un des formulaire est envoyé
 -->