<?php
class Subport_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('subport', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('subport_id', $id);
        $query = $this->db->get('subport');
        return $query->row();
    }

    function get_subport_by_id($id)
    {
        $this->db->where('destination_id', $id);
        $query = $this->db->get('subport');
        return $query->result();
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
        $query = $this->db->get('subport');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('subport_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('subport');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function delete($id)
    {
        $this->db->where('subport_id', $id);
        $this->db->delete('subport');
        $afec = $this->db->affected_rows();


        return $afec;
    }
}
