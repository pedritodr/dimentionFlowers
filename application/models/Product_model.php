<?php
class Product_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('product', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_product_mesure($data)
    {

        $this->db->insert('product_measure', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function get_by_measure_id($id)
    {
        $this->db->select('measure.measure_id,measure.name');
        $this->db->from('product');
        $this->db->join('product_measure', 'product_measure.product_id = product.product_id');
        $this->db->join('measure', 'measure.measure_id = product_measure.measure_id');
        $this->db->where('product_measure.product_id', $id);
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_products_by_measure_simple($id)
    {
        $this->db->select('measure_id');
        $this->db->where('product_id', $id);
        $query = $this->db->get('product_measure');


        $all_products_provider = $query->result();

        if ($all_products_provider) {
            $all_products_ids = [];
            foreach ($all_products_provider as $item) {
                $measure = $this->measure->get_by_id($item->measure_id);
                if ($measure)
                    array_push($all_products_ids, $measure->measure_id);
            }
            return $all_products_ids;
        } else return null;
    }

    function delete_product_measue($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('product_measure');
        $afec = $this->db->affected_rows();


        return $afec;
    }
    function get_by_id($id)
    {
        $this->db->where('product_id', $id);
        $query = $this->db->get('product');
        return $query->row();
    }
    function get_all($conditions = [], $get_as_row = FALSE, $order = false, $by = false, $cant = false, $active = false, $disponible = 0)
    {
        if ($order)
            $this->db->order_by($order, $by);
        if ($cant)
            $this->db->limit($cant);


        if ($conditions)
            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }
        $query = $this->db->get('product');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function get_all2($conditions = [], $limit, $offset)
    {
        if ($limit)
            $this->db->limit($limit);
        if ($offset)
            $this->db->offset($offset);

        if ($conditions)
            foreach ($conditions as $key => $value) {
                $this->db->where($key, $value);
            }

        $query = $this->db->get('product');

        return $query->result();
    }

    function get_all2_like($conditions = [], $limit, $offset, $like)
    {
        // die(var_dump($like));
        if ($limit)
            $this->db->limit($limit);
        if ($offset)
            $this->db->offset($offset);

        $this->db->select('*');
        $this->db->from('product');
        $this->db->where('visible', '1');
        $this->db->like('name', $like);
        $query = $this->db->get();

        //        $query = $this->db->get('product');

        return $query->result();
    }


    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('product_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('product');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
        }

        return $afec;
    }
    function delete($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('product');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
    function delete_measure($id)
    {
        $this->db->where('product_id', $id);
        $this->db->delete('product_measure');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
    function get_all_products()
    {
        $this->db->select('product.product_id, product.button_size,product.colour,product.commentary,product.name,product.stems_bunch, product.photo, product.descriptions, product_category.name as category,product.status,product_category.product_category_id');
        $this->db->from('product');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->where('product.status', 1);
        $this->db->order_by("product.name", "asc");
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_products_measure()
    {
        $this->db->select('product.product_id, product.name');
        $this->db->from('product');
        $query = $this->db->get();
        return $query->result();
    }
    function get_all_products_by_id($categoria_id)
    {
        $this->db->select('product.product_id,product.stems_bunch, product.name, product.photo, product.descriptions, product_category.name as category,product_category.product_category_id');
        $this->db->from('product');
        $this->db->join('product_category', 'product_category.product_category_id = product.product_category_id');
        $this->db->where('product_category.product_category_id', $categoria_id);
        $this->db->order_by("product.name", "asc");

        $query = $this->db->get();
        return $query->result();
    }

    function get_all_products_by_categoria_id($categoria_id, $color)
    {
        $this->db->distinct();
        $this->db->select('product.product_id,product.name');
        $this->db->from('product');
        $this->db->where('product.product_category_id', $categoria_id);
        $this->db->where('product.colour', $color);
        //   $this->db->like('product.colour', $color);
        $query = $this->db->get();
        return $query->result();
    }
    function search_by_name($name, $category)
    {
        if ($category) {
            $query = "SELECT * FROM product WHERE product_category_id = $category AND name LIKE '%$name%'";
            $resultados = $this->db->query($query);
            return $resultados->result();
        } else {
            $query = "SELECT * FROM product WHERE name LIKE '%$name%'";
            $resultados = $this->db->query($query);
            return $resultados->result();
        }
    }

    /*function search_by_country_and_city($name)
    {
        $query = "SELECT * FROM promocion_ciudad AS pc JOIN promocion AS p on p.promocion_id= pc.promocion_id   JOIN ciudad AS c on pc.ciudad_id =c.ciudad_id JOIN pais AS pa on pa.pais_id = c.pais_id WHERE p.cupon = 1 AND p.disponible >0  AND (c.nombre LIKE '%$name%' OR pa.nombre LIKE '%$name%')";
        $resultados = $this->db->query($query);
        return $resultados->result();
    }*/
}
