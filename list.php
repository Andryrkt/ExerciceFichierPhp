<?php
session_start();
require 'functions.php';
include 'header.php';
$data = __DIR__.DIRECTORY_SEPARATOR.'test.csv';
$dossier = __DIR__.DIRECTORY_SEPARATOR.'txt2';
$pdfListe = "pdf_liste.php";
$detail = "detail.php";
/*if($_SESSION["autoriser"]!="oui"){
    header('location:identification.php');
    unset($_SESSION["autoriser"]);
    exit;
}*/
?>
<div>

<!-- <button  id="btnDelete" name="delete" value="" class="btn_listes_delete">Delete All</button> -->
<a id="allDelete" href="http://localhost/ExerciceFichierPhp/list.php"><button class="btn_listes_delete" > Delet All</button></a>
    <form action=<?=$pdfListe?> style="display:inline"><button class="btn btn_pdf" type="submit" name="pdf_liste" value="ok">PDF</button></form>
</div>
<!-- <div STYLE="margin-left:auto; margin-right:auto; width:400px; position:relative; font-size:10pt; font-family:verdana; border: 2px black solid;" id="divAffichageResultat"></div><br />
	<span id="status"></span><br />	 -->
<!-- <div>
    <form action="">
        <input type="search" name="" id="">
        <button type="submit"><img src="search.svg" style="color:brown" alt="icon de recherche"/></button>
    </form>
</div> -->
<hr>

<?php
 if( isset($_GET["checkDelete_id"])){
  $tabTransition =explode( ",",$_GET["checkDelete_id"]);
    $file = fopen($data, 'a+');
    if(!$file)exit("Ouverture du fichier echouée");
    // Stocker les lignes dans un tableau
    $lines = array();
    while (($tab = fgets($file)) !== false) {
        $lines[] = $tab;
    }
    foreach ($tabTransition  as $value) {
        unset($lines[$value]);
    }
    // Réécrire le fichier CSV sans la ligne supprimée
    ftruncate($file, 0); // Vider le fichier
    foreach ($lines as $line) {
        fwrite($file, $line);
    }
    fseek($file, 0, SEEK_END);
    // Fermer le fichier
    if(!fclose($file)) exit("Fermeture du fichier echouée");
    header('location:http://localhost/ExerciceFichierPhp/list.php');
    exit;
}

//efface une ligne dans la liste
if(isset($_GET["delete_only_id"])){
    $file = fopen($data, 'a+');
    if(!$file)exit("Ouverture du fichier echouée");
    // Stocker les lignes dans un tableau
    $lines = array();
    while (($tab = fgets($file)) !== false) {
        $lines[] = $tab;
    }
   // dump($lines);
    $valeur_a_supprimer=$_GET["delete_only_id"];
    //dump($valeur_a_supprimer);
    unset($lines[$valeur_a_supprimer]);
   // dump($lines);
    // Réécrire le fichier CSV sans la ligne supprimée
    ftruncate($file, 0); // Vider le fichier
    foreach ($lines as $line) {
        fwrite($file, $line);
    }
    fseek($file, 0, SEEK_END);
    // Fermer le fichier
    if(!fclose($file)) exit("Fermeture du fichier echouée");
   Delete_url();
}

//supprime le dossier
rrmdir($dossier);
//crée le dossier
mkdir($dossier);
//Enregistrement
Enregister($data);
Petitfichier($data,$dossier);
if($files=fopen($data,"r")){
    $i=0;
    $j=$i+1;
    $isFirstLine=true;
?>
    <table>
    <?php
    while ($lines=fgetcsv($files,null,"\r")){
        //separer $data en plusieur fichier
        $nomFichier= $dossier."/base".$i.".txt";
        $i++;
        //afficher le nom et prenom 
        if($txt=fopen($nomFichier,"r")){
            $tab=fgetcsv($txt,null,";");
    ?>
            <?php if ($isFirstLine) :?>
                <thead><tr><th><form><input type="checkbox" id="checkAll" name="checkDelete"></form></th><th>id</th><th><?=$tab[0]?></th><th><?=$tab[1]?></th><th colspan="2">ACTIONS</th></thead></tr>
                    <?php $isFirstLine = false; continue; ?>
            <?php endif ?>
            <tr>
                <td><form><input type="checkbox" name="checkDelete[]" class="check" value="<?=$j?>"></form></td>
                <td><?=$j?></td>
                <td><?=$tab[0]?></td>
                <td><?=$tab[1]?></td>
                <td><form action=<?=$detail?>><button type="submit" name="id" value="<?=$j?>" class="btn_listes">Détail</button></form></td>
                <td><a class="delete" href="list.php?delete_only_id=<?=$j;?>"><button class="btn_listes_delete">X</button></a>
                  <!-- <form><button type="submit" name="delete" value="//$j" id="onlyDelete" class="" onclick="confirmSuppre">Delete</button></form> -->
                </td>
            </tr>
    <?php
        }else{
            exit("Ouverture du fichier echouée");
        }
        if(!fclose($txt))exit("fermeture du fichier echouée");
           $j++;
    }
    ?>
        </table>
    <?php
        }else{
            exit("Ouverture du fichier echouée");
        }
        if(!fclose($files))exit("Ouverture du fichier echouée");
        include 'footer.php';
    ?>


<!-- <script>
    $(function () {
  $("#checkAll").click(function () {
    console.log(this.checked);

    for (element of $(".check")) {
      element.checked = this.checked;
    }
  });
  $("#allDelete").click(function () {
    if ($("#checkAll")[0].checked) {
      var str = $(".check").serialize();
      console.log(str);
      $.ajax({
        type: "POST",
        url: "list.php",
        data: str,
        success: function (response) {
          $("#divAffichageResultat").html(response); //Affichage de l'url cible, ici AjaxTemplate02.php, dans une DIV
          $("#status").text("Posté");
          document.location.reload(true);
          //console.log(response);
        },
        error: function (response) {
          $("#status").text(
            "Erreur pour poster le formulaire : " +
              response.status +
              " " +
              response.statusText
          );
          //console.log(response);
        },
      });
    } else {
      var form = $(".check");

      var str = form.serialize();
      console.log(str);
      $.ajax({
        type: "POST",
        url: "list.php",
        data: str,
        success: function (response) {
          $("#divAffichageResultat").html(response); //Affichage de l'url cible, ici AjaxTemplate02.php, dans une DIV
          $("#status").text("Posté");
          document.location.reload(true);
          //console.log(response);
        },
        error: function (response) {
          $("#status").text(
            "Erreur pour poster le formulaire : " +
              response.status +
              " " +
              response.statusText
          );
          //console.log(response);
        },
      });
    }
  });
});
    
</script> -->
<?php
include 'footer.php';
?>