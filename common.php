<?php

/**
 * common.php
 * Versionierung
 * globale DB-Daten (Seiten, Status-Levels, Rechte-Namen)
 * OD-Daten (Gebäude, Schiffe, Rassen)
 * Einbinden von wichtigen Klassen und Funktionen (Template, Contentswitch, Routen, Cache, Entfernung)
 * Klassen: User, MySQL
 * globale Funktionen: User, Sicherheit, Planeten
 */

// Sicherheitsabfrage
if(!defined('ODDB')) die('unerlaubter Zugriff!');

//
// Versionierung
//

// Hauptversion
define('VERSION', '2.1.6');
// Datei-Zusatz (css und js)
define('FILESTAMP', '?8');
// OD-Runde
define('ODWORLD', 'int9');
define('DOWNTIME', false);
// ODDB Tool-Version
define('ODDBTOOL', '1.1.5c');
define('ODDBTOOLPATH', 'oddbtool-1_1_5c.xpi');
define('ODDBTOOLPATH_CHROME', 'oddbtool-chrome-1_1_5c.crx');

// Debug-Modus
define('DEBUG', false);

//
// Umgebungsdaten
//

// Vorhandene Seiten (PHP-Dateien in pages/) als Key
$pages = array(
	// Seiten
	'oview'=>true,
	'scan'=>true,
	'search'=>true,
	'scout'=>true,
	'toxx'=>true,
	'strecken'=>true,
	'route'=>true,
	'karte'=>true,
	'gates'=>true,
	'inva'=>true,
	'ress'=>true,
	'werft'=>true,
	'player'=>true,
	'allianzen'=>true,
	'stats'=>true,
	'settings'=>true,
	'admin'=>true,
	'tools'=>true,
	'show_system'=>true,
	'show_planet'=>true,
	'show_player'=>true,
	'show_ally'=>true,
	'rechte'=>true,
	// reines AJAX
	'ajax_general'=>true,
	// extern
	'fow'=>true
);

// Status-Levels
$status = array(
	0=>'neutral',
	1=>'Meta',
	2=>'NAP',
	3=>'Krieg',
	4=>'Piraten',
	5=>'In Ruhe lassen',
	6=>'Antitoxxpakt'
);
$status_color = array(
	0=>'',
	1=>'style="color:#00aa00"',
	2=>'style="color:#3355ff"',
	3=>'style="color:#ff3322"',
	4=>'style="color:yellow"',
	5=>'style="color:#88ff88"',
	6=>'style="color:#758b4f"'
);
$status_meta = 1;
$status_hak = 2;
$status_krieg = 3;
$status_freund = array(1,2);
$status_feind = array(3,4);

// Rechte-Namen
$rechtenamen = array(
	// Einscannen
	'scan'=>'Quelltext einscannen',
	'scan_del'=>'Durch Scans Planeten und Systeme löschen',
	// Planetenanzeige
	'show_planet'=>'Planeten anzeigen',
	'show_planet_ally'=>'Allianz-Planeten anzeigen',
	'show_planet_meta'=>'Meta-Planeten anzeigen',
	'show_planet_register'=>'Planeten anderer angemeldeter Allianzen anzeigen',
	
	// Systemanzeige
	'show_system'=>'Systeme anzeigen',
	'show_system_ally'=>'Allianz-Systeme anzeigen',
	'show_system_meta'=>'Meta-Systeme anzeigen',
	'show_system_register'=>'Systeme anderer angemeldeter Allianzen anzeigen',
	
	// Spieleranzeige
	'show_player'=>'Spieler anzeigen',
	'show_player_db_ally'=>'DB-Daten von Spielern anzeigen (Ally)',
	'show_player_db_meta'=>'DB-Daten von Spielern anzeigen (Meta)',
	'show_player_db_other'=>'DB-Daten von Spielern anzeigen (andere Allianzen)',
	
	'show_ally'=>'Allianzen anzeigen',
	'show_meta'=>'Metas anzeigen',
	
	// Sichtbarkeit und editierbarkeit der Einteilung eines Planeten
	'ressplani_ally'=>'Ressplaneten der Allianz anzeigen',
	'ressplani_meta'=>'Ressplaneten der Meta anzeigen',
	'ressplani_register'=>'Ressplaneten anderer angemeldeter Allianzen anzeigen',
	'ressplani_feind'=>'kürzlich gescannte feindliche Ressvorkommen anzeigen',
	
	'bunker_ally'=>'Bunker der Allianz anzeigen',
	'bunker_meta'=>'Bunker der Meta anzeigen',
	'bunker_register'=>'Bunker anderer angemeldeter Allianzen anzeigen',
	
	'werft_ally'=>'Werften der Allianz anzeigen',
	'werft_meta'=>'Werften der Meta anzeigen',
	'werft_register'=>'Werften anderer angemeldeter Allianzen anzeigen',
	
	'flags_edit_ally'=>'Ressplanet, Bunker und Werft bei Ally-Planeten ändern',
	'flags_edit_meta'=>'Ressplanet, Bunker und Werft bei Meta-Planeten ändern',
	'flags_edit_register'=>'Ressplanet, Bunker und Werft bei Planeten angemeldeter Allianzen ändern',
	'flags_edit_other'=>'Ressplanet, Bunker und Werft bei Planeten fremder Allianzen ändern',
	
	// Myrigates und Risse
	'show_myrigates'=>'Myrigates anzeigen',
	'show_myrigates_ally'=>'Myrigates der Allianz anzeigen',
	'show_myrigates_meta'=>'Myrigates der Meta anzeigen',
	'show_myrigates_register'=>'Myrigates anderer angemeldeter Allianzen anzeigen',
	
	// FoW
	'fow'=>'FoW-Ausgleich benutzen',
	
	// Suche
	'search'=>'Suchfunktion benutzen',
	'search_ally'=>'nach Allianzplaneten suchen',
	'search_meta'=>'nach Metaplaneten suchen',
	'search_register'=>'nach Planeten anderer registrierter Allianzen suchen',
	
	// Strecken
	'strecken_flug'=>'Entfernungs- und Flugberechnung',
	'strecken_weg'=>'schnellster Weg-Funktion',
	'strecken_saveroute'=>'Saverouten-Generator',
	'strecken_ueberflug'=>'System-Überflug',
	
	'toxxraid'=>'Toxx- und Raidfunktion',
	
	// Routen
	'routen'=>'Routen und Listen',
	'routen_ally'=>'Routen der Allianz sehen',
	'routen_meta'=>'Routen der Meta sehen',
	'routen_other'=>'Routen anderer angemeldeter Allianzen sehen',
	
	'karte'=>'Karte benutzen',
		
	'gates'=>'Gateliste einsehen',
	
	// Invasionen
	'invasionen'=>'Invasionen, Resonationen, Genesis-Projekte und Besatzungen sehen',
	'fremdinvakolos'=>'Kolonisationen, Bergbau, Terraformer und Fremd-Invasionen sehen (Opfer nicht in der DB angemeldet)',
	'invasionen_admin'=>'Invasionen auf freundlich setzen',
	'masseninva'=>'Masseninva-Koordinator benutzen',
	'masseninva_admin'=>'Masseninva-Koordinator verwalten',
	
	// Spieler
	'userlist'=>'Die Liste angemeldeter Spieler anzeigen',
	'allywechsel'=>'Die Liste kürzlicher Allianzwechsel anzeigen',
	'inaktivensuche'=>'Die Inaktivensuche benutzen',
	
	// Statistiken
	'stats_scan'=>'Scan-Statistik anzeigen',
	'stats_highscore'=>'Scan-Highscore anzeigen',
	
	// Verwaltung
	'verwaltung_userally'=>'User der eigenen Allianz verwalten',
	'verwaltung_user_register'=>'alle Spieler sowie Registrierungserlaubnis für Spieler und Allianzen verwalten',
	'verwaltung_user_custom'=>'Userberechtigungen einzeln ändern',
	'verwaltung_allianzen'=>'Status von Allianzen ändern',
	'verwaltung_galaxien'=>'Galaxien einparsen',
	'verwaltung_galaxien2'=>'Galaxien verschmelzen und löschen',
	'verwaltung_rechte'=>'Rechtelevel bearbeiten',
	'verwaltung_logfile'=>'Logfile ansehen',
	'verwaltung_settings'=>'Grundeinstellungen der DB ändern',
	'verwaltung_backup'=>'Backups der DB speichern oder einspielen',
	
	// Allianz-Sperren überschreiben
	'override_allies'=>'Allianz-Sichtbarkeitssperren aufgehoben',
	'override_galas'=>'Galaxie-Sichtbarkeitssperren aufgehoben'
);


// Rassen-Namen
$rassen = array(
	1=>'Menschen',
	2=>'Ti-Roc',
	3=>'Tradoner',
	4=>'Beralut',
	5=>'Myrianer',
	10=>'Se´ze Lux'
);

// Rassen-CSS-Klassen
$rassen2 = array(
	1=>'mensch',
	2=>'tiroc',
	3=>'trado',
	4=>'bera',
	5=>'myri',
	10=>'lux'
);

// Gebaeude-Pfade
$gebaeude = array(
	0=>'leer.gif',
	-1=>'bau.gif',
	-2=>'pod.gif',
	-3=>'weltraumpod.gif',
	-4=>'unbekannt.png',
	1000=>'basiscamp.gif',
	1001=>'forschungscamp.gif',
	1002=>'fabrik.gif',
	1003=>'erz.gif',
	1004=>'werft.gif',
	1005=>'erzschmelze01.gif',
	1006=>'erzschmelze02.gif',
	1007=>'kristal.gif',
	1008=>'wolfram_01.gif',
	1009=>'fabrik2.gif',
	1010=>'fabrik3.gif',
	1011=>'forschungslabs.gif',
	1012=>'scanschutz.gif',
	1013=>'abwehrsattelit.gif',
	1014=>'kristall2.gif',
	1015=>'forschungslabs-III.gif',
	1016=>'erzmine-II.gif',
	1017=>'erzmine-III.gif',
	1018=>'wolfram-II.gif',
	1019=>'wolfram-III.gif',
	1020=>'abwehrstation-II.gif',
	1021=>'scanschutz-II.gif',
	1022=>'fabrikII-1.gif',
	1023=>'fabrikII-2.gif',
	1024=>'orbitalkanone.gif',
	1025=>'schmelze3.gif',
	1026=>'handelsstation.gif',
	1027=>'orbitfabrik.gif',
	1028=>'orbitfabrik2_ph.gif',
	1029=>'laserorbitter.gif',
	1030=>'scanschutz-III.gif',
	1031=>'kristall3.gif',
	1032=>'orbitforschung.gif',
	1033=>'mainhall.gif',
	1034=>'myrianer-orbitforschung_v2.gif',
	1035=>'beraluten-industrie-forschu.gif',
	1036=>'menschen-wohn-orbit.gif',
	1037=>'fabrikIII-1_update.gif',
	1038=>'forschungslabs-IIIm3.gif',
	1039=>'dock.gif',
	1040=>'verteidigungsorbitter.gif',
	1041=>'oneway_geb.gif',
	1042=>'bio-gas-raff.gif',
	1043=>'bio-gas-raff_mkii.gif',
	1044=>'bio-gas-raff_mkiii.gif',
	1045=>'menschen-wohn-orbit_v2.gif',
	1046=>'basiskamp-II.gif',
	1047=>'raumstation.gif',
	1048=>'minenfeld.gif',
	1049=>'mirc.gif',
	1050=>'sternbasis.gif',
	1051=>'beraluten-industrie-fors_v2.gif',
	1052=>'grossraumwerft.gif',
	1053=>'industriezentrum.gif',
	1054=>'fabrikIII-1.gif',
	1055=>'ratshalle_mod.gif',
	1056=>'arcbro3.gif'/*,
	1057=>'bio-gas-raff_mkii.gif',
	1058=>'erzmine-II.gif',
	1059=>'erzschmelze02.gif',
	1060=>'kristall2.gif',
	1061=>'wolfram-II.gif',
	1062=>'erzmine-II.gif',
	1063=>'erzschmelze02.gif',
	1064=>'wolfram-II.gif',
	1065=>'kristall2.gif',
	1066=>'bio-gas-raff_mkii.gif',
	1067=>'erzmine-II.gif',
	1068=>'erzschmelze02.gif',
	1069=>'wolfram-II.gif',
	1070=>'erzschmelze02.gif',
	1071=>'bio-gas-raff_mkii.gif',
	1072=>'erzmine-II.gif',
	1073=>'kristall2.gif',
	1074=>'bio-gas-raff_mkii.gif'*/
);

// Gebaeude-Positionen auf dem Sprite (Pixel nach rechts)
$gebaeudepos = array(
	0=>0,
	-1=>16,
	-2=>32,
	-3=>48,
	-4=>64,
	1000=>80,
	1001=>96,
	1002=>112,
	1003=>128,
	1004=>144,
	1005=>160,
	1006=>176,
	1007=>192,
	1008=>208,
	1009=>224,
	1010=>240,
	1011=>256,
	1012=>272,
	1013=>288,
	1014=>304,
	1015=>320,
	1016=>336,
	1017=>352,
	1018=>368,
	1019=>384,
	1020=>400,
	1021=>416,
	1022=>432,
	1023=>448,
	1024=>464,
	1025=>480,
	1026=>496,
	1027=>512,
	1028=>528,
	1029=>544,
	1030=>560,
	1031=>576,
	1032=>592,
	1033=>608,
	1034=>624,
	1035=>640,
	1036=>656,
	1037=>672,
	1038=>688,
	1039=>704,
	1040=>720,
	1041=>736,
	1042=>752,
	1043=>768,
	1044=>784,
	1045=>800,
	1046=>816,
	1047=>832,
	1048=>848,
	1049=>864,
	1050=>880,
	1051=>944,
	1052=>896,
	1053=>912,
	1054=>928,
	1055=>976,
	1056=>960 /*,
	1057=>768,
	1058=>336,
	1059=>176,
	1060=>304,
	1061=>368,
	1062=>336,
	1063=>176,
	1064=>368,
	1065=>304,
	1066=>768,
	1067=>336,
	1068=>176,
	1069=>368,
	1070=>176,
	1071=>768,
	1072=>336,
	1073=>304,
	1074=>768*/
);

// Orbiter (Gebäude-ID=>Stufe)
$orbiter = array(
	1013=>1,
	1024=>1,
	1012=>1,
	1021=>1,
	1039=>1,
	1020=>2,
	1029=>2,
	1030=>2,
	1048=>3,
	1040=>3,
	1041=>3,
	1050=>3
);


//
// Klassen und Funktionen
//


/**
 * MySQL-Klasse
 * genutzt für lazy connecting
 */
class mysql {
	// ist die MySQL-Verbindung aufgebaut?
	public $connected;
	
	/**
	 * MySQL-Verbindung aufbauen
	 */
	public function connect() {
		global $config;
		
		// Verbindung
		@mysql_connect(
			$config['mysql_host'],
			$config['mysql_user'],
			$config['mysql_pw']
		) OR die('Konnte keine Verbindung mit der MySQL-Datenbank herstellen! Fehlermeldung: '.mysql_error());
		@mysql_select_db($config['mysql_db']) OR die('Konnte MySQL-Datenbank nicht benutzen! Fehlermeldung: '.mysql_error());
		
		// MySQL auf UTF-8 stellen
		if(function_exists('mysql_set_charset')) {
			mysql_set_charset('utf8');
		}
		else {
			mysql_query("
				SET NAMES 'UTF8'
			") OR die("Fehler in ".__FILE__." Zeile ".__LINE__.": ".mysql_error());
		}
	}
}

/**
 * MySQL-Query absetzen und vorher ggf MySQL-Verbindung aufbauen
 * @param $sql string Query
 *
 * @return mysql_query()
 */
function query($sql) {
	global $mysql_conn, $queries;
	
	// wenn MySQL-Verbindung noch nicht steht, aufbauen
	if(!$mysql_conn->connected) {
		$mysql_conn->connect();
	}
	
	//debug-Ausgabe
	//echo $sql."<br /><br />";
	if(DEBUG) {
		global $mysql_stack;
		if($mysql_stack === NULL) {
			$mysql_stack = array();
		}
		$mysql_stack[] = str_replace(array('-->', '---', '--'), array('-- >', '- - -', '- -'), $sql);
	}
	
	// Zähler erhöhen
	$queries++;
	
	// Query abschicken
	return mysql_query($sql);
}

/**
 * MySQL-Query-Variable escapen, vorher ggf MySQL-Verbindung aufbauen
 * @param $var string
 *
 * @return mysql_real_escape_string()
 */
function escape($var) {
	global $mysql_conn;
	
	// wenn MySQL-Verbindung noch nicht steht, aufbauen
	if(!$mysql_conn->connected) {
		$mysql_conn->connect();
	}
	
	// escapen
	return mysql_real_escape_string($var);
}


//
// globale Klasse und Funktionen einbinden
//


// User-Klasse
include (ODDBADMIN ? '.' : '').'./common/user.php';

// Cache-Klasse
include (ODDBADMIN ? '.' : '').'./common/cache.php';


if(!ODDBADMIN) {
	// Template-Klasse
	include './common/template.php';
	// Routen-Klasse
	include './common/route.php';
	// Entfernungs- und Flugfunktionen
	include './common/entf.php';
}



//
// generelle Funktionen
//

/**
 * htmlspecialchars-Shortcut
 * @param $a string
 */
function h($a) {
	return htmlspecialchars($a, ENT_COMPAT, 'UTF-8');
}
 
/**
 * überprüft, ob eine Zeiteingabe valid ist
 * @param $stunde int
 * @param $minute int
 * @param $sekunde int
 *
 * @return bool valid oder invalid
 */
function checktime($stunde, $minute, $sekunde) {
	// Stunde
	if($stunde < 0 OR $stunde > 23) return false;
	// Minute
	if($minute < 0 OR $minute > 59) return false;
	// Sekunde
	if($sekunde < 0 OR $sekunde > 59) return false;
	// Zeit valid
	return true;
}

/**
 * formatiert ein Datum um
 * @param $t int Timestamp
 * @param $von bool (default false) von/vom als Präfix einfügen
 *
 * @return string formatiertes Datum
 */
function datum($t, $von=false) {
	global $datum_heute;
	global $datum_gestern;
	global $datum_morgen;
	global $datum_umorgen;
	
	if(!$datum_heute) $datum_heute = strtotime('today');
	if(!$datum_morgen) $datum_morgen = strtotime('tomorrow');
	if(!$datum_gestern) $datum_gestern = strtotime('yesterday');
	if(!$datum_umorgen) $datum_umorgen = strtotime('today+2days');
	
	$p = $von ? 'von ' : '';
	
	// heute
	if($t > $datum_heute AND $t < $datum_morgen) return $p.'heute, '.strftime('%H:%M', $t);
	// gestern
	if($t < $datum_heute AND $t > $datum_gestern) return $p.'gestern, '.strftime('%H:%M', $t);
	// morgen
	if($t > $datum_morgen AND $t < $datum_umorgen) return $p.'morgen, '.strftime('%H:%M', $t);
	// ansonsten Datum anzeigen
	if($von) $p = 'vom ';
	return $p.strftime('%d.%m.%y %H:%M', $t);
}

/**
 * Rohstoffmengen umformatieren
 * @param $z int Zahl
 *
 * @return formatierte Zahl
 */
function ressmenge($z) {
	return number_format($z, 0, ',', '.');
}

/**
 * Rohstoffmengen als Kurzform umformatieren
 * @param $z int Zahl
 * @param $ceil bool aufrunden
 *
 * @return formatierte Zahl
 */
function ressmenge2($z, $ceil=false) {
	// 123M
	if($z > 10000000) {
		return ($ceil ? ceil($z/1000000) : floor($z/1000000)).'M';
	}
	// 1.5M
	if($z > 1000000) {
		return (($ceil ? ceil($z/100000) : floor($z/100000))/10).'M';
	}
	// 123k
	if($z > 1000) {
		return ($ceil ? ceil($z/1000) : floor($z/1000)).'k';
	}
	// 123
	return $z;
}

/**
 * gibt die Galaxie in der Farbe des Sektors aus
 * @param $gala int Galaxie
 * @param $sektor int Sektor (r,g,b,y)
 *
 * @return HTML farbige Galaxie
 */
function sektor($gala, $sektor) {
	// invalide Galaxie übergeben
	if(!is_numeric($gala)) return '-';
	
	if($sektor == 1) $col = 'ff0000';
	else if($sektor == 2) $col = '00ff00';
	else if($sektor == 3) $col = '0044ff';
	else $col = 'ffff00';
	
	return '<span style="color:#'.$col.'">'.$gala.'</span>';
}

/**
 * aus den X- und Z-Koordinaten Sektorfarbe ermitteln
 * @param $x int X-Koordinate
 * @param $z int Z-Koordinate
 *
 * @return string HexCode der Farbe
 */
function sektor_coord($x, $z) {
	if($x >= 0 AND $z >= 0) return '#ff0000';
	else if($x < 0 AND $z > 0) return '#00ff00';
	else if($x < 0 AND $z < 0) return '#0044ff';
	else return '#ffff00';
}

/**
 * Aus dem Datum eines Scans die Farb-Klasse ermitteln
 * @param $t timestamp
 * @param $days int maximales Alter in Tagen
 *
 * @return string green/red CSS-Klasse
 */
function scan_color($t, $days) {
	if(!$t OR $t < time()-86400*$days) return 'red';
	else return 'green';
}

/**
 * wandelt einen Wert in eine =- oder IN()-Bedingung für MySQL um
 * @param $v int/string (int,int,int...) eingegebener Wert
 * @param $string bool (default false) Überprüfung auf String und Abbruch
 *
 * @return string MySQL-Bedingung
 */
function db_multiple($v, $string=false) {
	// Überprüfung auf String
	if($string) {
		$test = preg_replace('/[\d, ]/', '', $v);
		// bei String abbrechen
		if($test != '') return false;
	}
	
	// ein Wert
	if(strpos($v, ',') === false) {
		$v = (int)$v;
		return ' = '.$v;
	}
	// mehrere Werte
	else {
		$v = explode(',', $v);
		foreach($v as $key=>$val) {
			$val = (int)$val;
			if($val >= 0) $v[$key] = $val;
			else unset($v[$key]);
		}
		if(count($v)) {
			return ' IN ('.implode(',', $v).')';
		}
		else return ' = 0';
	}
}

/**
 * gibt eine "no auth"-Meldung für den FoW aus
 */
function diefow($msg = 'Du bist nicht eingeloggt!') {
	// normales FoW-Output oder spezielles ODDB-Output
	$oddb = isset($_GET['oddb']);

	// daraus resultierender Zeichensatz
	$charset = $oddb ? 'UTF-8' : 'ISO-8859-1';
	
	header('Content-Type:text/xml; charset='.$charset);
	
	die('<?xml version="1.0" encoding="'.$charset.'" standalone="yes" ?>
<odh:odhelper xmlns="http://unzureichende.info/odhelp/ns/fog.of.war/2007" xmlns:odh="http://unzureichende.info/odhelp/ns/api">
  <odh:head>
    <odh:auth>false</odh:auth>
    <odh:status>200</odh:status>
    <odh:version>1.0</odh:version>
  </odh:head>
  <odh:data>

	<system sid="'.(isset($_GET['id']) ? (int)$_GET['id'] : '0').'">
	  <comment />
	  
	  <systemInfo>
		'.(isset($_GET['oddb']) ? '<div align="center" style="color:#ff3322">'.$msg.'</div>' : '<tr>
	  <td>'.$msg.'</td>
	</tr>').'
	  </systemInfo>
	</system>
 </odh:data>
</odh:odhelper>');
}


/**
 * Anzahl der offenen Invasionen ermitteln
 */
function getopeninvas() {
	global $user, $cache;
	
	// keine Berechtigung
	if(!$user->rechte['invasionen']) {
		return 0;
	}
	
	$invas = 0;
	
	// keine Invasionen
	if($cache->get('invas') === 0) {
		return 0;
	}
	// gesperrte Allianzen und Galaxien filtern
	else if(($user->protectedAllies OR $user->protectedGalas) AND $cache->get('openinvas') !== 0) {
		$tables = '';
		$cond = '';
		
		// gesperrte Allianzen
		if($user->protectedAllies) {
			$tables = "
				LEFT JOIN ".GLOBPREFIX."player p1
					ON p1.playerID = invasionen_playerID
				LEFT JOIN ".GLOBPREFIX."player p2
					ON p2.playerID = invasionenAggressor";
			$cond = "
				AND p1.player_allianzenID NOT IN(".implode(', ', $user->protectedAllies).")
				AND p2.player_allianzenID NOT IN(".implode(', ', $user->protectedAllies).")";
		}
		
		// gesperrte Galaxien
		if($user->protectedGalas) {
			$tables .= "
				LEFT JOIN ".PREFIX."systeme
					ON systemeID = invasionen_systemeID";
			$cond .= "
				AND systeme_galaxienID NOT IN(".implode(', ', $user->protectedGalas).")";
		}
		
		$query = query("
			SELECT
				COUNT(*)
			FROM
				".PREFIX."invasionen
				".$tables."
			WHERE
				invasionenOpen = 1
				AND invasionenTyp < 5
				AND (invasionenEnde = 0 OR invasionenEnde > ".time().")
				".$cond."
		") OR die("Fehler in ".__FILE__." Zeile ".__LINE__.": ".mysql_error());
		
		$invas = mysql_fetch_array($query);
		$invas = $invas[0];
	}
	// keine Allianzen und Galaxien gesperrt
	// nicht im Cache -> MySQL benutzen
	else if(($invas = $cache->get('openinvas')) === false) {
	
		$invas = 0;
		
		$query = query("
			SELECT
				COUNT(*)
			FROM
				".PREFIX."invasionen
			WHERE
				invasionenOpen = 1
				AND invasionenTyp < 5
				AND (invasionenEnde = 0 OR invasionenEnde > ".time().")
		") OR die("Fehler in ".__FILE__." Zeile ".__LINE__.": ".mysql_error());
		
		$invas = mysql_fetch_array($query);
		$invas = $invas[0];
		
		// in den Cache laden (1 Minute)
		$cache->set('openinvas', $invas, 60);
	}
	
	// Anzahl zurückgeben
	return $invas;
}

/**
 * Farbe der Gesinnung generieren (Hex)
 * @param gesinnung int Gesinnungs-Zahl
 * @return string(6) Hex-Farbe
 */
function gesinnung($gesinnung) {
	if($gesinnung < 1000) {
		$ges = round(0.255*(1000-$gesinnung)*1.25);
		if($ges < 0) $ges = 0;
		if($ges > 255) $ges = 255;
		$grot = dechex($ges);
	}
	else $grot = '00';
	
	$diff = (abs($gesinnung-1000)+1000)/1000;
	if($diff > 1) $diff = 1/$diff;
	
	$ges = round(200*$diff);
	if($ges < 0) $ges = 0;
	if($ges > 255) $ges = 255;
	$ggruen = dechex($ges);
	
	if($gesinnung > 1000) {
		$ges = round(0.2*($gesinnung-1000));
		if($ges < 0) $ges = 0;
		if($ges > 175) $ges = 175;
		$gblau = dechex($ges);
		
	}
	else $gblau = '00';
	
	if(strlen($grot) == 1) $grot = '0'.$grot;
	if(strlen($ggruen) == 1) $ggruen = '0'.$ggruen;
	if(strlen($gblau) == 1) $gblau = '0'.$gblau;
	
	// Farbe als Hex-Wert zurückgeben
	return $grot.$ggruen.$gblau;
}

/**
 * Logeintrag generieren
 * @param $typ int Eintrag-Typ
 * @param $msg string Eintrag-Text
 */
function insertlog($typ, $msg) {
	global $user;
	
	/*
	=== höchste besetzte ID: 27
	
	Log-Typen: ID Name Stufe
	
	-- general
	1 Registrierung (2)
	2 Login (2)
	3 Passwort vergessen (2)
	
	4 Einscannen (2)
	
	5 Anzeige (3)
	
	15 FoW-Ausgleich (2)
	
	-- Suche
	16 benutzt die Suchfunktion (2)
	
	-- Strecken
	6 Entfernungs- und Flugberechnung (2)
	7 schnellster Weg (2)
	8 Saveroute (2)
	9 System-Überflug (2)
	
	-- Scouten
	10 Scan reservieren (2)
	17 Scout-Funktionen benutzen (2)
	
	-- Raiden und Toxxen
	11 Planet raiden oder toxxen (2)
	
	-- Routen
	26 Routen
	
	-- Invasionen
	27 Invasionen
	
	-- Ressplaneten und Werften
	12 Flags eines Planeten / aller eigener ändern (2)
	
	-- Planeten
	13 Kommentar editieren (2)
	
	-- Spieler
	22 Spieler-Funktionen benutzen (2)
	
	-- Allianzen
	23 Allianz-Status ändern (1)
	
	-- Einstellungen
	18 Einstellungen ändern (2)
	19 Passwort ändern (2)
	20 FoW-Einstellungen ändern (2)
	
	-- Verwaltung
	14 Galaxieverwaltung (1)
	21 Userverwaltung (1)
	24 Registrierungsverwaltung (1)
	25 Einstellungen (1)
	
	*/
	
	// Daten sichern
	$typ = (int)$typ;
	
	// IPv6 abfangen
	$ip = $_SERVER['REMOTE_ADDR'];
	if(strpos($ip, ':') !== false) {
		$ip = '0.0.0.0';
	}
	
	// eintragen
	query("
		INSERT INTO ".PREFIX."log
		SET
			logTime = ".time().",
			log_playerID = ".$user->id.",
			logType = ".$typ.",
			logText = '".escape($msg)."',
			logIP = INET_ATON('".$ip."')
	") OR die("Fehler in ".__FILE__." Zeile ".__LINE__.": ".mysql_error());
}



//
// Planeten-Funktionen
//

/**
 * Gebäude-String in HTML-Array umwandeln
 * @param $string string die Gebäude mit + getrennt
 * @param $groesse int/false Planetengröße, bei false Orbit
 * @param $thumb bool Thumbnail-Ansicht
 *
 * @return array HTML mit Gebäude-Bildern / Positionen (Thumbnail)
 */

function gebaeude($string, $groesse, $thumb) {
	global $gebaeude, $gebaeudepos;
	
	$arr = array();
	
	// nicht gescannt
	if($string == '') {
		for($i=1;$i<=36;$i++) {
			// im Orbit bei 12 abbrechen
			if($groesse === false AND $i > 12) break;
			// nur so viele Gebäude anzeigen wie Planet groß ist
			else if($groesse !== false AND $i > $groesse) {
				$arr[$i] = '';
			}
			// den Rest mit Unbekannt füllen
			else $arr[$i] = '<img src="img/gebaeude/unbekannt.png" alt="" />';
		}
	}
	// gescannt
	else {
		// String exploden
		$string = explode('+', $string);
		
		for($i=1;$i<=36;$i++) {
			// im Orbit bei 12 abbrechen
			if(!$groesse AND $i > 12) break;
			// nur so viele Gebäude anzeigen wie Planet groß ist
			else if($groesse AND $i > $groesse) {
				// Thumbnail
				if($thumb) $arr[$i] = 0;
				// große Ansicht
				else $arr[$i] = '';
			}
			// Gebäude ermitteln
			else {
				// Thumbnail
				if($thumb) {
					if(isset($string[$i-1]) AND isset($gebaeudepos[$string[$i-1]])) {
						$arr[$i] = $gebaeudepos[$string[$i-1]];
					}
					// unbekanntes Gebäude
					else {
						$arr[$i] = 64;
					}
				}
				// große Anzeige
				else {
					if(isset($string[$i-1]) AND isset($gebaeude[$string[$i-1]])) {
						$arr[$i] = '<img src="img/gebaeude/'.$gebaeude[$string[$i-1]].'" alt="" />';
					}
					// unbekanntes Gebäude
					else {
						$arr[$i] = '<img src="img/gebaeude/unbekannt.png" alt="" />';
					}
				}
			}
		}
	}
	
	// Array zurückgeben
	return $arr;
}

/**
 * Icon-Pfad einer Kategorie zurückgeben
 * @param $cat int ID der Kategorie
 *
 * @return string Icon (HTML)
 */
function catimg($cat) {
	$imgs = array(
		0=>'<img src="img/layout/leer.gif" alt="" class="katimg katnone" title="nicht kategorisiert">',
		1=>'<img src="img/layout/leer.gif" alt="" class="katimg katerz" title="Erz">',
		2=>'<img src="img/layout/leer.gif" alt="" class="katimg katmetall" title="Metall">',
		3=>'<img src="img/layout/leer.gif" alt="" class="katimg katwolfram" title="Wolfram">',
		4=>'<img src="img/layout/leer.gif" alt="" class="katimg katkristall" title="Kristall">',
		5=>'<img src="img/layout/leer.gif" alt="" class="katimg katfluor" title="Fluor">',
		6=>'<img src="img/layout/leer.gif" alt="" class="katimg katf1" title="Forschungseinrichtungen">',
		7=>'<img src="img/layout/leer.gif" alt="" class="katimg katf2" title="UNI-Labore">',
		8=>'<img src="img/layout/leer.gif" alt="" class="katimg katf3" title="Forschungszentren">',
		9=>'<img src="img/layout/leer.gif" alt="" class="katimg katf4" title="Myri-Forschung">',
		10=>'<img src="img/layout/leer.gif" alt="" class="katimg katof1" title="orbitale Forschung">',
		11=>'<img src="img/layout/leer.gif" alt="" class="katimg katof2" title="Gedankenkonzentratoren">',
		12=>'<img src="img/layout/leer.gif" alt="" class="katimg katums" title="Umsatzfabriken">',
		13=>'<img src="img/layout/leer.gif" alt="" class="katimg katwerft" title="Werft">'
	);
	if(isset($imgs[$cat])) return $imgs[$cat];
	return $imgs[0];
}

/**
 * berechnnet den Zeitpunkt, zu dem ein getoxxter Planet wieder voll ist
 */
function getoxxt($bev, $bevakt) {
	// Bevölkerung voll
	if($bev == $bevakt) {
		return time();
	}
	// nicht voll -> OD-Formel + 3 Stunden Aktualisierungs-Puffer
	$t = (time()+(86400*(log($bev/$bevakt)/0.42)))+10800;
	
	// höchstens 8 Tage
	if($t > time()+691200) {
		return time()+691200;
	}
	
	return $t;
}

/**
 * berechnet die Imperiumspunkte eines Planeten
 * @param $data array Planten-Datensatz
 */
function imppunkte($data) {
	// höchsten Resswert ermitteln
	$maxress = $data['planetenRWErz'];
	if($data['planetenRWWolfram'] > $maxress) {
		$maxress = $data['planetenRWWolfram'];
	}
	if($data['planetenRWKristall'] > $maxress) {
		$maxress = $data['planetenRWKristall'];
	}
	if($data['planetenRWFluor'] > $maxress) {
		$maxress = $data['planetenRWFluor'];
	}
	
	return floor(($data['planetenBevoelkerung']/100000) * $data['planetenGroesse'] + $maxress + ($data['planetenRWFluor']*3));
}

/**
 * MySQL-Befehl zum Ermitteln der Imperiumspunkte eines Planeten
 */
function imppunkte_mysql() {
	return 'FLOOR(
			(planetenBevoelkerung/100000) * planetenGroesse
			+ GREATEST(planetenRWErz, planetenRWWolfram, planetenRWKristall, planetenRWFluor)
			+ planetenRWFluor*3
		)';
}

/**
 * in einem System vorhandene Allianzen aktualisieren
 * @param $id int System-ID
 * @param $return bool nicht in MySQL aktualisieren, sondern nur zurückgeben (default false)
 * @return string Allianz-IDs (+id++id+) / '' bei Fehler
 */
function sysallianzen($id, $return=false) {
	// Daten sichern
	$id = (int)$id;
	
	$allies = '';
	
	// wurde das System schon gescannt?
	$query = query("
		SELECT
			systemeUpdate
		FROM ".PREFIX."systeme
		WHERE
			systemeID = ".$id."
	") OR die("Fehler in ".__FILE__." Zeile ".__LINE__.": ".mysql_error());
	
	// System existiert nicht
	if(!mysql_num_rows($query)) return '';
	
	// System noch nicht gescannt
	$data = mysql_fetch_assoc($query);
	if(!$data['systemeUpdate']) return '';
	
	// Allianzen abfragen
	$query = query("
		SELECT DISTINCT
			planeten_playerID,
			player_allianzenID
		FROM
			".PREFIX."planeten
			LEFT JOIN ".GLOBPREFIX."player
				ON planeten_playerID = playerID
		WHERE
			planeten_systemeID = ".$id."
		ORDER BY planetenID ASC
	") OR die("Fehler in ".__FILE__." Zeile ".__LINE__.": ".mysql_error());
	
	$frei = false;
	$unbekannt = false;
	
	while($row = mysql_fetch_assoc($query)) {
		// Allianzen hinzufügen
		if($row['player_allianzenID'] != null) {
			$allies .= '+'.$row['player_allianzenID'].'+';
		}
		// frei
		else if($row['planeten_playerID'] == 0 AND !$frei) {
			$frei = true;
		}
		// unbekannt
		else if($row['planeten_playerID'] < 0 AND !$unbekannt) {
			$unbekannt = true;
		}
	}
	
	//  freie und unbekannte ans Ende
	if($frei) {
		$allies .= '+-1+';
	}
	if($unbekannt) {
		$allies .= '+-2+';
	}
	
	// in MySQL aktualisieren
	if(!$return) {
		query("
			UPDATE ".PREFIX."systeme
			SET
				systemeAllianzen = '".$allies."'
			WHERE
				systemeID = ".$id."
		") OR die("Fehler in ".__FILE__." Zeile ".__LINE__.": ".mysql_error());
	}
	
	// Allianzen zurückgeben
	return $allies;
}



?>