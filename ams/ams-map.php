<?php
/* Ready2work */
/* Author www.readydigital.se */
/* License: GPLv3 */

/* THIS OUTPUTS A CLICKABLE MAP OF SWEDEN
Based on the JS lib from jvectormap.com under GNU GPL
*/

session_start();
@require_once 'ams-translator.php';
// $laco = $_SESSION['lang'];
$laco = filter_var($_SESSION['lang'], FILTER_SANITIZE_STRING);
$professionID = intval($_GET['professionID']);

?>

<style>
g { width:100% !important; }
.jvectormap-tip { z-index:10; }
.button { cursor:pointer; border-radius:4px; padding:10px 15px; font-size:1em; margin:30px 0 80px 0; transition:all 0.2s;
color:#666;background:#ccc; }
.button:hover { background: #888; color:#fff; }
body {
  background: rgb(219,243,249); /* Old browsers */
background: -moz-linear-gradient(top, rgba(219,243,249,1) 0%, rgba(229,249,244,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(219,243,249,1) 0%,rgba(229,249,244,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(219,243,249,1) 0%,rgba(229,249,244,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dbf3f9', endColorstr='#e5f9f4',GradientType=0 ); /* IE6-9 */
 }
#main-content { background-color:rgba(0,0,0,0.01)!important; }
svg { border:5px solid #fff; }
</style>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<link rel="stylesheet" href="http://daniel.rdytech.se/wp-content/plugins/ams/map/jquery-jvectormap-2.0.3.css" type="text/css" media="screen"/>
<script src="http://daniel.rdytech.se/wp-content/plugins/ams/map/jquery-jvectormap-2.0.3.min.js"></script>
<script src="http://daniel.rdytech.se/wp-content/plugins/ams/map/sweden.js"></script>
<script src="http://daniel.rdytech.se/wp-content/plugins/ams/gdp-data.js"></script>
<?php
  /* THIS IS THE FUNCTION THAT WILL FETCH THE ADVERTS COUNT FOR EACH LOCATION, TO CREATE A TOPLIST
   @require_once('ams-GetLan.php?terms='.$_GET['terms']);
  function GetLan();
  */
?>

<script src="vectormap.js"></script>
<script type="text/javascript" language="javascript">
$( document ).ready(function() {

 $('#map').vectorMap({
  map: 'se_merc',
  backgroundColor:'#fff',
  zoomOnScroll: false,
  regionStyle: {
  initial: {
    fill: 'white',
    "fill-opacity": 1,
    stroke: 'none',
    "stroke-width": 0,
    "stroke-opacity": 1
  },
  hover: {
    "fill-opacity": 0.8,
    cursor: 'pointer'
  },
  selected: {
    fill: 'yellow'
  },
  selectedHover: {
  }
},
  series: {
    regions: [{
      values: gdpData,
      scale: ['#C8EEFF', '#0071A4'],
      normalizeFunction: 'polynomial'
    }]
  },
  onRegionTipShow: function(e, el, code){
    el.html(el.html()); // Text on hover
  },
  onRegionClick: function (event, code) {
    window.location.href = "/ads/?professionID=" + <?php echo $professionID; ?> + "&region=" + code;
  },
  zoomButtons : false
});

});
</script>

<div style="width:100%;margin:0 auto;">
  <div style="width:50%;float:left;">
    <?php echo transl('<h2>Kronoberg vill ha Dig!</h2><br/>
    Kronobergs län (Folkmängd: 197 519) är en snabbt växande region i sydöstra Sverige, med Växjö som
    residensstad. Växjö har som Svergies andra IT-stad en stark arbetsmarknad inom IT-sektorn.
Det finns 10 skolor i regionen som erbjuder språkutbildning för nyanlända.<br/><br/>

Tätorter: Växjö, Ljungby, Älmhult, Alvesta, Markaryd<br/><br/>

    <img src="http://daniel.rdytech.se/wp-content/plugins/ams/images/vxo.jpg" style="width:100%;"><br/><br/>

    Arbetsförmedlingen Växjö<br/>
    Besöksadress: Kronobergsgatan 18<br/>
    Telefon: 0771-60 00 00<br/><br/>

    vaxjo@arbetsformedlingen.se<br/><br/>

    <a href="http://daniel.rdytech.se/ads/?region=SE-G&professionID='.$professionID.'" class="button">Visa lediga jobb &raquo;</a><br/><br/>',$laco); ?>
</div>

<div id="map" style="position:absolute;top:90px;right:10%;width:350px;height:500px;z-index:1;"></div>
</div>
