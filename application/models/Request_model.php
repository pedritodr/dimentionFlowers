<?php

class Request_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('request', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function create_invoice($data)
    {

        $this->db->insert('invoice', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('request_id', $id);
        $query = $this->db->get('request');

        return $query->row();
    }
    function get_po_by_cliente($id)
    {
        $this->db->where('cliente_id', $id);
        $this->db->where('state', 2);
        $query = $this->db->get('request');

        return $query->result();
    }
    function get_by_invoice_id($id)
    {
        $this->db->where('invoice_id', $id);
        $query = $this->db->get('invoice');

        return $query->row();
    }
    function get_by_invoice_request_id($id)
    {
        $this->db->where('request_id', $id);
        $query = $this->db->get('invoice');

        return $query->row();
    }
    function get_by_invoice_nro($id)
    {
        $this->db->where('request_id', $id);
        $query = $this->db->get('invoice');

        return $query->result();
    }
    function delete($id)
    {
        $this->db->where('request_id', $id);
        $this->db->delete('request');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('request');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function get_all_invoice($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('invoice');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('request_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('request');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }
    function update_invoice($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('request_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('invoice');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }

    function get_all_request()
    {
        $this->db->select('*');
        $this->db->from('request');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        $this->db->where('state >=', 0);
        $query = $this->db->get();
        return $query->result();
    }

    function get_invoice_by_request($id)
    {
        $this->db->select('*');
        $this->db->from('invoice');
        $this->db->where('request_id', $id);

        $query = $this->db->get();
        return $query->row();
    }

    function get_all_request_by_id($id)
    {

        $this->db->select('product.product_category_id,request_product.measure_id,request_product.qty_bunches,request_product.carguera_id,request_product.destination_id,product.stems_bunch,cliente.cliente_id,request.request_id,request.purchase_order,request.date_time_reception,request.date_purchase,cliente.cliente_name,cliente.address,country.name as country,measure.name as measure,request_product.request_product_id,request_product.total_steams,request_product.unit_price,request_product.total_price,product.product_id,product.name,product.photo,request_product.dialing_name as dialing,destination.name as destination');
        $this->db->from('request');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        $this->db->join('country', 'country.country_id = cliente.country_id');
        $this->db->join('request_product', 'request_product.request_id = request.request_id');
        $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
        $this->db->join('product', 'product.product_id = request_product.product_id');
        $this->db->join('destination', 'destination.destination_id = request_product.destination_id');

        $this->db->where('request.request_id', $id);


        $query = $this->db->get();
        return $query->result();
    }
    function get_all_request_variety_by_id($id)
    {
        $this->db->select('product.product_category_id,destination.destination_id,destination.name as destination,request_product.dialing_name as dialing,request_product.request_product_id,request_product.total_steams,request_product.measure_id,request_product.unit_price,request_product.total_price,request_product.status,product.product_id,product.name,product.photo,measure.name as measure,measure.measure_id');
        $this->db->from('request_product');
        $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
        $this->db->join('product', 'product.product_id=request_product.product_id');
        $this->db->join('destination', 'destination.destination_id=request_product.destination_id');
        $this->db->where('request_product.request_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    function get_request_by_date($date)
    {

        $this->db->select('request.date_time_reception');
        $this->db->from('request');
        $this->db->where('request.date_time_reception', $date);
        $this->db->group_by('request.date_time_reception');
        $this->db->where('request.state!=', 0);


        $query = $this->db->get();
        return $query->result();
    }

    function get_request_all($date, $cliente_id)
    {

        $this->db->select('*');
        $this->db->from('request');
        $this->db->where('request.date_time_reception', $date);
        $this->db->where('request.cliente_id', $cliente_id);
        $this->db->where('request.state !=', 0);


        $query = $this->db->get();
        return $query->result();
    }
    function get_request_product_by_id($id)
    {
        $this->db->select('request_product.request_product_id,request_product.total_steams,request_product.measure_id,request_product.unit_price,request_product.total_price,request_product.status,product.product_id,product.name,product.photo,measure.name as measure,measure.measure_id');
        $this->db->from('request_product');
        $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
        $this->db->join('product', 'product.product_id=request_product.product_id');
        $this->db->where('request_product.request_id', $id);


        $query = $this->db->get();
        return $query->result();
    }

    function get_request_product_by_dailing($id)
    {
        $this->db->select('request_product.dialing_name as dialing,request_product.request_product_id,request_product.total_steams,request_product.measure_id,request_product.unit_price,request_product.total_price,request_product.status,product.product_id,product.name,product.photo,measure.name as measure,measure.measure_id');
        $this->db->from('request_product');
        $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
        $this->db->join('product', 'product.product_id=request_product.product_id');
        $this->db->where('request_product.request_id', $id);

        $query = $this->db->get();
        return $query->result();
    }
    function get_request_by_id($id)
    {
        $this->db->select('product_category.product_category_id,request_product.product_id,box_type.name caja,destination.name as destino,request_product.destination_id,request_product.qty_bunches,product.photo,product.stems_bunch,measure.name as measure,product.name as producto,request_product_box.qty,request_product_box.box_type_id,request_product.dialing_name as dialing,request_product.request_product_id,request_product.total_steams,request_product.measure_id,request_product.unit_price,request_product.total_price,request_product.status,request_product_box.request_product_box_id,request_product.carguera_id');
        $this->db->from('request_product');
        $this->db->join('request_product_box', 'request_product_box.request_product_id=request_product.request_product_id');
        $this->db->join('destination', 'destination.destination_id=request_product.destination_id');
        $this->db->join('box_type', 'box_type.box_type_id=request_product_box.box_type_id');
        $this->db->join('product', 'product.product_id=request_product.product_id');
        $this->db->join('product_category', 'product_category.product_category_id=product.product_category_id');
        $this->db->join('measure', 'measure.measure_id=request_product.measure_id');
        $this->db->where('request_product.request_id', $id);

        $query = $this->db->get();
        return $query->result();
    }
    function get_request_utilidad($inicio, $fin, $cliente_id)
    {
        $this->db->select('cliente.cliente_id,buy_element.buy_element_id,buy_element.qty as qty_finca,buy_element.price as price_finca,provider.name as provider,request.purchase_order,request.date_time_reception,cliente.cliente_name as cliente,product_category.product_category_id,request_product.product_id,box_type.name caja,destination.name as destino,request_product.destination_id,request_product.qty_bunches,product.photo,product.stems_bunch,measure.name as measure,product.name as producto,request_product_box.qty,request_product_box.box_type_id,request_product.dialing_name as dialing,request_product.request_product_id,request_product.total_steams,request_product.measure_id,request_product.unit_price,request_product.total_price,request_product.status,request_product_box.request_product_box_id,request_product.carguera_id');
        $this->db->from('request');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        $this->db->join('request_product', 'request_product.request_id=request.request_id');
        $this->db->join('request_product_box', 'request_product_box.request_product_id=request_product.request_product_id');
        $this->db->join('destination', 'destination.destination_id=request_product.destination_id');
        $this->db->join('box_type', 'box_type.box_type_id=request_product_box.box_type_id');
        $this->db->join('product', 'product.product_id=request_product.product_id');
        $this->db->join('product_category', 'product_category.product_category_id=product.product_category_id');
        $this->db->join('buy_element', 'buy_element.request_product_id=request_product.request_product_id');
        $this->db->join('provider', 'provider.provider_id=buy_element.provider_id');
        $this->db->join('measure', 'measure.measure_id=request_product.measure_id');
        $this->db->where("request.date_time_reception BETWEEN '" . $inicio . "' AND '" . $fin . "'");
        if ($cliente_id > 0) {
            $this->db->where("request.cliente_id ", $cliente_id);
        }
        $this->db->where("request.state ", 2);

        $query = $this->db->get();
        return $query->result();
    }
    function get_element_by_request_group($inicio, $fin, $cliente_id)
    {
        $this->db->distinct();
        $this->db->select('buy.buy_id,provider.provider_id,request.request_id');
        $this->db->from('request');
        $this->db->join('buy', 'buy.request_id = request.request_id');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        //  $this->db->group_by('provider.provider_id');
        $this->db->where("request.date_time_reception BETWEEN '" . $inicio . "' AND '" . $fin . "'");
        if ($cliente_id > 0) {
            $this->db->where("request.cliente_id ", $cliente_id);
        }
        $this->db->where("request.state ", 2);
        $this->db->order_by("request.date_time_reception", "acs");
        $query = $this->db->get();

        return $query->result();
    }
    function get_element_by_request_group_finca($inicio, $fin, $cliente_id, $provider_id)
    {
        $this->db->distinct();
        $this->db->select('buy.buy_id,provider.provider_id,request.request_id');
        $this->db->from('request');
        $this->db->join('buy', 'buy.request_id = request.request_id');
        $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
        $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
        // $this->db->group_by('provider.provider_id');
        $this->db->where("request.date_time_reception BETWEEN '" . $inicio . "' AND '" . $fin . "'");
        if ($cliente_id > 0) {
            $this->db->where("request.cliente_id ", $cliente_id);
        }
        $this->db->where("request.state ", 2);
        $this->db->where("provider.provider_id ", $provider_id);
        $this->db->order_by("request.date_time_reception", "acs");
        $query = $this->db->get();
        return $query->result();
    }
    function get_request_utilidad_cliente($inicio, $fin, $cliente_id)
    {
        $this->db->select('*');
        $this->db->from('request');
        $this->db->where("request.date_time_reception BETWEEN '" . $inicio . "' AND '" . $fin . "'");
        if ($cliente_id > 0) {
            $this->db->where("request.cliente_id ", $cliente_id);
        }
        $this->db->where("request.state ", 2);
        $query = $this->db->get();
        return $query->result();
    }
    function get_request_utilidad_finca($inicio, $fin, $cliente_id, $provider_id)
    {
        $this->db->select('cliente.cliente_id,buy_element.buy_element_id,buy_element.qty as qty_finca,buy_element.price as price_finca,provider.name as provider,request.purchase_order,request.date_time_reception,cliente.cliente_name as cliente,product_category.product_category_id,request_product.product_id,box_type.name caja,destination.name as destino,request_product.destination_id,request_product.qty_bunches,product.photo,product.stems_bunch,measure.name as measure,product.name as producto,request_product_box.qty,request_product_box.box_type_id,request_product.dialing_name as dialing,request_product.request_product_id,request_product.total_steams,request_product.measure_id,request_product.unit_price,request_product.total_price,request_product.status,request_product_box.request_product_box_id,request_product.carguera_id');
        $this->db->from('request');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        $this->db->join('request_product', 'request_product.request_id=request.request_id');
        $this->db->join('request_product_box', 'request_product_box.request_product_id=request_product.request_product_id');
        $this->db->join('destination', 'destination.destination_id=request_product.destination_id');
        $this->db->join('box_type', 'box_type.box_type_id=request_product_box.box_type_id');
        $this->db->join('product', 'product.product_id=request_product.product_id');
        $this->db->join('product_category', 'product_category.product_category_id=product.product_category_id');
        $this->db->join('buy_element', 'buy_element.request_product_id=request_product.request_product_id');
        $this->db->join('provider', 'provider.provider_id=buy_element.provider_id');
        $this->db->join('measure', 'measure.measure_id=request_product.measure_id');
        $this->db->where("request.date_time_reception BETWEEN '" . $inicio . "' AND '" . $fin . "'");
        if ($cliente_id > 0) {
            $this->db->where("request.cliente_id ", $cliente_id);
        }
        $this->db->where("provider.provider_id ", $provider_id);
        $this->db->where("request.state ", 2);
        $query = $this->db->get();
        return $query->result();
    }
    function get_request_estado_by_id($inicio, $fin, $cliente_id)
    {
        $this->db->select('*');
        // $this->db->select('request.request_id,request.cliente_id,request.purchase_order,request.date_time_reception,invoice.nro_invoice,invoice.awb,invoice.price_transporte,invoice.total_invoice,invoice.invoice_id');
        $this->db->from('request');
        // $this->db->join('buy', 'buy.request_id = request.request_id');
        // $this->db->join('credito', 'credito.po = request.request_id');
        //  $this->db->join('invoice', 'invoice.request_id = request.request_id');
        $this->db->where("request.date_time_reception >=", $inicio);
        $this->db->where("request.date_time_reception <=", $fin);
        // $this->db->where("request.date_time_reception BETWEEN '" . $inicio . "' AND '" . $fin . "'");
        $this->db->where("request.cliente_id ", $cliente_id);
        $this->db->where("request.state ", 2);
        $query = $this->db->get();
        return $query->result();
    }
    function get_request_estado_credito($inicio, $fin, $cliente_id)
    {

        // $this->db->select('*');
        $this->db->select('request.request_id,request.cliente_id,request.purchase_order,request.date_time_reception,invoice.nro_invoice,invoice.awb,invoice.price_transporte,invoice.total_invoice,invoice.invoice_id');
        $this->db->from('request');
        // $this->db->join('buy', 'buy.request_id = request.request_id');
        // $this->db->join('credito', 'credito.po = request.request_id', 'left');
        $this->db->join('invoice', 'invoice.request_id = request.request_id');
        $this->db->where("request.date_time_reception >=", $inicio);
        $this->db->where("request.date_time_reception <=", $fin);
        $this->db->where("request.cliente_id ", $cliente_id);
        //     $this->db->where("request.state ", 2);
        $query = $this->db->get();
        return $query->result();
    }
    function get_request_estado_credito_pagos($request_id)
    {

        $this->db->select('request.request_id,request.cliente_id,request.purchase_order,request.date_time_reception,invoice.nro_invoice,invoice.awb,invoice.price_transporte,invoice.total_invoice,invoice.invoice_id');
        $this->db->from('request');
        $this->db->join('invoice', 'invoice.request_id = request.request_id');
        $this->db->where("request.request_id ", $request_id);
        $query = $this->db->get();
        return $query->row();
    }

    function get_request_estado_by_id_fincas($inicio, $fin, $provider_id)
    {

        // $this->db->select('*');
        $this->db->select('invoice_provider.provider_id,request.purchase_order as po,request.request_id,cliente.cliente_name as cliente,invoice_provider.nro_invoice,request.date_time_reception,invoice_provider.total,invoice_provider.provider_id,buy.buy_id,invoice_provider.invoice_provider_id');
        $this->db->from('invoice_provider');
        $this->db->join('buy', 'buy.buy_id = invoice_provider.buy_id');
        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        $this->db->where("request.date_time_reception BETWEEN '" . $inicio . "' AND '" . $fin . "'");
        $this->db->where("invoice_provider.provider_id ", $provider_id);
        $this->db->where("invoice_provider.nro_invoice != '' ");
        $this->db->where("request.state ", 2);
        $this->db->group_by('invoice_provider.invoice_provider_id');
        $query = $this->db->get();
        return $query->result();
    }
    function get_request_estado_by_id_fincas_2($inicio, $fin, $provider_id)
    {
        $this->db->select('buy_element.provider_id,request.purchase_order as po,request.request_id,cliente.cliente_name as cliente,invoice_provider_element.nro_invoice,request.date_time_reception,invoice_provider_element.total, invoice_provider_element.invoice_provider_element_id,buy_element.provider_id');
        $this->db->from('invoice_provider_element');
        $this->db->join('buy_element', 'buy_element.buy_element_id = invoice_provider_element.buy_element_id');
        $this->db->join('buy', 'buy.buy_id = buy_element.buy_id');
        $this->db->join('request', 'request.request_id = buy.request_id');
        $this->db->join('cliente', 'cliente.cliente_id = request.cliente_id');
        $this->db->where("request.date_time_reception BETWEEN '" . $inicio . "' AND '" . $fin . "'");
        $this->db->where("buy_element.provider_id ", $provider_id);
        $this->db->where("request.state ", 2);
        $query = $this->db->get();
        return $query->result();
    }
    //------------------------------------------------------------------------------------------------------------------------------------------
}
