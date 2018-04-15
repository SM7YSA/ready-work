<?php
/* Hack for sweden AMS app */
/* Author Daniel Karlsson www.readydigital.se */
/* License: GPLv3 */

/* THIS IS THE SETTINGS PAGE IN WORDPRESS */
?>

<div class="wrap">
<h2>Ready 2 Work Settings</h2><br>
<HR size=1 color="#efefef"><br>


<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>
<script type="text/javascript" language="javascript">

$(document).ready(function() {
     $("#submit").click(function() { ams_save_settings(); });
});

function ams_save_settings()
{

     $('#response-wrapper').show();
     $('#response').html('Sparar');

     var error = "";

     	var dataString = 'user=' + document.getElementById('username').value + '&key1=' + document.getElementById('apikey1').value + '&key2=' + document.getElementById('apikey2').value;
     	$.ajax({
            type: 'POST',
            url: '/wp-content/plugins/ams/ams-savesettings.php',
           data: dataString
        })
        .done(function(data){
            if( data!=0 ){
            	$('#loader').hide();
              $('#response').html(data);
            } else {
            	$('#loader').hide();
              $('#response').html('Tekniskt fel');
            }
        })
        .fail(function() {
            // just in case posting your form failed
            $('#response').html('ERROR! Kunde inte ansluta.');
        });

}
</script>

<DIV>

  <?php
  @require_once 'ams-translator.php';
  if( function_exists('transl') ){
    $translated = transl('Jag är en liten boll', 'es');
    echo $translated;
  } else {
    echo "no such function";
  }
  ?><br><br>

  <b>API URL:</b>
<INPUT type="text" name="url" id="url" value="<?php echo get_option('ams_api_url'); ?>" style="width:300px;"><br><br>

  <b>Username:</b>
<INPUT type="text" name="username" id="username" value="<?php echo get_option('ams_username'); ?>" style="width:400px;"><br><br>

<b>API Key 1:</b>
<INPUT type="text" name="apikey1" id="apikey1" value="<?php echo get_option('ams_key1'); ?>" style="width:400px;"><br><br>

<b>API Key 2:</b>
  <INPUT type="text" name="apikey2" id="apikey2" value="<?php echo get_option('ams_key2'); ?>" style="width:400px;"><br><br>


<DIV id="response-wrapper" style="display:none;margin:20px 0 0;"><DIV id="loader" style="float:left;margin-right:5px;"><IMG src="/wp-content/plugins/ams/images/loader.gif"></DIV> <DIV id="response" style="float:left;"></DIV></DIV><br><br>

<INPUT type="button" name="submit" id="submit" value=" Spara ändringar ">

</div>
