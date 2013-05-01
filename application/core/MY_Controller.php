<?php
class MY_Controller extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        if(!$this->input->is_cli_request())
            $this->load->library('session');
    }
    function _head(){
        $this->load->config('opentutorials');
        $this->load->view('head');        
    }
    function _sidebar(){
        $topics = $this->topic_model->gets();
        $this->load->view('topic_list', array('topics'=>$topics));
    }
    function _footer(){
        $this->load->view('footer');
    }
}