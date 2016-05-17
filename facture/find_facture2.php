<html>
	<head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style.css"/>
        <title>Application facture</title>
    </head>
	<?php include("menu_facture.php"); ?>
	<body>
		<section>
			<FORM method="post" action="show_facture.php">
				<?php
					$lig = $_POST['lig'];
					$datef = $_POST['datef'];
					$reponse = $bdd->query("SELECT * FROM facture WHERE compte_ligue ='$lig' AND datefac ='$datef'");
					?>
					<SELECT name="numfacture">
					<?php
						while ($donnees = $reponse->fetch())
						{
					?>
						<OPTION value=<?php echo $donnees['numfacture']; ?> ><?php echo $donnees['numfacture']; ?>
					<?php
						}
					?>
				</SELECT>
				<input type="hidden"  name="lig"  value="$lig">
				<input type="hidden"  name="datef"  value="$datef">
				<input type="submit" value="Afficher"/>
			</form>
		</section>
	</body>
</html>