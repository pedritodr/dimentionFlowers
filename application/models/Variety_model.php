<?php

class Variety_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('variety', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_variety_mesure($data)
    {

        $this->db->insert('variety_measure', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('variety_id', $id);
        $query = $this->db->get('variety');

        return $query->row();
    }

    function delete($id)
    {
        $this->db->where('variety_id', $id);
        $this->db->delete('variety');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('variety');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('variety_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('variety');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }

    function get_by_variety_id($id)
    {
        $this->db->where('product_id', $id);
        $query = $this->db->get('variety');
        return $query->result();
    }
    function get_by_variety_id2($id)
    {
        $this->db->where('product_id', $id);
        $query = $this->db->get('variety');
        return $query->row();
    }
    function get_by_measure_id($id)
    {
        $this->db->where('variety_id', $id);
        $query = $this->db->get('variety_measure');
        return $query->result();
    }
    function get_by_measure($id)
    {
        $this->db->where('variety_measure_id', $id);
        $query = $this->db->get('variety_measure');
        return $query->row();
    }
    function get_variety_by_product($id)
    {
        $this->db->select('variety.variety_id,variety.name,variety.photo,product.product_id,variety.description,variety.status');
        $this->db->from('product');
        $this->db->join('variety', 'variety.product_id =product.product_id');
        $this->db->where('variety.product_id', $id);

        $query = $this->db->get();
        return $query->result();
    }
    function get_all_variety_by_product($id)
    {
        $this->db->select('variety.variety_id,variety.name,variety.photo,product.product_id,variety.description,variety.status');
        $this->db->from('product');
        $this->db->join('variety', 'variety.product_id =product.product_id');
        $this->db->where('variety.product_id', $id);


        $query = $this->db->get();
        return $query->result();
    }
    function get_all_product_by_variety($id)
    {
        $this->db->select('product.name');
        $this->db->from('variety');
        $this->db->join('product', 'product.product_id =variety.product_id');
        $this->db->where('variety.variety_id', $id);


        $query = $this->db->get();
        return $query->row();
    }
    function delete_by_product($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('variety');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function delete_variety_measue($id)
    {
        $this->db->where('variety_id', $id);
        $this->db->delete('variety_measure');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}
