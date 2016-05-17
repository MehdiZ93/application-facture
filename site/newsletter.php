<html>
	<head>
        <meta charset="utf-8" />
		<link rel="stylesheet" href="style.css"/>
        <title>newsletter</title>
    </head>
	<?php include("menu.php"); ?>
	<section>
			<h1 align ="center"> Newsletter </h1>
			<form id="myform" class="cssform" action="">

				<p><label for="user">Nom :</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="user" value="" /></p>

				<p><label for="user">Prénom :</label>
				&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="user" value="" /></p>
				
				<p><label for="user">Adresse :</label>
				&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="user" value="" /></p>
				
				<p><label for="user">Téléphone :</label>
				<input type="text" id="user" value="" /></p>
				
				<p><label for="emailaddress">Email :</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="text" id="emailaddress" value="" /></p>


				<p><div style="margin-left: 150px;">
					<input type="submit" value="Envoyer" />
					<input type="reset" value="Reset" />
				</div></p>
			</form>
	</section>
</html>