<?php
class Batch_model extends CI_Model {
 
    function __construct()
    {       
        parent::__construct();
    }
 
 
    function gets(){
        return $this->db->query("SELECT * FROM batch")->result();
    }
 
    function add($option)
    {
        $this->db->set('job_name', $option['job_name']);
        $this->db->set('context', $option['context']);
        $this->db->insert('batch');
        $result = $this->db->insert_id();
        return $result;
    }
 
    function delete($option){
        return $this->db->delete('batch', array('id'=>$option['id']));   
    }
}