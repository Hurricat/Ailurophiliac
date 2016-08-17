<?php

	require('autoload.php');

	ob_start();
	session_start();
	
        $siteroot = "/home/cathony/www/ailurophiliac.com";

	//setup database
        $dbfile = file_get_contents("{$siteroot}/include/php/dbinfo.json");
        $dbjson = json_decode($dbfile, true);
	define('DBHOST', 'localhost');
        define('DBUSER', $dbjson['username']);
        define('DBPASS', $dbjson['password']);
	define('DBNAME', 'cathony_blog');
	
	$db = new PDO("mysql:host=" . DBHOST . ";port=8889;dbname=" . DBNAME, DBUSER, DBPASS);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//timezone
	date_default_timezone_set('America/Chicago');

	//load needed classes
	function __autoload($class) {
		$class = strtolower($class);
		
		$classpath = 'classes/class.' . $class . '.php';
		if(file_exists($classpath)) {
			require_once $classpath;
		}
		
		$classpath = '../classes/class.' . $class . '.php';
		if(file_exists($classpath)) {
			require_once $classpath;
		}
	}
	
	//render pages
	function render($template, $values = []){
            $siteroot = "/home/cathony/www/ailurophiliac.com";
            if (file_exists("{$siteroot}/templates/{$template}")) {
                extract($values);
                require("{$siteroot}/templates/header.php");
                require("{$siteroot}/templates/{$template}");
                require("{$siteroot}/templates/footer.php");
                exit;
            } else {
                trigger_error("Invalid Template: {$siteroot}/templates/{$template}", E_USER_ERROR);
            }
        }
	
	function thank($message) {
		render('thank.php', ['title'=>'Thank You', 'message'=>$message]);
	}
	
	function httperror($errorcode = '') {
		switch($errorcode) {
		case "400":
			$errMessage = "Bad Request";
			break;
		case "401":
			$errMessage = "Authorization Required";
			break;
		case "403":
			$errMessage = "Forbidden";
			break;
		case "404":
			$errMessage = "File Not Found";
			break;
		case "500":
			$errMessage = "Internal Server Error";
			break;
		default:
			$errMessage = "There was a problem, please try again later.";
		}
		
		if($errorcode != '') {
			$errorcode.= ' ';
		}
		
		render('httperror.php', ['title'=>$errorcode . 'Error', 'message'=>$errMessage, 'errorcode'=>$errorcode]);
	}
	
	function error($message) {
		render('error.php', ['title'=>'Error', 'message'=>$message]);
	}
	
	function redirect($location) {
        if (headers_sent($file, $line))
        {
            trigger_error("HTTP headers already sent at {$file}:{$line}", E_USER_ERROR);
        }
        header("Location: {$location}");
        exit;
    }
	
	function blogURL($url) {
		$url = strtolower($url);
		$url = strip_tags($url);
		$url = stripslashes($url);
		$url = html_entity_decode($url);
		$url = str_replace('\'', '', $url);
		
		$match = '/[^a-z0-9]+/';
		$replace = '-';
		$url = preg_replace($match, $replace, $url);
		
		$url = trim($url, '-');
		
		return $url;
	}
?>
