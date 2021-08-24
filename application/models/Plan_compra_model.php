<?php
class Plan_compra_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('plan_compra', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('plan_compra_id', $id);
        $query = $this->db->get('plan_compra');
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
        $query = $this->db->get('plan_compra');

        return ($get_as_row) ? $query->row() : $query->result();
    }
    public function get_all_plan_by_planes($plan_id)
    {
        $this->db->where('plan_id', $plan_id);
        $query = $this->db->get('plan');

        return $query->result();
    }

    public function get_all_usuario_by_planes($user_id)
    {
        $this->db->where('user_id', $user_id);
        $query = $this->db->get('user');

        return $query->result();
    }
    public function get_all_servicio_by_plan($plan_id)
    {
        $this->db->where('plan_id', $plan_id);
        $query = $this->db->get('servicio');

        return $query->result();
    }

    function get_all_compras()
    {
        $this->db->select('plan_compra_id, fecha_compra, plan.nombre,plan.cant_dias_duracion,user.nombre as name');
        $this->db->from('plan_compra');
        $this->db->join('user', 'user.user_id = plan_compra.user_id');
        $this->db->join('plan', 'plan.plan_id = plan_compra.plan_id');



        $query = $this->db->get();
        return $query->result();
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
}
