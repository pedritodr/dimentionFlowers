<?php
class Destination_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('destination', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('destination_id', $id);
        $query = $this->db->get('destination');
        return $query->row();
    }
    function get_by_id_country($id)
    {
        $this->db->where('country_id', $id);
        $query = $this->db->get('destination');
        return $query->result();
    }
    function get_all($conditions = [], $get_as_row = FALSE, $order = false, $by = false, $cant = false, $active = false)
    {
        if ($order)
            $this->db->order_by($order, $by);
        if ($cant)
            $this->db->limit($cant);

        if ($conditions)
            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }
        $query = $this->db->get('destination');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('destination_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('destination');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function delete($id)
    {
        $this->db->where('destination_id', $id);
        $this->db->delete('destination');
        $afec = $this->db->affected_rows();


        return $afec;
    }
}
