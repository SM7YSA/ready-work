<?php
/* Ready2work */
/* Author www.readydigital.se */
/* License: GPLv3 */

/* THIS OUTPUTS A CLICKABLE MAP OF SWEDEN
  Based on the lib from jvectormap.com under GNU GPL
*/

session_start();
@require_once 'ams-translator.php';
$laco = filter_var($_SESSION['lang'], FILTER_SANITIZE_STRING);

$professionID = intval($_GET['professionID']);
$regionCode = filter_var($_GET['region'], FILTER_SANITIZE_STRING);

@require 'ams-GetAds.php';
$data = array('lanid' => $regionCode, 'yrkesomradeid' => $professionID, 'antalrader' => 5);

$arrWork = GetWorkList($data);

?>

<style>
g { width:100% !important; }
.jvectormap-tip { z-index:10; }
.button { cursor:pointer; border-radius:4px; padding:10px 15px; font-size:1em; margin:30px 0 80px 0; transition:all 0.2s;
color:#666;background:#ccc; }
.button:hover { background: #888; color:#fff; }
a { color:#222; text-align:right; width:100%; }
h3 { font-size:1.5em; }
body {
  background: rgb(219,243,249); /* Old browsers */
background: -moz-linear-gradient(top, rgba(219,243,249,1) 0%, rgba(229,249,244,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(219,243,249,1) 0%,rgba(229,249,244,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(219,243,249,1) 0%,rgba(229,249,244,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dbf3f9', endColorstr='#e5f9f4',GradientType=0 ); /* IE6-9 */
 }
#main-content { background-color:rgba(0,0,0,0.01)!important; }
</style>

<div style="width:100%;margin:0 auto;">
    <?php
    echo transl('<h1>Lediga jobb</h1><br/>',$laco);

    $output = "<hr><br/>";
    foreach($arrWork as $value){

      $output .= "<h3>".$value["annonsrubrik"]."</h3>";
      $output .= $value['annonstext']."...<br/>";
      $output .= "<a href=".$value['platsannonsUrl'].">&raquo; Visa jobbannons</a><br/>";
      $output .= "<hr><br/>";

    }
// var_dump($output);
    echo transl($output,$laco);
    ?>

</div>
