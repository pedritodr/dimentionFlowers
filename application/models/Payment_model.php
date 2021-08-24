<?php

class Payment_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('payment', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('payment_id', $id);
        $query = $this->db->get('payment');

        return $query->row();
    }

    function get_by_factura($id)
    {
        $this->db->where('nro_factura', $id);
        $query = $this->db->get('payment_invoice');

        return $query->result();
    }
    function get_by_factura_2($id, $request_id)
    {
        $this->db->where('nro_factura', $id);
        $this->db->where('request_id', $request_id);
        $query = $this->db->get('payment');

        return $query->result();
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {
        $this->db->where('is_active', 1);
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('payment');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('payment_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('payment');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('payment_id', $id);
        $this->db->delete('payment');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    function create_payment_invoice($data)
    {
        $this->db->insert('payment_invoice', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function get_all_payment_invoice($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('payment_invoice');

        return ($get_as_row) ? $query->row() : $query->result();
    }
    function get_by_payment_invoice($id, $request_id)
    {
        $this->db->where('nro_factura', $id);
        $this->db->where('request_id', $request_id);
        $query = $this->db->get('payment_invoice');
        return $query->row();
    }
    function create_payment_finca($data)
    {
        $this->db->insert('payment_finca', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_payment_invoice_finca($data)
    {
        $this->db->insert('payment_invoice_finca', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function get_all_payment_invoice_finca($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('payment_invoice_finca');

        return ($get_as_row) ? $query->row() : $query->result();
    }
    function get_by_payment_invoice_finca($id, $request_id)
    {
        $this->db->where('nro_factura', $id);
        $this->db->where('request_id', $request_id);
        $query = $this->db->get('payment_invoice_finca');

        return $query->row();
    }
    function get_by_payment_finca($id)
    {
        $this->db->where('payment_finca_id', $id);
        $query = $this->db->get('payment_finca');

        return $query->row();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}
