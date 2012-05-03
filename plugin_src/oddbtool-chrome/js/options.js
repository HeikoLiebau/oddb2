﻿/*
 * Gespeicherte Einstellungen ins Formular übernehmen
 */
$(document).ready(function() {
	
	var prefs = {
		"url": "http://oddb.kryops.de/",
		"fow": true,
		"auto_poview": true,
		"auto_planet": true,
		"auto_sysun": true,
		"auto_system": true,
		"auto_orbit": true,
		"auto_floview": true,
		"auto_sitter": false,
		"auto_einst": false
	};
	
	if(localStorage['oddbtool']) {
		prefs = JSON.parse(localStorage['oddbtool']);
	}
	
	$('#url').val(prefs.url);
	
	for(var i in prefs) {
		if(i != "url" && prefs[i]) {
			$('#'+i).prop('checked', true);
		}
	}
	
	
	/*
	 * Einstellungen speichern
	 */
	$('form').submit(function(e) {
		
		var newprefs = {};
		
		newprefs['url'] = $('#url').val();
		
		// Slash an die Adresse hängen
		if(newprefs['url'].lastIndexOf('/') != newprefs['url'].length-1) {
			newprefs['url'] += '/';
		}
		
		// http ergänzen
		if(newprefs['url'].indexOf('://') == -1) {
			newprefs['url'] = 'http://'+newprefs['url'];
		}
		
		// Checkbox-Einstellungen übernehmen
		var boolprefs = [
			"fow",
			"auto_poview",
			"auto_planet",
			"auto_sysun",
			"auto_system",
			"auto_orbit",
			"auto_floview",
			"auto_sitter",
			"auto_einst"
		];
		
		var p;
		
		for(var i in boolprefs) {
			p = boolprefs[i];
			newprefs[p] = Boolean($('#'+p+':checked').length);
		}
		
		
		// speichern
		localStorage['oddbtool'] = JSON.stringify(newprefs);
		
		
		// Einstellungen schließen
		e.preventDefault();
		
		window.close();
		
		return false;
	})
});