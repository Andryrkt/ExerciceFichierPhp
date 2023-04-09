<?php
function dump($variables){
	echo "<pre>";
		var_dump($variables);
	echo "</pre>";
}

function est_connecte(){
	if(session_status()===PHP_SESSION_NONE){
		session_start();
	}
	return !empty($_SESSION['connecter']);
}

function Delete_url(){
	// Récupérer l'URL courante
	$current_url = $_SERVER['REQUEST_URI'];
	// Récupérer les variables de la chaîne de requête de l'URL
	$query_string = parse_url($current_url, PHP_URL_QUERY);

	// Si la chaîne de requête contient des variables, les supprimer une par une
	if ($query_string) {
		parse_str($query_string, $query_params);
		foreach ($query_params as $key => $value) {
			unset($query_params[$key]);
		}
	// Reconstruire la chaîne de requête sans les variables
	$new_query_string = http_build_query($query_params);

	// Remplacer la chaîne de requête de l'URL avec la nouvelle chaîne de requête sans variables
	$new_url = str_replace($query_string, $new_query_string, $current_url);

	// Rediriger l'utilisateur vers la nouvelle URL sans variables
	header("Location: $new_url");
	exit;
	}
}

function Modifier($data){
	if(isset($_GET["modifier"])){
		$file = fopen($data, 'a+');
		if(!$file)exit("Ouverture du fichier echouée");
		$lines = array();
		while (($tab = fgets($file)) !== false) {
			$lines[] = $tab;
		}
		$chaine=implode(";",$_GET);
		$chaine=substr($chaine,0,-1);
		$chaine[strlen($chaine)-1]="\n";
		$lines[$_GET["modifier"]]=$chaine; 
		ftruncate($file, 0); // Vider le fichier
		foreach ($lines as $line) {
			fwrite($file, $line);
		}
		fseek($file, 0, SEEK_END);// modifier le pointer à la fin
		if(!fclose($file)) exit("Fermeture du fichier echouée");
		//Delete_url();
		
	 } 
}

function rrmdir($src) {
     if (file_exists($src)) {
         $dir = opendir($src);
         while (false !== ($file = readdir($dir))) {
             if (($file != '.') && ($file != '..')) {
                 $full = $src . '/' . $file;
                 if (is_dir($full)) {
                     rrmdir($full);
                 } else {
                     unlink($full);
                 }
             }
         }
         closedir($dir);
         rmdir($src);
     }
 }

function Enregister($data){
	if(isset($_GET["enregistrer"])){
		$nom=$_GET["nom"];
		$prenoms=$_GET["prenoms"];
		$sexe=$_GET["sexe"];
		$age=$_GET["age"];
		$adrese=$_GET["adresse"];
		$telephone=$_GET["telephone"];
		$chaine=implode(";",$_GET);
		$chaine[strlen($chaine)-1]="\n";
		if($fichier=fopen($data,"a")){
			fwrite($fichier,$chaine);
		}else{
			exit("Ouverture du fichier echouée");
		}
		if(!fclose($fichier))exit("Fermeture du fichier echouée");
		Delete_url();
	}
}

function Petitfichier($data,$dossier){
	
	if($files=fopen($data,"r")){
		$i=0;
		while ($lines=fgetcsv($files,null,"\r")){
			//separer $data en plusieur fichier
			$nomFichier= $dossier."/base".$i.".txt";
			if($fichier=fopen($nomFichier,"a+")){
				fwrite($fichier,$lines[0]);
			}else{
				exit("Ouverture du fichier echouée");
			}
			if(!fclose($fichier))exit("fermeture du fichier echouée");
			$i++;
		}
	}
}