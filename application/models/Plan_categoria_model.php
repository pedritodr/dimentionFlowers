<?php
class Plan_categoria_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('plan_categoria', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('plan_categoria_id', $id);
        $query = $this->db->get('plan_categoria');
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
        $query = $this->db->get('plan_categoria');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('plan_categoria_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('plan_categoria');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function delete($id)
    {
        $this->db->where('plan_categoria_id', $id);
        $this->db->delete('plan_categoria');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
    public function get_all_categorias_by_planes($plan_categoria_id)
    {
        $this->db->select('*');
        $this->db->from('plan');
        $this->db->join('plan_categoria', 'plan_categoria.plan_categoria_id = plan.plan_categoria_id');

        $this->db->where('plan.plan_categoria_id', $plan_categoria_id);




        $query = $this->db->get();
        return $query->result();
    }
}
