Auto Social Icons
======
by Melissa Cabral



USAGE
======

Template Tag - Display in your theme code 
---------
* in any theme template (header.php, footer.php, etc), run this template tag to display the menu:

<?php  
if( function_exists('mmc_social_icons') ){
	mmc_social_icons();
} 
?>

Menu set-up in your admin panel
--------

* In your admin panel, go to appearance > menus
* create a new menu, name it. 
* use the "custom links" options to add links to your social media accounts
* check the box at the bottom next to "Auto Social Icons"
* save your menu!