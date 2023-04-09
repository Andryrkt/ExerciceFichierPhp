<?php
include 'functions.php';
include 'header.php';
$lien_liste='test.php';
$adresse_entête=__DIR__.DIRECTORY_SEPARATOR.'txt2/base0.txt';
$data= __DIR__.DIRECTORY_SEPARATOR.'test.csv';
$dossier=__DIR__.DIRECTORY_SEPARATOR.'txt2';
?>
<?php
//modifier
Modifier($data);
//supprimer le dossier existant
rrmdir($dossier);
//crée le dossier
mkdir($dossier);
//crée les fichier
Petitfichier($data,$dossier);
//detail
if(isset($_GET["id"]) || isset($_GET["modifier"])){
	isset($_GET["id"])?$id=$_GET["id"]:$id=$_GET["modifier"];
	$tete=fopen($adresse_entête,"r");
	if(!$tete) die ("ouverture du fichier impossible");
	$fichier=fopen($dossier."/base".$id.".txt","r");
	if(!$fichier) die ("ouverture du fichier impossible");
	$tab1=fgetcsv($tete,null,";");
	$tab=fgetcsv($fichier,null,";");
?>
	<table>
		<tbody>
			<?php for($i=0;$i<count($tab1);$i++):?>
				<tr><th><?=$tab1[$i]?></th><td>: <?=$tab[$i]?></td></tr>
			<?php endfor;?>
		</tbody>
	</tables>
	<?php fclose($tete); fclose($fichier); ?>
  
   	<a href="<?=$lien_liste?>" class="btn btn_navigation">RETOUR</a>
	<form action="<?=$lien_liste?>" ><button class="btn btn_delete" type="submit" name="delete" value="<?=$id?>">Delete</button></form>
   	<form action="pdf.php" ><button class="btn btn_pdf" type="submit" name="pdf_detail" value="<?=$id?>">PDF</button></form>	
	   <form action="update.php" ><button class="btn btn_pdf" type="submit" name="update" value="<?=$id?>">UPDATE</button></form>	
	<hr>
<?php
}
include 'footer.php';
?>