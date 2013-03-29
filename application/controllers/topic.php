<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Topic extends CI_Controller {
    function __construct()
    {       
        parent::__construct();
        $this->load->database();
        $this->load->model('topic_model');
        log_message('debug', 'topic 초기화');
    }
    function index(){        
        $this->_head();

        $this->load->view('main');

        $this->load->view('footer');
    }
    function get($id){        
        log_message('debug', 'get 호출');
        $this->_head();

        $topic = $this->topic_model->get($id);
        if(empty($topic)){
            log_message('error', 'topic의 값이 없습니다');       
            show_error('topic의 값이 없습니다');
        }

        $this->load->helper(array('url', 'HTML', 'korean'));
        log_message('debug', 'get view 로딩');
        $this->load->view('get', array('topic'=>$topic));
        log_message('debug', 'footer view 로딩');
        $this->load->view('footer');
    }
    function add(){
        $this->_head();
        
        $this->load->library('form_validation');

        $this->form_validation->set_rules('title', '제목', 'required');
        $this->form_validation->set_rules('description', '본문', 'required');
        
        if ($this->form_validation->run() == FALSE)
        {
             $this->load->view('add');
        }
        else
        {
            $topic_id = $this->topic_model->add($this->input->post('title'), $this->input->post('description'));
            $this->load->helper('url');
            redirect('/topic/get/'.$topic_id);
        }
        
        $this->load->view('footer');
    }
    function _head(){
        $this->load->config('opentutorials');
        $this->load->view('head');
        $topics = $this->topic_model->gets();
        $this->load->view('topic_list', array('topics'=>$topics));
    }
}
?>