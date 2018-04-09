<?php
require_once __DIR__ . '/../include/init.php';

adminSecurity();

$query = 'DELETE photo FROM produit WHERE id = ' . $_GET['id'];
$stmt = $pdo->query($query);
$photo = $stmt->fetchColumn();

// on supprime l'image du produit dans le répertoire photo
if (!empty($photo)) {
	unlink(PHOTO_DIR . $photoActuelle);
}

$query = 'DELETE FROM produit WHERE id = ' . $_GET['id'];
$pdo->exec($query);

setFlashMessage('Le produit est supprimé');
header ('Location: produits.php');
die;