<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Email extends CI_Email {
	public function to($to){
		// 이메일 주소를 변경
		$this->ci = &get_instance();
		$_to = $this->ci->config->item('dev_receive_email');
		$to = !$_to ? $to : $_to;
		return parent::to($to);
	}
}