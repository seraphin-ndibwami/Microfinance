<?php
// function date_fr($format = 'l j F Y, h:m:s'){

// 	$date = date($format);

// 	$jour_en = array("Monday","Tuesday","Wednesday","Thursday","Friday","Saturday","Sunday");
// 	$jour_fr = array("Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi","Dimanche");

// 	$mois_en = array("January","February","March","April","May","June","July","August","September","October","November","December");
// 	$mois_fr = array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");

// 	$date = str_replace($jour_en, $jour_fr, $date);
// 	$date = str_replace($mois_en, $mois_fr, $date);

// 	return $date;
// }
date_default_timezone_set('Europe/Moscow');

// Récupère la date et l'heure actuelles
$currentDateTime = date("l j F Y, h:m:s");

// Affiche la date et l'heure complètes
echo "Date et heure actuelles : $currentDateTime\n";

?>