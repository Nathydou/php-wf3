<?php
function setFlashMessage($message, $type = 'success')
{
	$_SESSION['flashMessage'] = [
		'message' => $message,
		'type' => $type
	];
}

function displayFlashMessage()
{
	if (isset($_SESSION['flashMessage'])) {
		$message = $_SESSION['flashMessage']['message'];
		$type = ($_SESSION['flashMessage']['type'] == 'error')
		? 'danger' //pour la classe alert-danger du bootstrap
		: $_SESSION['flashMessage']['type']
		;

		echo '<div class="alert alert-' . $type . '">' . '<h5 class ="alert-heading">' . $message . '</h5>' . '</div>'
		;

		// suppresssion du msg de la session pour affichage "one shot"
		unset($_SESSION['flashMessage']);
	}
}

function sanitizeValue(&$value) 
{
	// trim() supprime les espaces en début et fin de chaîne
	// strip_tags() supprime les balises HTML
	$value = trim(strip_tags($value));
	// $striped = strip_tags($value);
	// $value = trim($striped);
}

function sanitizeArray(array &$array)
{
	// applique la fonction sanitizeValue() sur tous les éléments du tableau
	array_walk($array, 'sanitizeValue');
}

function sanitizePost()
{
	sanitizeArray($_POST);
}

function isUserConnected()
{
	return isset($_SESSION['utilisateur']);
}

function getUserFullName()
{
	if(isUserConnected()) {
		return $_SESSION['utilisateur']['prenom']
			. ' ' . $_SESSION['utilisateur']['nom']
		;
	}
}

function isUserAdmin()
{
	return isUserConnected() && $_SESSION['utilisateur']['role'] == 'admin';
}

function adminSecurity()
{
	if (!isUserAdmin())
		{
			if(!isUserConnected()) {
				header('Location: ' . RACINE_WEB . 'connexion.php');
				} else {
					header('HTTP/1.1 403 Forbidden');
					echo "Vous n'avez pas le droit d'accéder à cette page";
				}
			die;
		}
}


function prixFr($prix)
{
	return number_format($prix, 2, ',',' ') . ' €';
}

// - date de la commande formatée (functions date() et strtotime() de PHP)
// - date du statut formatée (functions date() et strtotime() de PHP)

function dateFR($dateSql)
{
	return date('d/m/Y H:i:s', strtotime($dateSql));
}


function ajoutPanier(array $produit, $quantite)
{
	// initialisation du panier
	if(!isset($_SESSION['panier'])){
		$_SESSION['panier'] = [];
	}
	// si le produit n'est pas encore dans le panier
	// on l'y ajoute
	if(!isset($_SESSION['panier'][$produit['id']])){
		$_SESSION['panier'][$produit['id']]=[
		'nom' => $produit['nom'],
		'prix' => $produit['prix'],
		'quantite' => $quantite
		];
	} else {
		// si le produit est déjà dans le panier, on met à jour la quantité
		$_SESSION['panier'][$produit['id']]['quantite'] += $quantite;
	}
}

// faire une fonction getTotalPanier() qui calcule le moment total du panier et l'utiliser le tableau pour afficher le total

function getTotalPanier()
{
		$total = 0;

		if(isset($_SESSION['panier'])) {
			foreach ($_SESSION['panier'] as $produit) {
				$total += $produit['prix'] * $produit['quantite'];
			}
		}
	return $total;
}

// Faire une fonction modifierQuantitePanier($produitId, $quantite) qui met à jour la quantité pour le produit si la quantité n'est pas 0, et qui supprime le produit du panier sinon 
// Appeler cette fonction quand un des formulaire est envoyé

function modifierQuantitePanier($produitId, $quantite) 
 {
 	if (isset($_SESSION['panier'][$produitId])) {
 		if ($quantite != 0) {
 				$_SESSION['panier'][$produitId]['quantite'] = $quantite;
 		} else {
 			unset($_SESSION['panier'][$produitId]); // unset une fonction pour suppression
 		}
 	}

}


