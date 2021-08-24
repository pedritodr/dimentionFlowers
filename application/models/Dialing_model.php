<?php
class Dialing_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('dialing', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('dialing_id', $id);
        $query = $this->db->get('dialing');
        return $query->row();
    }

    function get_subport_by_id($id)
    {
        $this->db->where('dialing_id', $id);
        $query = $this->db->get('dialing');
        return $query->result();
    }

    function get_marcacion_by_user($cliente_id)
    {
        $this->db->select('destination.name as destination,destination.destination_id,cliente.cliente_id');
        $this->db->from('cliente');
        $this->db->join('country', 'country.country_id = cliente.country_id');
        $this->db->join('destination', 'destination.country_id = country.country_id');

        $this->db->where('cliente.cliente_id', $cliente_id);

        $query = $this->db->get();
        return $query->result();
    }
    function get_marcacion_by_id($id)
    {
        $this->db->select('destination.name, dialing.name as dialing');
        $this->db->from('dialing');
        $this->db->join('destination', 'destination.destination_id = dialing.destination_id');
        $this->db->where('dialing.dialing_id', $id);



        $query = $this->db->get();
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
        $query = $this->db->get('dialing');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('dialing_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('dialing');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function delete($id)
    {
        $this->db->where('dialing_id', $id);
        $this->db->delete('dialing');
        $afec = $this->db->affected_rows();


        return $afec;
    }
    function delete_cliente($id)
    {
        $this->db->where('cliente_id', $id);
        $this->db->delete('dialing');
        $afec = $this->db->affected_rows();


        return $afec;
    }
}
