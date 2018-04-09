<?php
require_once __DIR__ . '/../include/init.php';

adminSecurity();

$query = 'DELETE FROM categorie WHERE ID= ' . $_GET['id'];
$pdo->exec($query);

setFlashMessage('La catégorie est supprimée');

header ('Location: category.php');
die;