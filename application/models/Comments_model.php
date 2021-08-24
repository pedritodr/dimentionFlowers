<?php

class Comments_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('comments', $data);
        return $this->db->insert_id();
    }


    function get_by_id($id)
    {
        $this->db->where('comment_id', $id);
        $query = $this->db->get('comments');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE,$limit = null)
    {
        $this->db->order_by('date','desc');
        if($limit)
            $this->db->limit($limit) ;
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('comments');

        return ($get_as_row) ? $query->row() : $query->result();
    }

        function update($id, $data)
        {
            $this->db->where('comment_id', $id);
            foreach ($data as $key => $value) {
                $this->db->set($key, $value);
            }
            $this->db->update('comments');
            return $this->db->affected_rows();
        }

        function delete($id)
        {
            $this->db->where('comment_id', $id);
            $this->db->delete('comments');
            return $this->db->affected_rows();
        }
        function get_comments_by($evento_id,$limit = 5)
        {
           $all_comments = $this->get_all(array('state'=>1,'evento_id'=>$evento_id),null,$limit);
            $this->load->model("user_model", "user");
            foreach($all_comments as $item)
            {
                $item->user_object = $this->user->get_by_id($item->user_id);
            }
           return $all_comments;
        }
}