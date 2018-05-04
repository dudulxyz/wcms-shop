<?php
/**
 * Shop plugin
 * @author  Dudul <http://dudul.xyz> pre-fork: version 0.0.1
 * @version 2.4 for WonderCMS
 */

	session_start();
	$_SESSION['productList'] = json_decode(file_get_contents("plugins/shop/data.js"), true);
						
if(defined('VERSION'))
	define('version', VERSION);
	defined('version') OR die('Direct access is not allowed.');

	 wCMS::addListener('js', 'loadshopJS');
	 wCMS::addListener('css', 'loadshopCSS');
	 wCMS::addListener('menu', 'displayAdmin');
	 wCMS::addListener('footer', 'displayAdmin');
	 

function loadshopJS($args) {
	$script = <<<'EOT'

<script src="plugins/shop/js/jquery.smartCart.min.js"></script>
    <!-- Initialize -->
    <script type="text/javascript">
        $(document).ready(function(){
            // Initialize Smart Cart    	
            $('#smartcart').smartCart({
                                submitSettings: {
                                    submitType: 'paypal' // form, paypal, ajax
                                },
                                toolbarSettings: {
                                    checkoutButtonStyle: 'paypal' // default, paypal, image
                                }
                            });
		});
    </script>
EOT;
	if(version<'2.0.0')
		array_push($args[0], $script);
	else
		$args[0].=$script;
	return $args;
}

function loadshopCSS($args) {
	$script = <<<'EOT'
<link rel="stylesheet" href="plugins/shop/css/smart_cart.min.css" type="text/css" media="screen" charset="utf-8">
EOT;
	if(version<'2.0.0')
		array_push($args[0], $script);
	else
		$args[0].=$script;
	return $args;
}


if(isset($_SESSION['errors'])) {
	foreach($_SESSION['errors'] as $error) {
		echo "<p class='error'>" . $error .  "</p>";
	}
	unset($_SESSION['errors']);
}

if(isset($_SESSION['success_message'])) {
	echo "<p class='success'>" . $_SESSION['success_message'] . "</p>";;
	unset($_SESSION['success_message']);
}

function displayAdmin ($args) {
	if ( ! wCMS::$loggedIn) return $args;
		echo '<a href="plugins/shop/admin.php"><span class="glyphicon glyphicon-cog"></span> Edit Product</a>';
	return $args;
}