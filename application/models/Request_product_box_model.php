<?php

class Request_product_box_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('request_product_box', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('request_product_box_id', $id);
        $query = $this->db->get('request_product_box');

        return $query->row();
    }
    function get_by_box_id($id)
    {
        $this->db->where('request_product_id', $id);
        $query = $this->db->get('request_product_box');

        return $query->row();
    }

    function delete($id)
    {
        $this->db->where('request_product_box_id', $id);
        $this->db->delete('request_product_box');
        $afec = $this->db->affected_rows();


        return $afec;
    }
    function delete_request_product_id($id)
    {
        $this->db->where('request_product_id', $id);
        $this->db->delete('request_product_box');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('request_product_box');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('request_product_box_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('request_product_box');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }

    function update_request_product_id($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('request_product_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('request_product_box');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }

    function get_all_request_box_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('request_product_box');
        $this->db->join('box_type', 'box_type.box_type_id = request_product_box.box_type_id');

        $this->db->where('request_product_box.request_product_id', $id);


        $query = $this->db->get();
        return $query->row();
    }


    //------------------------------------------------------------------------------------------------------------------------------------------
}
