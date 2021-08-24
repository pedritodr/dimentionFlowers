<?php

class Invoice_box_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('invoice_box', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('invoice_box_id', $id);
        $query = $this->db->get('invoice_box');

        return $query->row();
    }
    function get_box_element_by_id($id)
    {
        $this->db->where('box_element_id', $id);
        $query = $this->db->get('invoice_box');

        return $query->row();
    }
    function delete($id)
    {
        $this->db->where('invoice_box_id', $id);
        $this->db->delete('invoice_box');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('invoice_box');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('invoice_box_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('invoice_box');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }




    //------------------------------------------------------------------------------------------------------------------------------------------
}
