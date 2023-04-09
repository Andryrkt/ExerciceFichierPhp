<?php
require 'functions.php';
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Html2Pdf;

//pdf pour les details
if(isset($_GET["pdf_detail"])){
$html2pdf = new Html2Pdf('P','A4','fr');
$id=$_GET["pdf_detail"];
$tete=fopen("txt2/base0.txt","r");
$fichier=fopen("txt2/base".$id.".txt","r");
$tab1=fgetcsv($tete,null,";");
$tab=fgetcsv($fichier,null,";");
 for($i=0;$i<count($tab1);$i++){
 
    $tableau[]="<table><tr><th>$tab1[$i]</th><td>: $tab[$i]</td></tr></table>";
 }
 $chaine=implode("",$tableau);
 $html="<page backtop=\"20mm\" backbottom=\"20mm\" backleft=\"20mm\" backright=\"20mm\">
 $chaine;
 </page>";
 $html2pdf->writeHTML($html);
$html2pdf->output();

fclose($tete);
fclose($fichier);
}
