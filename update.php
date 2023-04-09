<?php
include 'functions.php';
$adresse_entête=__DIR__.DIRECTORY_SEPARATOR.'txt2/base0.txt';
include 'header.php';
    $id =$_GET["update"];
	$tete=fopen($adresse_entête,"r");
	if(!$tete) die ("ouverture du fichier impossible");
	$fichier=fopen("txt2/base".$id.".txt","r");
	if(!$fichier) die ("ouverture du fichier impossible");
    $tab1=fgetcsv($tete,null,";");
	$tab=fgetcsv($fichier,null,";");
?>
<div class="box">
<form action="detail.php" method="get" class="formBloc">
    <h3>MODIFIER</h3>
    <div class="formGroupe">
        <label for="nom">NOM</label>
        <input type="text" id="sexe" name="nom" value="<?=$tab[0]?>" required>
    </div>
    <div class="formGroupe">
        <label for="prenoms">PRENOMS</label>
        <input type="text" id="prenoms" name="prenoms" value="<?=$tab[1]?>" required>
    </div>
    <div>
        <label for="" class="labelsexe">SEXES </label>
         <div class="sexe">
            <?php if($tab[2]=="F"){?>
                <input type="radio" id="sexe" name="sexe" value="H"  required>
                <label class="labelsexy" for="sexe">HOMME</label>
                <input type="radio" id="sexe" name="sexe" value="F" checked required>
                <label class="labelsexy" for="sexe">FEMME</label>
            <?php }else{?>
                <input type="radio" id="sexe" name="sexe" value="H" checked required>
                <label class="labelsexy" for="sexe">HOMME</label>
                <input type="radio" id="sexe" name="sexe" value="F"  required>
                <label class="labelsexy" for="sexe">FEMME</label>
            <?php }?>
        </div>
    </div>
    <div class="formGroupe">
        <label for="age">AGE</label>
        <input type="number" id="age" name="age" min="0" value="<?=(int)$tab[3]?>">
    </div>
    <div class="formGroupe">
        <label for="adresse">ADRESSE</label>
        <input type="text" id="adresse" name="adresse" value="<?=$tab[4]?>">
    </div>
    <div class="formGroupe">
        <label for="telephone">TELEPHONE</label>
        <input type="text" id="telephone" name="telephone" min="0" value="<?=$tab[5]?>">
    </div>
    <div class="formGroupe">
        <button class="btn btn_delete" type="submit" name="modifier" value="<?=$id?>">Enregister</button>
        <button type="reset" class="btn btnReset">Annuler</button>
    </div>
</form>
</div>
<?php
 fclose($tete); fclose($fichier);
 ?>

 <?php
include 'footer.php'
?>