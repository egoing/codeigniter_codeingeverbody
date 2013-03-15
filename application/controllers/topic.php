<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Topic extends CI_Controller {
	function index(){
		echo '
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8"/>
			</head>
			<body>
				토픽 페이지
			</body>
		</html>
		';
	}
	function get($id){
		echo '
		<!DOCTYPE html>
		<html>
			<head>
				<meta charset="utf-8"/>
			</head>
			<body>
				토픽 '.$id.'
			</body>
		</html>
		';
	}
}
?>