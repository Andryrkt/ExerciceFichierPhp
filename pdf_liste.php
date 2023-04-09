<?php
require 'functions.php';
require __DIR__.'/vendor/autoload.php';

use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Html2Pdf;

$data=__DIR__.DIRECTORY_SEPARATOR.'test.csv';

if (isset($_GET["pdf_liste"])){
$isFirstLine=true;
$j=1;
ob_start();
?>
<style type="text/css">
    
    .tableau {
        border-collapse: collapse;
        width: 100%;
        /* border: 2px solid midnightblue; */
        /* box-shadow:0 5px 50px rgba(0,0,0, .15); */ 
    }

    thead tr {
        background-color: #4aa3a2;
        color: #fff;
    }

    th, td {
        padding: 5px 10px;
    }

    tbody tr, td, th {
        border: 1px solid #ddd;
    }
</style>
<page backtop="20mm" backbottom="20mm" backleft="10mm" backright="20mm">
    <page_header>
        <h1>LISTES DES PERSONNES ENREGISTRER</h1>
    </page_header>
    <table class="tableau">
        <?php if($txt=fopen($data,"r")){
            while($tab=fgetcsv($txt)){
                 $tab=explode(";",$tab[0]);
                // dump($tab); die;
        ?>
                <?php if ($isFirstLine):?>
                    <thead>
                        <tr><th>id</th><th><?= $tab[0]; ?></th><th><?= $tab[1]; ?></th></tr>
                    </thead>
                        <?php $isFirstLine = false; continue; ?>
                enregistrementde
                <?php endif ?>
                <tbody>
                    <tr><td><?= $j?></td><td><?= $tab[0]; ?></td><td><?= $tab[1]; ?></td></tr>
                </tbody>
                <?php $j++; ?>
        <?php
            }
        }
        ?>   
    </table>
</page>
<?php
try {
    $html2pdf = new Html2Pdf('P','A4','fr',false, 'UTF-8', array(20, 20, 20,20));
    $content=ob_get_clean();
    $html2pdf->writeHTML($content);
    $html2pdf->output('test.pdf');
}catch (Html2PdfException $e){
    die($e);
}
}
?>