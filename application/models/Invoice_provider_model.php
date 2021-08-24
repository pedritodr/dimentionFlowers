<?php

class Invoice_provider_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('invoice_provider', $data);
        return $this->db->insert_id();
    }


    function get_by_id($provider_id, $buy_id)
    {

        $this->db->select('*');
        $this->db->from('invoice_provider');
        $this->db->join('buy', 'buy.buy_id = invoice_provider.buy_id');
        $this->db->join('provider', 'provider.provider_id = invoice_provider.provider_id');

        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->where('invoice_provider.provider_id', $provider_id);
        $this->db->where('invoice_provider.buy_id', $buy_id);
        $query = $this->db->get();

        return $query->result();
    }
    function get_by_factura($id, $nro)
    {
        $this->db->where('invoice_provider_id', $id);
        $this->db->where('nro_invoice', $nro);
        $query = $this->db->get('invoice_provider');

        return $query->row();
    }
    function get_by_id2($provider_id, $buy_id)
    {

        $this->db->select('*');
        $this->db->from('invoice_provider');
        $this->db->where('invoice_provider.provider_id', $provider_id);
        $this->db->where('invoice_provider.buy_id', $buy_id);
        $query = $this->db->get();

        return $query->row();
    }
    function get_facturas_by_provider($provider_id)
    {
        $this->db->select('*');
        $this->db->from('invoice_provider');
        $this->db->where('invoice_provider.provider_id', $provider_id);
        $query = $this->db->get();

        return $query->result();
    }
    function get_facturas_by_provider_2($provider_id, $request_id)
    {
        $this->db->select('*');
        $this->db->from('invoice_provider');
        $this->db->join('buy', 'buy.buy_id = invoice_provider.buy_id');
        $this->db->where('invoice_provider.provider_id', $provider_id);
        $this->db->where('buy.request_id', $request_id);
        $query = $this->db->get();

        return $query->result();
    }

    function get_invoice_by_id($provider_id, $buy_id)
    {
        $this->db->select('invoice_provider.referendum,invoice_provider.date_invoice_carguera,invoice_provider.nro_invoice,provider.name as provider,request.purchase_order,request.request_id,invoice_provider.cod_carguera,invoice_provider.awb,invoice_provider.hawb,invoice_provider.airline');
        $this->db->from('invoice_provider');
        $this->db->join('buy', 'buy.buy_id = invoice_provider.buy_id');
        $this->db->join('provider', 'provider.provider_id = invoice_provider.provider_id');
        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->where('invoice_provider.provider_id', $provider_id);
        $this->db->where('invoice_provider.buy_id', $buy_id);

        $query = $this->db->get();
        return $query->row();
    }
    function get_invoice_by_id2($provider_id, $buy_id)
    {
        $this->db->select('*');
        $this->db->from('invoice_provider');
        $this->db->join('buy', 'buy.buy_id = invoice_provider.buy_id');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->where('invoice_provider.provider_id', $provider_id);
        $this->db->where('invoice_provider.buy_id', $buy_id);

        $query = $this->db->get();
        return $query->row();
    }
    function get_all_invoice($provider_id, $buy_id)
    {

        $this->db->select('invoice_provider.nro_invoice,provider.name as provider,request.purchase_order,request_product.total_steams,measure.name as measure,product.name as product,buy_element.qty,buy_element.price');
        $this->db->from('invoice_provider');
        $this->db->join('buy', 'buy.buy_id = invoice_provider.buy_id');
        $this->db->join('provider', 'provider.provider_id = invoice_provider.provider_id');
        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->join('request_product', 'request_product.request_product_id = buy_element.request_product_id');
        $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
        $this->db->join('product', 'product.product_id = request_product.product_id');


        $this->db->where('invoice_provider.provider_id', $provider_id);
        $this->db->where('invoice_provider.buy_id', $buy_id);
        $query = $this->db->get();

        return $query->result();
    }
    function get_all($conditions = [], $get_as_row = FALSE, $limit = null)
    {

        if ($limit)
            $this->db->limit($limit);
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->where("nro_invoice != '' ");
        $this->db->where("total", 0);
        //    $this->db->or_where('nro_invoice !=', NULL);
        $query = $this->db->get('invoice_provider');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {

        $this->db->where('invoice_provider_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('invoice_provider');
        return $this->db->affected_rows();
    }

    function delete($id)
    {
        $this->db->where('invoice_provider_id', $id);
        $this->db->delete('invoice_provider');
        return $this->db->affected_rows();
    }
}
