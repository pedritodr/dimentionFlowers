<?php

class Pending_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('pending', $data);
        return $this->db->insert_id();
    }


    function get_by_id($id)
    {
        $this->db->where('pending_id', $id);
        $query = $this->db->get('pending');

        return $query->row();
    }
    function get_by_id_po($id, $provider)
    {
        $this->db->where('request_id', $id);
        $this->db->where('provider_id', $provider);
        $query = $this->db->get('pending');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE, $limit = null)
    {

        if ($limit)
            $this->db->limit($limit);
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('pending');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $this->db->where('pending_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('pending');
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('pending_id', $id);
        $this->db->delete('pending');
        return $this->db->affected_rows();
    }

    function get_all_pending_by_request_id($request_id, $provider_id)
    {
        // $this->db->distinct('provider');
        $this->db->select('pending.pending_id,pending.qty,pending.reason,pending.price,measure.name as measure, product.name as product,motivo.motivo');
        $this->db->from('pending');
        $this->db->join('request', 'request.request_id = pending.request_id');
        $this->db->join('provider', 'provider.provider_id = pending.provider_id');
        $this->db->join('product', 'product.product_id = pending.product_id');
        $this->db->join('measure', 'measure.measure_id = pending.measure_id');
        $this->db->join('motivo', 'motivo.motivo_id = pending.motivo_id', 'left');
        $this->db->where('pending.request_id', $request_id);
        $this->db->where('pending.provider_id', $provider_id);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_pending_by_group()
    {
        $this->db->select('request.purchase_order,provider.name as provider,provider.provider_id,request.request_id');
        $this->db->from('pending');
        $this->db->join('request', 'request.request_id = pending.request_id');
        $this->db->join('provider', 'provider.provider_id = pending.provider_id');
        $this->db->group_by('pending.provider_id');

        $query = $this->db->get();
        return $query->result();
    }
    function get_all_pending_by_id($id)
    {
        // $this->db->distinct('provider');
        $this->db->select('request.purchase_order,pending.pending_id,pending.qty,pending.reason,pending.price,provider.name as provider,measure.name as measure, product.name as product');
        $this->db->from('pending');
        $this->db->join('request', 'request.request_id = pending.request_id');
        $this->db->join('provider', 'provider.provider_id = pending.provider_id');
        $this->db->join('product', 'product.product_id = pending.product_id');
        $this->db->join('measure', 'measure.measure_id = pending.measure_id');

        $query = $this->db->get();
        return $query->result();
    }
}
