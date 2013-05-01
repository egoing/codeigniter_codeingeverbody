<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Batch extends MY_Controller {
    function __construct(){
        parent::__construct();
    }
    function process(){
        $this->load->model('batch_model');
        $queue = $this->batch_model->gets();
        foreach($queue as $job){
            switch($job->job_name){
                case 'notify_email_add_topic':
                    $context = json_decode($job->context);
                    $this->load->model('topic_model');
                    $topic = $this->topic_model->get($context->topic_id);
                    $this->load->model('user_model');
                    $users = $this->user_model->gets();     
                    $this->load->library('email');
                    $this->email->initialize(array('mailtype'=>'html'));
                    foreach($users as $user){
                        $this->email->from('master@ooo2.org', 'master');
                        $this->email->to($user->email);
                        $this->email->subject($topic->title);
                        $this->email->message($topic->description);
                        $this->email->send();
                        echo "{$user->email}로 메일 전송을 성공 했습니다.\n";
                    }
                    $this->batch_model->delete(array('id'=>$job->id));
                    break;
            }
        }
 
    }
}