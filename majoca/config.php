<?php

define( "DMODE", isset( $_COOKIE['sprytne'] ) );
define( "URL", __DIR__ );
define( "URI", sprintf(
	'http://%s%s',
	$_SERVER[ 'SERVER_NAME' ],
	pathinfo( $_SERVER[ 'SCRIPT_NAME' ], PATHINFO_DIRNAME  )
	
) );
