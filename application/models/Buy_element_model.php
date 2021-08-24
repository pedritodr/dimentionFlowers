<?php

class Buy_element_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('buy_element', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_element($data)
    {
        $this->db->insert('element', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_box_element($data)
    {
        $this->db->insert('box_element', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('buy_element_id', $id);
        $query = $this->db->get('buy_element');

        return $query->row();
    }
    function get_buy_elements($id, $provider_id)
    {
        $this->db->select('buy_element.buy_element_id,product.product_id,product.name as product,measure.name');
        $this->db->from('buy_element');
        $this->db->join('request_product', 'request_product.request_product_id = buy_element.request_product_id');
        $this->db->join('product', 'product.product_id = request_product.product_id');
        $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
        $this->db->where('buy_element.buy_id', $id);
        $this->db->where('buy_element.provider_id', $provider_id);
        //  $this->db->group_by('product.product_id');
        $query = $this->db->get();

        return $query->result();
    }
    function get_all_by_buy_id($id)
    {
        $this->db->where('buy_id', $id);
        $this->db->select_max('awb');
        $query = $this->db->get('invoice_provider');

        return $query->result();
    }

    function get_by_id_elementos($provider_id, $buy_element_id)
    {
        $this->db->where('buy_element_id', $buy_element_id);
        $this->db->where('provider_id', $provider_id);
        $query = $this->db->get('buy_element');

        return $query->result();
    }
    function get_by_id_elementos_provider($provider_id, $request_id)
    {
        $this->db->select('*');
        $this->db->from('invoice_provider_element');
        $this->db->join('buy_element', 'buy_element.buy_element_id = invoice_provider_element.buy_element_id');
        $this->db->join('buy', 'buy.buy_id = buy_element.buy_id');
        $this->db->where('buy_element.provider_id', $provider_id);
        $this->db->where('buy.request_id', $request_id);
        $query = $this->db->get();

        return $query->result();
    }

    function get_buy_by_id($id)
    {
        $this->db->where('request_product_id', $id);
        $query = $this->db->get('buy_element');

        return $query->result();
    }
    function get_element_by_provider_id($id, $provider_id)
    {
        $this->db->select('product_category.name as category,buy_element.provider_id,request.request_id,product.product_id,measure.measure_id,buy_element.iva_active,box_type.name as caja,request_product.unit_price as precio,request_product.total_price,request.cliente_id,product_category.product_category_id,buy_element.etiqueta,buy.buy_id,buy_element.date,buy_element.qty,buy_element.buy_element_id,buy_element.price,request_product.total_steams,product.name as product,measure.name as measure,request_product.qty_bunches,request_product.carguera_id');
        $this->db->from('buy');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->join('request_product', 'request_product.request_product_id = buy_element.request_product_id');
        $this->db->join('request_product_box', 'request_product_box.request_product_id = request_product.request_product_id');
        $this->db->join('box_type', 'box_type.box_type_id = request_product_box.box_type_id');
        $this->db->join('request', 'request.request_id = request_product.request_id');
        $this->db->join('product', 'product.product_id = request_product.product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
        $this->db->where('buy.request_id', $id);
        $this->db->where('buy_element.provider_id', $provider_id);

        $query = $this->db->get();

        return $query->result();
    }

    function get_element_by_id($id)
    {
        $this->db->select('product_category.name as category,element.element_id,product.name as product,product.stems_bunch, measure.name,element.nro_bunches,element.price_cliente,element.price_finca,product.product_id,measure.measure_id');
        $this->db->from('element');
        $this->db->join('measure', 'measure.measure_id = element.measure_id');
        $this->db->join('product', 'product.product_id = element.product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->where('element.box_element_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function get_provider_by_id($id)
    {
        $this->db->select('*');
        $this->db->from('buy');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->where('buy.request_id', $id);
        $query = $this->db->get();

        return $query->result();
    }
    function get_box_element_id($id)
    {
        $this->db->select('box_element.box_element_id,box_type.name as box,box_element.buy_element_id,box_element.nro_cajas,box_type.box_type_id');
        $this->db->from('box_element');
        $this->db->join('box_type', 'box_type.box_type_id = box_element.box_type_id');
        $this->db->where('box_element.buy_element_id', $id);
        $query = $this->db->get();

        return $query->result();
    }
    function delete($id)
    {
        $this->db->where('buy_element_id', $id);
        $this->db->delete('buy_element');
        $afec = $this->db->affected_rows();


        return $afec;
    }
    function delete_element($id)
    {
        $this->db->where('element_id', $id);
        $this->db->delete('element');
        $afec = $this->db->affected_rows();


        return $afec;
    }
    function delete_box_elements($id)
    {
        $this->db->where('box_element_id', $id);
        $this->db->delete('element');
        $afec = $this->db->affected_rows();


        return $afec;
    }
    function delete_box($id)
    {
        $this->db->where('box_element_id', $id);
        $this->db->delete('box_element');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('buy_element');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('buy_element_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('buy_element');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }
    function update_element($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('element_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('element');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }
    function update_box($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('box_element_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('box_element');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }
    function get_by_id_request($id)
    {
        // $this->db->distinct();
        $this->db->select('*');
        $this->db->from('buy');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        /*$this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('request_variety', 'request_variety.request_variety_id = buy_element.request_variety_id');
        $this->db->join('variety_measure', 'variety_measure.variety_measure_id = request_variety.variety_measure_id');
        $this->db->join('dialing', 'dialing.dialing_id = request_variety.dialing_id');
        $this->db->join('destination', 'destination.destination_id = dialing.destination_id');
        $this->db->join('request_variety_box', 'request_variety_box.request_variety_id = request_variety.request_variety_id ');
        $this->db->join('box_type', 'box_type.box_type_id = request_variety_box.box_type_id');
        $this->db->join('variety', 'variety.variety_id = request_variety.variety_id');
        $this->db->join('product', 'product.product_id = variety.product_id');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');*/
        $this->db->where('buy_element.provider_id', $id);
        //$this->db->group_by('provider.provider_id');

        $query = $this->db->get();
        return $query->result();
    }
    function get_all_buys()
    {

        $this->db->select('*');
        $this->db->from('buy');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->group_by('buy_element.buy_id');



        $query = $this->db->get();
        return $query->result();
    }

    function get_element_by_request_product_id($request_product_id)
    {
        $this->db->select('buy_element.qty,buy_element.price,provider.name as provider');
        $this->db->from('buy_element');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        $this->db->where('buy_element.request_product_id', $request_product_id);

        $query = $this->db->get();

        return $query->result();
    }
    function get_element_by_request_id($id)
    {
        $this->db->select('buy_element.buy_element_id,request_product_box.qty as cajas,request_product.unit_price,cliente.cliente_id,product_category.product_category_id,buy_element.etiqueta,request.request_id,destination.name as destination,request_product.dialing_name as dialing,provider.name as provider,provider.provider_id,request.purchase_order,box_type.name as box,buy.buy_id,buy_element.date,buy_element.qty,buy_element.buy_element_id,buy_element.price,request_product.total_steams,product.name as product,measure.name as measure,request_product.total_price,request_product.qty_bunches,product.stems_bunch');
        $this->db->from('buy');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        $this->db->join('request_product', 'request_product.request_product_id = buy_element.request_product_id');
        $this->db->join('request_product_box', 'request_product_box.request_product_id = request_product.request_product_id');
        $this->db->join('box_type', 'box_type.box_type_id = request_product_box.box_type_id');
        $this->db->join('destination', 'destination.destination_id = request_product.destination_id');
        $this->db->join('product', 'product.product_id = request_product.product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
        $this->db->where('buy.request_id', $id);


        $query = $this->db->get();

        return $query->result();
    }
    function get_element_by_request_id2($id, $provider_id)
    {
        $this->db->select('request.date_time_reception,cliente.cliente_name as cliente,buy_element.buy_element_id,request_product_box.qty as cajas,request_product.unit_price,cliente.cliente_id,product_category.product_category_id,buy_element.etiqueta,request.request_id,destination.name as destination,request_product.dialing_name as dialing,provider.name as provider,provider.provider_id,request.purchase_order,box_type.name as box,buy.buy_id,buy_element.date,buy_element.qty,buy_element.buy_element_id,buy_element.price,request_product.total_steams,product.name as product,measure.name as measure,request_product.total_price,request_product.qty_bunches,product.stems_bunch');
        $this->db->from('buy');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        $this->db->join('request_product', 'request_product.request_product_id = buy_element.request_product_id');
        $this->db->join('request_product_box', 'request_product_box.request_product_id = request_product.request_product_id');
        $this->db->join('box_type', 'box_type.box_type_id = request_product_box.box_type_id');
        $this->db->join('destination', 'destination.destination_id = request_product.destination_id');
        $this->db->join('product', 'product.product_id = request_product.product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
        $this->db->where('buy.request_id', $id);
        $this->db->where('buy_element.provider_id', $provider_id);

        $query = $this->db->get();

        return $query->result();
    }
    function get_element_by_request_pro($buy, $provider)
    {
        $this->db->select('*');
        $this->db->from('buy_element');
        $this->db->where('buy_id', $buy);
        $this->db->where('provider_id', $provider);

        $query = $this->db->get();

        return $query->result();
    }

    function get_element_by_request_group($id)
    {
        $this->db->select('buy_element.buy_element_id,request_product_box.qty as cajas,request_product.unit_price,cliente.cliente_id,product_category.product_category_id,buy_element.etiqueta,request.request_id,destination.name as destination,request_product.dialing_name as dialing,provider.name as provider,provider.provider_id,request.purchase_order,box_type.name as box,buy.buy_id,buy_element.date,buy_element.qty,buy_element.buy_element_id,buy_element.price,request_product.total_steams,product.name as product,measure.name as measure,request_product.total_price,request_product.qty_bunches,product.stems_bunch');
        $this->db->from('buy');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        $this->db->join('request_product', 'request_product.request_product_id = buy_element.request_product_id');
        $this->db->join('request_product_box', 'request_product_box.request_product_id = request_product.request_product_id');
        $this->db->join('box_type', 'box_type.box_type_id = request_product_box.box_type_id');
        $this->db->join('destination', 'destination.destination_id = request_product.destination_id');
        $this->db->join('product', 'product.product_id = request_product.product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
        $this->db->where('buy.request_id', $id);
        $this->db->group_by('provider.provider_id');
        $query = $this->db->get();

        return $query->result();
    }
    function get_provider_by_buy($id)
    {
        $this->db->select('*');
        $this->db->from('buy_element');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        $this->db->where('buy_element.buy_id', $id);
        $this->db->group_by('provider.provider_id');
        $query = $this->db->get();

        return $query->result();
    }
    function get_productos_by_buy_element($id)
    {
        $this->db->select('product.product_id,product.name as product');
        $this->db->from('buy_element');
        $this->db->join('request_product', 'request_product.request_product_id = buy_element.request_product_id');
        $this->db->join('product', 'product.product_id = request_product.product_id');
        $this->db->where('buy_element.buy_element_id', $id);

        $query = $this->db->get();

        return $query->row();
    }

    function get_all_buy_elements($id)
    {

        $this->db->select('*');
        $this->db->from('buy_element');
        $this->db->where('buy_element.buy_id', $id);

        $query = $this->db->get();
        return $query->result();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}
