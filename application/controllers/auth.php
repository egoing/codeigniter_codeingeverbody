<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Auth extends CI_Controller {
    function __construct()
    {       
        parent::__construct();    
    }
    function login(){
    	$this->load->config('opentutorials');
        $this->load->view('head');
        $this->load->view('login');
        $this->load->view('footer');
    }

    function logout(){
    	$this->session->sess_destroy();
    	$this->load->helper('url');
    	redirect('/');
    }

    function authentication(){
    	$authentication = $this->config->item('authentication');
    	if(
    		$this->input->post('id') == $authentication['id'] && 
    		$this->input->post('password') == $authentication['password'] 
    	) {
    		$this->session->set_userdata('is_login', true);
    		$this->load->helper('url');
    		redirect("/topic/add");
    	} else {
    		echo "불일치";
    		$this->session->set_flashdata('message', '로그인에 실패 했습니다.');
    		$this->load->helper('url');
    		redirect('/auth/login');
    	}
    }
}