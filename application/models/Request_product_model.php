    <?php

    class Request_product_model extends CI_Model
    {

        function __construct()
        {

            parent::__construct();
            $this->load->database();
        }

        function create($data)
        {

            $this->db->insert('request_product', $data);
            $id = $this->db->insert_id();
            // $this->activelog($id,$data['name'],1);
            return $id;
        }


        function get_by_id($id)
        {
            $this->db->where('request_product_id', $id);
            $query = $this->db->get('request_product');

            return $query->row();
        }
        function get_by_id_request($id)
        {

            $this->db->select('request_product.unit_price as precio_cliente,buy_element.price as precio_finca,buy_element.buy_element_id,buy_element.etiqueta,provider.name,product.name as product, buy_element.qty as qty_buy,box_type.name as box_type,request_product.total_steams,measure.name as measure, request_product.dialing_name as dialing, destination.name as destination,request.purchase_order');
            $this->db->from('buy');
            $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
            $this->db->join('request', 'request.request_id = buy.request_id');
            $this->db->join('request_product', 'request_product.request_product_id = buy_element.request_product_id');
            $this->db->join('measure', 'measure.measure_id = request_product.measure_id');
            $this->db->join('destination', 'destination.destination_id = request_product.destination_id');
            $this->db->join('request_product_box', 'request_product_box.request_product_id = request_product.request_product_id ');
            $this->db->join('box_type', 'box_type.box_type_id = request_product_box.box_type_id');
            $this->db->join('product', 'product.product_id = request_product.product_id');
            $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
            $this->db->where('buy.request_id', $id);


            $query = $this->db->get();
            return $query->result();
        }
        function get_delete($request_product, $request_id)
        {

            $this->db->select('buy_element.etiqueta,provider.name,product.name as product, buy_element.qty as qty_buy,box_type.name as box_type,request_product.total_steams,measure.name as measure, request_product.dialing_name as dialing, destination.name as destination,request.purchase_order');

            $this->db->from('request');
            $this->db->join('request_product', 'request_product.request_id = request.request_id');
            $this->db->join('request_product_box', 'request_product_box.request_product_id = request_product.request_product_id ');

            $this->db->where('request.request_id', $request_id);
            $this->db->where('request_product.request_product_id', $request_product);

            $query = $this->db->get();
            return $query->result();
        }

        function delete($id)
        {
            $this->db->where('request_product_id', $id);
            $this->db->delete('request_product');
            $afec = $this->db->affected_rows();


            return $afec;
        }

        function get_all($conditions = [], $get_as_row = FALSE)
        {

            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }
            $query = $this->db->get('request_product');

            return ($get_as_row) ? $query->row() : $query->result();
        }



        function update($id, $data)
        {
            $old = $this->get_by_id($id);
            $this->db->where('request_product_id', $id);
            foreach ($data as $key => $value) {
                $this->db->set($key, $value);
            }
            $this->db->update('request_product');
            $afec = $this->db->affected_rows();

            if ($afec > 0) {
                $new = $this->get_by_id($id);
                // $this->activelog($id, null, 2, $new, $old);
            }

            return $afec;
        }
        function get_products_by_provider($id, $request_id)
        {

            $this->db->select('product.product_id,product.name');
            $this->db->from('buy');
            $this->db->join('buy_element', 'buy_element.buy_id = buy.buy_id');
            //    $this->db->join('provider', 'provider.provider_id = buy_element.provider_id');
            $this->db->join('request_product', 'request_product.request_product_id = buy_element.request_product_id');
            $this->db->join('product', 'product.product_id = request_product.product_id');
            $this->db->where('buy_element.provider_id', $id);
            $this->db->where('buy.request_id', $request_id);
            // $this->db->where('request_product.request_id', $request_id);
            $this->db->group_by('request_product.product_id');
            $query = $this->db->get();

            return $query->result();
        }



        //------------------------------------------------------------------------------------------------------------------------------------------
    }
