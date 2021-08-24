<?php
class Tecnico_categoria_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('tecnico_categoria', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('tecnico_categoria_id', $id);
        $query = $this->db->get('tecnico_categoria');
        return $query->row();
    }
    function get_by_tecnico_cate_id($id)
    {
        $this->db->select('subcategoria_id');
        $this->db->where('user_id', $id);
        $query = $this->db->get('tecnico_categoria');
        return $query->result();
    }
    function get_tecnicos_subcategorias($id)
    {

        $this->load->model('Usuario_model', 'user');
        $this->db->select('user_id');
        $this->db->where('subcategoria_id', $id);
        $query = $this->db->get('tecnico_categoria');

        $all_tecnicos = $query->result();
        if ($all_tecnicos) {
            $all_tecnicos_ids = [];
            foreach ($all_tecnicos as $item) {
                $tecnico = $this->user->get_by_id($item->user_id);
                if ($tecnico)
                    array_push($all_tecnicos_ids, $tecnico->user_id);
            }
            return $all_tecnicos_ids;
        } else return null;
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
        $query = $this->db->get('tecnico_categoria');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('tecnico_categoria_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('tecnico_categoria');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function delete($id)
    {
        $this->db->where('tecnico_categoria_id', $id);
        $this->db->delete('tecnico_categoria');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
    function create_tecnico_categoria_array($id, $array)
    {

        $this->db->where('user_id', $id);
        $this->db->delete('tecnico_categoria');

        foreach ($array as $item) {
            $data = ['user_id' => $id, 'subcategoria_id' => $item];
            $this->db->insert('tecnico_categoria', $data);
        }
    }

    function get_all_tecnico_by_subcategoria_simple($id)
    {
        $this->db->select('subcategoria_id');
        $this->db->where('user_id', $id);
        $this->load->model('Category_model', 'cate');
        $query = $this->db->get('tecnico_categoria');
        $all_subcategorias = $query->result();
        if ($all_subcategorias) {
            $all_subcategorias_ids = [];
            foreach ($all_subcategorias as $item) {
                $sub = $this->cate->get_subcategory_by_id($item->subcategoria_id);
                if ($sub)
                    array_push($all_subcategorias_ids, $sub->subcategoria_id);
            }
            return $all_subcategorias_ids;
        } else return null;
    }
}
