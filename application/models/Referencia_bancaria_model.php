<?php
class Referencia_bancaria_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('referencia_bancaria', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('referencia_bancaria_id', $id);
        $query = $this->db->get('referencia_bancaria');
        return $query->row();
    }
    function get_by_referencia_id($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('referencia_bancaria');
        return $query->row();
    }
    function get_all($conditions = [], $get_as_row = FALSE, $order = false, $by = false, $cant = false, $active = false)
    {
        if ($order)
            $this->db->order_by($order, $by);
        if ($cant)
            $this->db->limit($cant);
        if ($active)
            $this->db->where('is_active', 1);
        if ($conditions)
            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }
        $query = $this->db->get('referencia_bancaria');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        // $old = $this->get_by_id($id);
        $this->db->where('user_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('referencia_bancaria');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function delete($id)
    {
        $this->db->where('referencia_bancaria_id', $id);
        $this->db->delete('referencia_bancaria');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
}
