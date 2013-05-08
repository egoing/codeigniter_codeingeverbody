<?php
class Topic_model extends CI_Model {

    function __construct()
    {    	
        parent::__construct();
    }

    function gets(){
    	return $this->db->query("SELECT * FROM topic")->result();
    }

    function get($topic_id){
        $this->db->select('id');
        $this->db->select('title');
        $this->db->select('description');
        $this->db->select('UNIX_TIMESTAMP(created) AS created');
    	return $this->db->get_where('topic', array('id'=>$topic_id))->row();
    }

    function add($title, $description){
        $this->db->set('created', 'NOW()', false);
        $this->db->insert('topic',array(
            'title'=>$title,
            'description'=>$description
        ));        
        return $this->db->insert_id();
    }

    function delete($topic_id){
        return $this->db->delete('topic', array('id'=>$topic_id));
    }

}