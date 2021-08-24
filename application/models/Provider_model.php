<?php

class Provider_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('provider', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_unico($data)
    {

        $this->db->insert('unicos', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_provider_product($data)
    {

        $this->db->insert('provider_product', $data);
        $id = $this->db->insert_id();

        return $id;
    }
    function create_product_mesure($data)
    {

        $this->db->insert('provider_product_measure', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('provider_id', $id);
        $query = $this->db->get('provider');

        return $query->row();
    }

    function get_by_id_provider_product($id)
    {
        $this->db->where('provider_product_id', $id);
        $query = $this->db->get('provider_product');

        return $query->row();
    }



    function delete($id)
    {
        $this->db->where('provider_id', $id);
        $this->db->delete('provider');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function delete_provider_product($id)
    {
        $this->db->where('provider_product_id', $id);
        $this->db->delete('provider_product');
        $afec = $this->db->affected_rows();


        return $afec;
    }
    function delete_provider_product_measure($id)
    {
        $this->db->where('provider_product_id', $id);
        $this->db->delete('provider_product_measure');
        $afec = $this->db->affected_rows();


        return $afec;
    }
    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $this->db->order_by('name', 'asc');
        $query = $this->db->get('provider');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('provider_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('provider');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }
    function update_product($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('provider_product_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('provider_product');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }
    function create_provider_products_array($id, $array)
    {

        /*  $this->db->where('provider_id', $id);
        $this->db->delete('provider_product');*/
        $lista_products = $this->get_all_products_by_provider_ids($id);
        if ($lista_products) {

            foreach ($array as $item) {
                if (!in_array($item, $lista_products)) {
                    $data = ['provider_id' => $id, 'product_id' => $item];
                    $this->db->insert('provider_product', $data);
                }
            }
        } else {
            foreach ($array as $item) {
                $data = ['provider_id' => $id, 'product_id' => $item];
                $this->db->insert('provider_product', $data);
            }
        }
    }

    function get_all_products_by_provider_simple($id)
    {
        $this->db->select('product_id');
        $this->db->where('provider_id', $id);
        $query = $this->db->get('provider_product');


        $all_products_provider = $query->result();

        if ($all_products_provider) {
            $all_products_ids = [];
            foreach ($all_products_provider as $item) {

                array_push($all_products_ids, $item->product_id);
            }
            return $all_products_ids;
        } else return null;
    }
    function get_all_products_by_provider($id)
    {

        $this->db->select('product.product_id, product.name,product.photo,provider_product.provider_product_id,product_category.name as category');
        $this->db->from('provider_product');
        $this->db->join('product', 'product.product_id = provider_product.product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->where('provider_product.provider_id', $id);

        $query = $this->db->get();
        return $query->result();
    }

    function get_all_categorias_by_provider($id)
    {
        $this->db->distinct();
        $this->db->select('product_category.product_category_id, product_category.name,');
        $this->db->from('provider_product');
        $this->db->join('product', 'product.product_id = provider_product.product_id');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->where('provider_product.provider_id', $id);

        $query = $this->db->get();
        return  $query->result();
    }

    function get_all_products_by_provider_ids($id)
    {

        $this->db->select('product_id');
        $this->db->where('provider_id', $id);
        $query = $this->db->get('provider_product');
        $this->db->where('state', 1);
        $all_products_provider = $query->result();

        if ($all_products_provider) {
            $all_products_ids = [];
            foreach ($all_products_provider as $item) {

                array_push($all_products_ids, $item->product_id);
            }
            return $all_products_ids;
        } else return null;
    }

    function get_by_provider_measure($provider_id, $product_id)
    {

        $this->db->select('*');
        $this->db->from('provider_product');
        $this->db->where('provider_product.provider_id', $provider_id);
        $this->db->where('provider_product.product_id', $product_id);


        $query = $this->db->get();
        return $query->row();
    }

    function get_all_measure_product($id)
    {

        $this->db->select('measure.name');
        $this->db->from('provider_product_measure');
        $this->db->join('measure', 'measure.measure_id = provider_product_measure.measure_id');
        $this->db->where('provider_product_measure.provider_product_id', $id);

        $query = $this->db->get();
        return $query->result();
    }
    function get_all_providers_by_variety($id)
    {
        //  $this->db->distinct();
        $this->db->select('*');
        $this->db->from('provider_product');
        $this->db->join('product', 'product.product_id = provider_product.product_id');
        $this->db->join('provider', 'provider.provider_id = provider_product.provider_id');
        $this->db->where('provider_product.product_id', $id);
        $this->db->where('provider.is_active', 0);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_providers_by_variety_object($id)
    {
        // $this->db->distinct('provider');
        $this->db->select('*');
        $this->db->from('provider_product');
        $this->db->join('product', 'product.product_id = provider_product.product_id');
        $this->db->join('provider', 'provider.provider_id = provider_product.provider_id');
        $this->db->where('provider_product.product_id', $id);
        $this->db->where('provider.is_active', 0);
        $query = $this->db->get();
        return $query->result();
    }
    function get_products_by_category($id)
    {
        $this->db->select('product_id,name');
        $this->db->from('product');
        $this->db->where('product_category_id', $id);
        $this->db->order_by('name');
        $query = $this->db->get();
        return  $query->result();
    }


    //------------------------------------------------------------------------------------------------------------------------------------------
}
