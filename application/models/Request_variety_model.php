<?php

class Request_variety_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('request_variety', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('request_variety_id', $id);
        $query = $this->db->get('request_variety');

        return $query->row();
    }
    function get_by_id_request($id)
    {

        $this->db->select('provider.name,product.name as label, variety.name as variety,buy_element.qty as qty_buy,box_type.name as box_type,request_variety.total_steams,variety_measure.measure, dialing.name as dialing, destination.name as destination,request.purchase_order');
        $this->db->from('buy');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('request_variety', 'request_variety.request_variety_id = buy_element.request_variety_id');
        $this->db->join('variety_measure', 'variety_measure.variety_measure_id = request_variety.variety_measure_id');
        $this->db->join('dialing', 'dialing.dialing_id = request_variety.dialing_id');
        $this->db->join('destination', 'destination.destination_id = dialing.destination_id');
        $this->db->join('request_variety_box', 'request_variety_box.request_variety_id = request_variety.request_variety_id ');
        $this->db->join('box_type', 'box_type.box_type_id = request_variety_box.box_type_id');
        $this->db->join('variety', 'variety.variety_id = request_variety.variety_id');
        $this->db->join('product', 'product.product_id = variety.product_id');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        $this->db->where('buy.request_id', $id);


        $query = $this->db->get();
        return $query->result();
    }

    function delete($id)
    {
        $this->db->where('request_variety_id', $id);
        $this->db->delete('request_variety');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('request_variety');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('request_variety_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('request_variety');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }




    //------------------------------------------------------------------------------------------------------------------------------------------
}
