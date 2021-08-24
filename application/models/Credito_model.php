<?php

class Credito_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('credito', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_id($id)
    {
        $this->db->where('credito_id', $id);
        $query = $this->db->get('credito');

        return $query->row();
    }
    function get_by_invoice_nro($id)
    {
        $this->db->where('nro_factura', $id);
        $query = $this->db->get('credito');

        return $query->row();
    }
    function get_credito_by_po($id)
    {
        $this->db->where('po', $id);
        $query = $this->db->get('credito');

        return $query->row();
    }
    function get_all_creditos_by_po($id, $provider_id)
    {
        $this->db->where('po', $id);
        $this->db->where('provider_id', $provider_id);
        $query = $this->db->get('credito');

        return $query->result();
    }
    function get_all_creditos_by_po_3($id)
    {
        $this->db->where('po', $id);
        //   $this->db->where('provider_id', $provider_id);
        $query = $this->db->get('credito');

        return $query->result();
    }
    function get_credito_by_po2($id, $buy_element_id)
    {
        $this->db->where('po', $id);
        $this->db->where('buy_element_id', $buy_element_id);
        $query = $this->db->get('credito');
        return $query->row();
    }
    function get_credito_by_ids($id, $provider, $po)
    {
        $this->db->where('product_id', $id);
        $this->db->where('provider_id', $provider);
        $this->db->where('po', $po);
        $this->db->where('is_active', 1);
        $query = $this->db->get('credito');

        return $query->row();
    }
    function get_credito_by_ids_2($id, $provider, $nro)
    {
        $this->db->where('product_id', $id);
        $this->db->where('provider_id', $provider);
        $this->db->where('nro_invoice', $nro);
        $this->db->where('is_active', 1);
        $query = $this->db->get('credito');

        return $query->row();
    }
    /* function get_by_user_id($id)
    {
        $this->db->where('user_id', $id);
        $query = $this->db->get('carguera');
        return $query->row();
    }*/

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
        $query = $this->db->get('credito');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('credito_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('credito');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('credito_id', $id);
        $this->db->delete('credito');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    /* function get_all_clientes()
    {
        $this->db->select('*');
        $this->db->from('cliente');
        $this->db->join('user', 'user.user_id = cliente.user_id');
        $this->db->join('country', 'country.country_id = cliente.country_id');


        $query = $this->db->get();
        return $query->result();
    }*/
    function get_all_creditos_cliente()
    {
        $this->db->select('credito.fecha_vuelo,credito.variedad,credito.bunches,credito.credito_id,credito.tipo,credito.fecha_factura,credito.tallos,credito.valor_cliente,credito.valor_finca,request.purchase_order,provider.name as provider,cliente.cliente_name as cliente, product.name as product,motivo.motivo');
        $this->db->from('credito');
        $this->db->join('request', 'request.request_id = credito.po');
        $this->db->join('provider', 'provider.provider_id = credito.provider_id');
        $this->db->join('cliente', 'cliente.cliente_id = credito.cliente_id');
        $this->db->join('product', 'product.product_id = credito.product_id');
        $this->db->join('motivo', 'motivo.motivo_id = credito.motivo_id');
        $this->db->where('credito.tipo', 1);
        $this->db->where('credito.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_creditos_cliente_by_date($fecha_inicio, $fecha_fin, $cliente_id)
    {
        $this->db->select('credito.fecha_vuelo,credito.variedad,credito.bunches,credito.credito_id,credito.tipo,credito.fecha_factura,credito.tallos,credito.valor_cliente,credito.valor_finca,request.purchase_order,provider.name as provider,cliente.cliente_name as cliente, product.name as product,motivo.motivo');
        $this->db->from('credito');
        $this->db->join('request', 'request.request_id = credito.po');
        $this->db->join('provider', 'provider.provider_id = credito.provider_id');
        $this->db->join('cliente', 'cliente.cliente_id = credito.cliente_id');
        $this->db->join('product', 'product.product_id = credito.product_id');
        $this->db->join('motivo', 'motivo.motivo_id = credito.motivo_id');
        $this->db->where('credito.tipo', 1);
        $this->db->where('credito.is_active', 1);
        $this->db->where("request.date_time_reception BETWEEN '" . $fecha_inicio . "' AND '" . $fecha_fin . "'");
        $this->db->where("request.cliente_id ", $cliente_id);
        $this->db->where("request.state ", 2);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_creditos_cliente_by_date_exportar($fecha_inicio, $fecha_fin, $cliente_id)
    {
        $this->db->select('credito.nro_factura,credito.fecha_vuelo,credito.variedad,credito.bunches,credito.credito_id,credito.tipo,credito.fecha_factura,credito.tallos,credito.valor_cliente,credito.valor_finca,request.purchase_order,provider.name as provider,cliente.cliente_name as cliente, product.name as product,motivo.motivo');
        $this->db->from('credito');
        $this->db->join('request', 'request.request_id = credito.po');
        $this->db->join('provider', 'provider.provider_id = credito.provider_id');
        $this->db->join('cliente', 'cliente.cliente_id = credito.cliente_id');
        $this->db->join('product', 'product.product_id = credito.product_id');
        $this->db->join('motivo', 'motivo.motivo_id = credito.motivo_id');
        $this->db->where('credito.tipo', 1);
        $this->db->where('credito.is_active', 1);
        $this->db->where("request.date_time_reception BETWEEN '" . $fecha_inicio . "' AND '" . $fecha_fin . "'");
        if ($cliente_id > 0) {
            $this->db->where("request.cliente_id ", $cliente_id);
        }
        $this->db->where("request.state ", 2);
        $query = $this->db->get();
        return $query->result();
    }
    function get_by_creditos_cliente($id)
    {
        $this->db->select('credito.fecha_vuelo,credito.variedad,credito.bunches,credito.credito_id,credito.tipo,credito.fecha_factura,credito.tallos,credito.valor_cliente,credito.valor_finca,request.purchase_order,provider.name as provider,cliente.cliente_name as cliente, product.name as product,motivo.motivo');
        $this->db->from('credito');
        $this->db->join('request', 'request.request_id = credito.po');
        $this->db->join('provider', 'provider.provider_id = credito.provider_id');
        $this->db->join('cliente', 'cliente.cliente_id = credito.cliente_id');
        $this->db->join('product', 'product.product_id = credito.product_id');
        $this->db->join('motivo', 'motivo.motivo_id = credito.motivo_id');
        $this->db->where('credito.tipo', 1);
        $this->db->where('credito.is_active', 1);
        $this->db->where('credito.nro_factura', $id);
        $query = $this->db->get();
        return $query->row();
    }
    function get_all_creditos_finca()
    {
        $this->db->select('credito.bunches,credito.nro_invoice,credito.nro_factura,credito.credito_id,credito.tipo,credito.fecha_factura,credito.tallos,credito.valor,provider.name as provider, product.name as product,motivo.motivo');
        $this->db->from('credito');
        $this->db->join('provider', 'provider.provider_id = credito.provider_id');
        $this->db->join('product', 'product.product_id = credito.product_id');
        $this->db->join('motivo', 'motivo.motivo_id = credito.motivo_id');
        $this->db->where('credito.tipo', 2);
        $this->db->where('credito.is_active', 1);
        $query = $this->db->get();
        return $query->result();
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}
