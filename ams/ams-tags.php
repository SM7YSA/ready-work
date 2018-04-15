<?php
/* Ready2work */
/* Author: www.readydigital.se */
/* License: GPLv3 */

/*
This tag cloud will be multi-layered, but the tags have been manually created on
this simple proof-of-concept. The API from AMS have three layers in their so called ontology.
Source: http://api.arbetsformedlingen.se/af/v0/platsannonser/soklista/yrkesomraden

The translation should maybe be replaced with a better gettext solution?
Also Microsoft Translator API have a function for translation arrays instead of strings
that can be looped and echoed
*/

session_start();

@require_once 'ams-translator.php';
$laco = filter_var($_SESSION['lang'], FILTER_SANITIZE_STRING);
?>

<style>
.tag { padding:7px 10px; border-radius:3px; margin:20px 8px; background:#ccc; transition:all 0.2s; line-height:2em; color:#444; }
.tag:hover { cursor:pointer; background:#999; }
#submit { cursor:pointer; border-radius:4px; padding:10px 15px; font-size:1em; margin:30px 0 80px 0; transition:all 0.2s; border:0; background:#ccc; color:#666; }
#submit:hover { background: #999; color:#fff; }
body {
  background: rgb(219,243,249); /* Old browsers */
background: -moz-linear-gradient(top, rgba(219,243,249,1) 0%, rgba(229,249,244,1) 100%); /* FF3.6-15 */
background: -webkit-linear-gradient(top, rgba(219,243,249,1) 0%,rgba(229,249,244,1) 100%); /* Chrome10-25,Safari5.1-6 */
background: linear-gradient(to bottom, rgba(219,243,249,1) 0%,rgba(229,249,244,1) 100%); /* W3C, IE10+, FF16+, Chrome26+, Opera12+, Safari7+ */
filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#dbf3f9', endColorstr='#e5f9f4',GradientType=0 ); /* IE6-9 */
 }
#main-content { background-color:rgba(0,0,0,0.01)!important; }
</style>

<script src="https://code.jquery.com/jquery-2.1.4.min.js"></script>

<script type="text/javascript" language="javascript">
$( document ).ready(function() {
  $('.tag').on('click', function(){
    $('.tag').css('background-color','#ccc');
    $(this).css('background-color','#999');
    $('#submit').data('value', $(this).data('value') );
  });

  $('#submit').on('click', function(){
    var professionID = $('#submit').data('value');
    if(professionID!=''){
      window.location.href = "http://daniel.rdytech.se/map/?professionID=" + professionID;
    }
  });

});
</script>

<div style="width:100%;margin:0 auto; background:rgba(0,0,0,0.001);">
    <h1><?php echo transl('Välj ditt kompetensområde',$laco); ?></h1><br/>

    <span data-value="1" class="tag"><?php echo transl('Administration, ekonomi, juridik',$laco); ?></span>
    <span data-value="2" class="tag"><?php echo transl('Bygg och anläggning',$laco); ?></span>
    <span data-value="20" class="tag"><?php echo transl('Chefer och verksamhetsledare',$laco); ?></span>
    <span data-value="3" class="tag"><?php echo transl('Data/IT',$laco); ?></span><br/><br/>
    <span data-value="5" class="tag"><?php echo transl('Försäljning, inköp, marknadsföring',$laco); ?></span>
    <span data-value="6" class="tag"><?php echo transl('Hantverksyrken',$laco); ?></span>
    <span data-value="7" class="tag"><?php echo transl('Hotell och restaurang',$laco); ?></span>
    <span data-value="8" class="tag"><?php echo transl('Hälsovård och sjukvård',$laco); ?></span><br/><br/>
    <span data-value="9" class="tag"><?php echo transl('Industriell tillverkning',$laco); ?></span>
    <span data-value="10" class="tag"><?php echo transl('Installation, drift, underhåll',$laco); ?></span>
    <span data-value="4" class="tag"><?php echo transl('Kropps- och skönhetsvård',$laco); ?></span>
    <span data-value="11" class="tag"><?php echo transl('Kultur, media, design',$laco); ?></span><br/><br/>
    <span data-value="13" class="tag"><?php echo transl('Naturbruk',$laco); ?></span>
    <span data-value="14" class="tag"><?php echo transl('Naturvetenskapligt arbete',$laco); ?></span>
    <span data-value="15" class="tag"><?php echo transl('Pedagogiskt arbete',$laco); ?></span>
    <span data-value="12" class="tag"><?php echo transl('Sanering och renhållning',$laco); ?></span><br/><br/>

    <button class="submit" id="submit" name="submit" data-value=""><?php echo transl('Visa lämplig ort och arbetsmöjligheter',$laco); ?> &raquo;</button>

</div>
