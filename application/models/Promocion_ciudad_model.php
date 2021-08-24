<?php
class Promocion_ciudad_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('promocion_ciudad', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('promocion_ciudad_id', $id);
        $query = $this->db->get('promocion_ciudad');
        return $query->row();
    }

    function get_by_id_city($id)
    {
        $this->db->select('ciudad.nombre as ciudad,pais.nombre pais');
        $this->db->from('promocion_ciudad');
        $this->db->join('ciudad', 'ciudad.ciudad_id = promocion_ciudad.ciudad_id');
        $this->db->join('pais', 'pais.pais_id = ciudad.pais_id');
        $this->db->where('promocion_ciudad.promocion_id', $id);


        $query = $this->db->get();
        return $query->result();
    }
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
        $query = $this->db->get('promocion_ciudad');

        return ($get_as_row) ? $query->row() : $query->result();
    }





    function get_all_paises_and_ciudades()
    {
        $this->db->select('ciudad.nombre');
        $this->db->from('pais');
        $this->db->join('ciudad', 'ciudad.pais_id = pais.pais_id');



        $query = $this->db->get();
        return $query->result();
    }


    function get_by_id_all($id)
    {
        $this->db->select('*');
        $this->db->from('promocion_ciudad');
        $this->db->join('promocion', 'promocion.promocion_id = promocion_ciudad.promocion_id');
        $this->db->join('ciudad', 'ciudad.ciudad_id = promocion_ciudad.ciudad_id');
        $this->db->where('promocion.promocion_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    function get_by_id_country($id)
    {
        $this->db->select('pais.pais_id, pais.nombre as pais');
        $this->db->from('ciudad');
        $this->db->join('pais', 'pais.pais_id = ciudad.pais_id');

        $this->db->where('ciudad.ciudad_id', $id);
        $query = $this->db->get();
        return $query->row();
    }


    function get_compra_by_id($id)
    {
        $this->db->select('plan_compra_id, fecha_compra, plan.nombre,plan.cant_dias_duracion,plan.precio,user.nombre as name, user.email');
        $this->db->from('plan_compra');
        $this->db->join('user', 'user.user_id = plan_compra.user_id');
        $this->db->join('plan', 'plan.plan_id = plan_compra.plan_id');
        $this->db->where('plan_compra_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('promocion_ciudad_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('promocion_ciudad');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('promocion_ciudad_id', $id);
        $this->db->delete('promocion_ciudad');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

    function create_promocion_citys_array($id, $array)
    {

        $this->db->where('promocion_id', $id);
        $this->db->delete('promocion_ciudad');

        foreach ($array as $item) {
            $data = ['promocion_id' => $id, 'ciudad_id' => $item];
            $this->db->insert('promocion_ciudad', $data);
        }
    }
}
