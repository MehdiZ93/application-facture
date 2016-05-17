<?php
// On démarre la session AVANT d'écrire du code HTML
session_start();

$content = "<html>
			<head>
		        <meta charset='utf-8' />
				<link rel='stylesheet' href='style.css'/>
		        <title>Application facture</title>
		    </head>
		    <body>";
	//include('menu_facture.php');
			try
			{
				$bdd = new PDO('mysql:host=localhost;dbname=Facture;charset=utf8', 'root', '');
			}
			catch (Exception $e)
			{
			        die('Erreur : ' . $e->getMessage());
			}
			$lig = $_POST['lig'];
			$id = uniqid("FC");
			$datem = date("Y/m/d");
			$finmois = date("Y/m/t");
			$req = 'INSERT INTO facture VALUES (:id, :datem, :finmois, :lig)';
			$ex = $bdd->prepare($req);
			$ex->bindParam('id', $id);
			$ex->bindParam('datem', $datem);
			$ex->bindParam('finmois', $finmois);
			$ex->bindParam('lig', $lig);
			$ex->execute();

			$reponse = $bdd->query("SELECT * FROM LIGUE WHERE numcompte = '$lig'");
			$donnees = $reponse->fetch();
			$content .= "CROSL <br>
						Maison Régionale des Sports de Lorraine <br>
						13 rue Jean Moulin<br>
						BP 70001<br>
						54510 TOMBLAINE<br>
						Siret 31740105700029  <br>
						Tél 03.83.18.87.02 <br>
						Fax 03.83.18.87.03 13 <br>
						<br>
						<br>
						<div id='adr' align='right'>
							".$donnees['intitule']."<br>
							A l'attention de".$donnees['nomtresorier']."<br>
							Maison Régionale des Sports de Lorraine <br>
							13 rue Jean Moulin<br>
							54510 TOMBLAINE
						</div><br><br>
						Date Facture : ".$datem."<br>
						Echéance : ".$finmois."
						<br><br><p align='center'>FACTURE ".$id." </p>
						<br><br>
						<table width='728' cellspacing='2' cellpadding='0' border='0' align='center' bgcolor='#ff6600'>
							<tr bgcolor='#ffffff'>
								<td> Référence</td>
								<td> Désignation</td>
								<td>Quantité</td>
								<td> PU HT</td>
								<td> PU TTC</td>
								<td> Total TTC </td>
							</tr>";
			$i = 0;
			$totalht = 0;
			while ($i < $_SESSION['i'])
			{
				$tmp =$_SESSION['fac'][$i][0];
				$reponse = $bdd->query("SELECT * FROM prestation WHERE code = '$tmp'");
				$prestation = $reponse->fetch();
				$content .= "<tr bgcolor='#ffffff'>
								<td>".$prestation['code']."</td>
								<td>".$prestation['libelle']."</td>
								<td>".$_SESSION['fac'][$i][1]."</td>
								<td>".$prestation['pu']."</td>
								<td>".($prestation['pu']*1.2)."</td>
								<td>".(($prestation['pu']*1.2)*$_SESSION['fac'][$i][1])."</td>
							</tr>";
				$totalht += $prestation['pu']*1.2*$_SESSION['fac'][$i][1];
				$req = 'INSERT INTO ligne_facture VALUES (:id, :prest, :qte)';
				$ex = $bdd->prepare($req);
				$ex->bindParam('id', $id);
				$ex->bindParam('prest', $_SESSION['fac'][$i][0]);
				$ex->bindParam('qte', $_SESSION['fac'][$i][1]);
				$ex->execute();
				$i++;
			}
			$content .="
						<tr>
						</tr>
						<tr bgcolor='#ffffff'>
								<td> </td>
								<td> </td>
								<td></td>
								<td></td>
								<td>Montant à payer TTC</td>
								<td>".$totalht."</td>
						</tr>
						</table>
						<br>
						<br>
						<br>
						<br>
						Déclaré à la préfecture de Meurthe et Moselle N° 3898<br>
						Domiciliation bancaire 10278 04065 000 166911045 05<br>
						Merci de bien vouloir préciser les références de la facture acquittée<br>
						TVA non applicable
						</body>
						</html>";
			 require_once( __DIR__ . "/html2pdf/html2pdf.class.php");
			    try
			    {
			        $html2pdf = new HTML2PDF("P", "A4", "fr");
			        $html2pdf->setDefaultFont("Arial");
			        $html2pdf->writeHTML($content);
			        $html2pdf->Output($id.".pdf");
			    }
			    catch(HTML2PDF_exception $e) {
			        echo $e;
			        exit;
			    }
		?>
	