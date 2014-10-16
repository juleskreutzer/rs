<?php require_once('func.php'); ?>
<html>
<head>
	<title>Dashboard Gegevens</title>
</head>
<body>

	<p>Geslacht van elke gebruiker:</p>
    <ul>

    	<li>Aantal mannen: <?php countGender('male') ?></li>
                    <li>Aantal vrouwen: <?php countGender('female')?></li>

    </ul>
    <p>Gebruikers met score 24:</p>
    <?php echo getScore('24'); ?>
    <p>Gebruikers met score 12:</p>
    <?php echo getScore('12'); ?>
    <p>Score per gebruiker: </p>
    <?php echo getScore(''); ?>
        <p> Aantal spelers: <b><?php echo totalPlayer();?></b></p>

    <p>Er zijn <b><?php echo ageLess21(); ?></b> spelers jonger dan 21 jaar.</p>
    <p>Er zijn <b><?php echo agePlus21(); ?></b> spelers 21 jaar of ouder.</p>
    
</body>
</html>

    
    

