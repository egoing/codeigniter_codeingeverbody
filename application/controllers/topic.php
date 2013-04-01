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
    function upload_receive_from_ck(){
        // 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
        $config['upload_path'] = './static/user';
        // git,jpg,png 파일만 업로드를 허용한다.
        $config['allowed_types'] = 'gif|jpg|png';
        // 허용되는 파일의 최대 사이즈
        $config['max_size'] = '100';
        // 이미지인 경우 허용되는 최대 폭
        $config['max_width']  = '1024';
        // 이미지인 경우 허용되는 최대 높이
        $config['max_height']  = '768';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload("upload"))
        {
            echo "<script>alert('업로드에 실패 했습니다. ".$this->upload->display_errors('','')."')</script>";
        }   
        else
        {
            $CKEditorFuncNum = $this->input->get('CKEditorFuncNum');

            $data = $this->upload->data();            
            $filename = $data['file_name'];
            
            $url = '/static/user/'.$filename;

            echo "<script type='text/javascript'>window.parent.CKEDITOR.tools.callFunction('".$CKEditorFuncNum."', '".$url."', '전송에 성공 했습니다')</script>";         
        }
    }

    function upload_receive(){
        // 사용자가 업로드 한 파일을 /static/user/ 디렉토리에 저장한다.
        $config['upload_path'] = './static/user';
        // git,jpg,png 파일만 업로드를 허용한다.
        $config['allowed_types'] = 'gif|jpg|png';
        // 허용되는 파일의 최대 사이즈
        $config['max_size'] = '100';
        // 이미지인 경우 허용되는 최대 폭
        $config['max_width']  = '1024';
        // 이미지인 경우 허용되는 최대 높이
        $config['max_height']  = '768';
        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload("user_upload_file"))
        {
            echo $this->upload->display_errors();
        }   
        else
        {
            $data = array('upload_data' => $this->upload->data());
            echo "성공";
            var_dump($data);
        }
    }
    function upload_form(){
        $this->_head();
        $this->load->view('upload_form');
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