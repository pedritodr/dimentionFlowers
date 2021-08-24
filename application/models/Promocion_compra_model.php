<?php
class Promocion_compra_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('promocion_compra', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('promocion_compra_id', $id);
        $query = $this->db->get('promocion_compra');
        return $query->row();
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
        $query = $this->db->get('promocion_compra');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('promocion_compra_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('promocion_compra');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function delete($id)
    {
        $this->db->where('promocion_compra_id', $id);
        $this->db->delete('promocion_compra');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
    public function get_all_plan_by_promocion($promocion_id)
    {
        $this->db->where('promocion_id', $promocion_id);
        $query = $this->db->get('promocion');

        return $query->result();
    }

    public function get_all_usuario_by_promocion($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user');

        return $query->result();
    }


    function get_all_promociones()
    {
        $this->db->select('promocion_compra_id, fecha_compra, promocion.titulo,promocion.descripcion,promocion.precio,promocion.foto,user.nombre as name');
        $this->db->from('promocion_compra');
        $this->db->join('user', 'user.user_id = promocion_compra.user_id');
        $this->db->join('promocion', 'promocion.promocion_id = promocion_compra.promocion_id');



        $query = $this->db->get();
        return $query->result();
    }
    function get_promocion_by_id($id)
    {
        $this->db->select('promocion_compra_id, fecha_compra, promocion.titulo,promocion.descripcion,promocion.precio,promocion.foto,user.nombre as name, user.email');
        $this->db->from('promocion_compra');
        $this->db->join('user', 'user.user_id = promocion_compra.user_id');
        $this->db->join('promocion', 'promocion.promocion_id = promocion_compra.promocion_id');
        $this->db->where('promocion_compra_id', $id);
        $query = $this->db->get();
        return $query->row();
    }
}
