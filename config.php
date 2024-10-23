<?php

#EXAMPLE: http://priscy.test/
define('BASE_URL', 'http://php-mvc-boilerplate.dev.com/');

define('TITLE', 'Priscy');

#DATABASE
define('DB_TYPE', 'mysql');

define('DB_HOST', 'localhost');

define('DB_NAME', 'french');

define('DB_USER', 'root');

define('DB_PASS', '');

#ASSETS
define('LAYOUT', $_SERVER['DOCUMENT_ROOT'].'/views/layout/');

define('BOOTSTRAP', BASE_URL.'vendor/twbs/bootstrap/dist/');

#PHPMAILER
define('HOST', 'smtp.gmail.com');

define('SMTP_USERNAME', '');

define('SMTP_PASSWORD', '');

define('SMTP_SECURE', 'ssl');

define('PORT', 465);

# EMAIL | NAME
define('SET_FROM', array(
	'',
	''
));