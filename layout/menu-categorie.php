<?php
$query = 'SELECT * FROM categorie';
$stmt = $pdo->query($query);
$categoriesMenu = $stmt->fetchAll();
?>

<div class="navbar-collapse">

	<ul class="navbar-nav">

	<?php
	foreach($categoriesMenu as $categorieMenu):
	?>
		<li class="nav-item">
			<a class="nav-link" href="<?= RACINE_WEB ?>categorie.php?id=<?= $categorieMenu['ID']; ?>"><?=$categorieMenu['nom']; ?></a>
		</li>

	<?php
	endforeach;
	?>

	</ul>

</div>