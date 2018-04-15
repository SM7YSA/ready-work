<?php
/* Hack for sweden AMS app */
/* Author Daniel Karlsson www.readydigital.se */
/* License: GPLv3 */

/* THIS FUNCTION IS CALLED BY THE WP DASHBOARD TO SAVE SETTINGS */

  // error_reporting(E_ERROR | E_PARSE); Turn of warnings
  require_once($_SERVER['DOCUMENT_ROOT'].'/wp-load.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/wp-admin/includes/taxonomy.php');
  require_once($_SERVER['DOCUMENT_ROOT'].'/wp-includes/query.php');

	// Save any changes to API key
	if($_POST['key1']){
		if(get_option('ams_key1')!=$_POST['key1']){
			update_option('ams_key1', $_POST['key1']);
		}
	}
  if($_POST['key2']){
		if(get_option('ams_key2')!=$_POST['key2']){
			update_option('ams_key2', $_POST['key2']);
		}
	}
  if($_POST['user']){
		if(get_option('ams_username')!=$_POST['user']){
			update_option('ams_username', $_POST['user']);
		}
	}

  echo "Ändringar sparade";

?>
