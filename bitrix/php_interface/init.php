<?
AddEventHandler("main", "OnEpilog", "Redirect404");
function Redirect404() {
    if( 
     !defined('ADMIN_SECTION') &&  
     defined("ERROR_404")
   ) {
        //LocalRedirect("/404.php", "404 Not Found");
        global $APPLICATION;
        $APPLICATION->RestartBuffer();
        CHTTP::SetStatus("404 Not Found");
		include($_SERVER["DOCUMENT_ROOT"]."/404.php");
    }
}
?>