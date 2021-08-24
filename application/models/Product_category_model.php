<?php

class Product_category_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('product_category', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function create_sub($data)
    {
        $this->db->insert('sub_category', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }




    function get_by_id($id)
    {
        $this->db->where('product_category_id', $id);
        $query = $this->db->get('product_category');
        return $query->row();
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->Order_by("name", "asc");
        $query = $this->db->get('product_category');

        return ($get_as_row) ? $query->row() : $query->result();
    }
    function get_subcat_idcat($id)
        {
            $this->db->where('idcat', $id);
        $query = $this->db->get('sub_category');
        return $query->result();
    }
          
    function get_subcat_idcat2($id)
    {
        $this->db->where('idcat', $id);
        $this->db->where('is_active', "1");
        $query = $this->db->get('sub_category');
        return $query->result();
    }
    function get_subcat_idcat3($id)
        {
            $this->db->where('idsub', $id);
            $this->db->where('is_active', "1");
            $query = $this->db->get('sub_category');
            return $query->row();
        }
   
    function get_all2($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->where("is_active", "1");
        $this->db->Order_by("name", "asc");
        $query = $this->db->get('product_category');

        return ($get_as_row) ? $query->row() : $query->result();
    }
    function get_all_rand($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->where("is_active", "1");
        $this->db->where("foto IS NOT NULL");
        $this->db->where("foto !=", "");
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('product_category');

        return ($get_as_row) ? $query->row() : $query->result();
    }
    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('product_category_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('product_category');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function update_sub2($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('idsub', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $resultado = $this->db->update('sub_category');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }
    //    die(var_dump($resultado));
        return $afec;
    }

    function delete($id)
    {
        $this->db->where('product_category_id', $id);
        $this->db->delete('product_category');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }






    //------------------------------------------------------------------------------------------------------------------------------------------
}
