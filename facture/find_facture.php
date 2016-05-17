<html>
	<head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style.css"/>
        <title>Application facture</title>
    </head>
	<?php include("menu_facture.php"); ?>
	<body>
		<section>

			<FORM method="post" action="find_facture2.php">
				<?php
				$reponse = $bdd->query('SELECT * FROM LIGUE');
			?>
				<SELECT name="lig">
					<?php
						while ($donnees = $reponse->fetch())
						{
					?>
						<OPTION value=<?php echo $donnees['numcompte']; ?> ><?php echo $donnees['intitule']; ?>
					<?php
						}
					?>
				</SELECT>
				<br><input type="date" name="datef">
				<br><input type="submit" value="Chercher"/>
				<INPUT TYPE="reset" NAME="nom" VALUE=" Annuler "><br>
			</section>
		</body>
</html>
