<?php

class Buy_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('buy', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('buy_id', $id);
        $query = $this->db->get('buy');

        return $query->row();
    }

    function get_buy_by_request_id($id)
    {
        $this->db->where('request_id', $id);
        $query = $this->db->get('buy');

        return $query->row();
    }
    function get_by_request_id($id)
    {

        $this->db->select('*');
        $this->db->from('buy');
        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        $this->db->where('buy.request_id', $id);
        $this->db->group_by('buy_element.provider_id');
        $query = $this->db->get();

        return $query->row();
    }
    function get_by_request_id2($id)
    {

        $this->db->select('*');
        //  $this->db->from('buy');
        $this->db->from('buy_element');

        $this->db->join('buy', 'buy.buy_id=buy_element.buy_id');
        $this->db->join('request', 'request.request_id = buy.request_id');
        //   $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        $this->db->where('buy.request_id', $id);
        $this->db->group_by('buy_element.provider_id');
        $query = $this->db->get();

        return $query->result();
    }
    function get_by_request_factura($id)
    {

        $this->db->select('buy.buy_id,provider.provider_id,cliente.cliente_name,buy_element.qty,buy_element.date,buy_element.price,provider.name,request_product.total_steams,product.name as product,product_measure.measure,provider.name as provider');
        $this->db->from('buy');
        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        // $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        // $this->db->join('request_product', 'request_product.request_product_id = buy_element.request_product_id');
        //$this->db->join('product_measure', 'product_measure.product_measure_id = request_product.product_measure_id');
        //$this->db->join('product', 'product.product_id = product_measure.product_id');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        $this->db->where('buy.request_id', $id);
        $this->db->group_by('provider.provider_id');
        $query = $this->db->get();

        return $query->result();
    }
    function delete($id)
    {
        $this->db->where('buy_id', $id);
        $this->db->delete('buy');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('buy');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('buy_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('buy');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }





    //------------------------------------------------------------------------------------------------------------------------------------------
}
