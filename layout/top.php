<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Boutique</title>
  </head>
  <body>

    <?php
    if(isUserAdmin()):
    ?>

  	<nav class="navbar navbar-expand-md navbar-dark bg-dark">
  	    <div class="container navbar-nav">
  	    	<a class="navbar-brand" href="#">Admin</a>
  	    	  <div class="navbar-collapse">
	  	    	 <ul class="navbar-nav">
  	  	    		<li class="nav-item">
  	  	    			<a class="nav-link" href="<?=RACINE_WEB; ?>admin/category.php">
  	  	    				Gestion catégories
  	  	    			</a>
  	  	    		</li>
                <li class="nav-item">
                  <a class="nav-link" href="<?=RACINE_WEB; ?>admin/produits.php">
                    Gestion produits
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?=RACINE_WEB; ?>admin/commandes.php">
                    Gestion commandes
                  </a>
                </li>
	  	    	 </ul>
	  	     </div>
  	    </div>
  	</nav>

    <?php
    endif;
    ?>

		<nav class="navbar navbar-expand-md navbar-dark bg-secondary">
  	    <div class="container navbar-nav">
  	    	<a class="navbar-brand" href="<?=RACINE_WEB; ?>index.php">Boutique</a>
              <?php
              include __DIR__ . '/menu-categorie.php';
              ?>
            <ul class="navbar-nav">
              <?php
              if (isUserConnected()):
              ?>
                <li class="nav-item">
                  <a class="nav-link">
                    <?=getUserFullName(); ?>
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= RACINE_WEB; ?>deconnexion.php"> Deconnexion 
                  </a>
                </li>
              <?php
              else:
              ?>
                <li class="nav-item <?php if ($_SERVER['PHP_SELF'] == RACINE_WEB . 'inscription.php'){echo 'active';} ?>">

                  <a class="nav-link" href="<?= RACINE_WEB; ?>inscription.php">Inscription 
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="<?= RACINE_WEB; ?>connexion.php"> Connexion 
                  </a>
                </li>
              <?php
              endif;
              ?>
                <li class="nav-item">
                  <a class="nav-link" href="<?= RACINE_WEB; ?>panier.php"> Panier 
                  </a>
                </li>
          </ul>
  	   </div>
		</nav>

	<div class="container">
    
    <?php
    displayFlashMessage();
    ?>
