<?php

$pdo = new PDO(
	'mysql:host=localhost;dbname=boutique', // chaîne de connexion
	'root', // nom utilisateur
	'', // mot de passe
	[ // tableaux d'options
		PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING, // gestion des erreurs
		PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8', // gestion utf8 mysql
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // résultats en tableau associatif uniquement
	]
);