<?php
class Plan_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('plan', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('plan_id', $id);
        $query = $this->db->get('plan');
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
        $query = $this->db->get('plan');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('plan_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('plan');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function delete($id)
    {
        $this->db->where('plan_id', $id);
        $this->db->delete('plan');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }
    public function get_all_servicio_by_planes($plan_id)
    {
        $this->db->where('plan_id', $plan_id);
        $query = $this->db->get('servicio');

        return $query->result();
    }

    function get_all_servicios()
    {
        $this->db->select('*');
        $this->db->from('plan');
        $this->db->join('servicio', 'servicio.plan_id = plan.plan_id', 'right');
        $this->db->where('plan.is_active', 1);

        $query = $this->db->get();
        return $query->result();
    }
    function get_all_planes()
    {
        $this->db->select('*');
        $this->db->from('plan');
        $this->db->join('plan_categoria', 'plan_categoria.plan_categoria_id = plan.plan_categoria_id');


        $query = $this->db->get();
        return $query->result();
    }
    function get_all_planes_destacado()
    {
        $this->db->select('*');
        $this->db->from('plan');
        $this->db->join('plan_categoria', 'plan_categoria.plan_categoria_id = plan.plan_categoria_id');
        $this->db->where('plan.is_active', 1);
        $this->db->where('destacado', 1);



        $query = $this->db->get();
        return $query->result();
    }


    function destacado($id)
    {
        $plan_object = $this->get_by_id($id);
        if ($plan_object) {
            if ($plan_object->destacado == 1)
                $this->update($id, ['destacado' => 0]);
            else $this->update($id, ['destacado' => 1]);
        } else return null;


        $afec = $this->db->affected_rows();
        if ($afec > 0) {
            $this->activelog($id, null, 3);
        }

        return $afec;
    }


    function foto($id, $data)
    {
        $plan_object = $this->get_by_id($id);
        if ($plan_object) {

            $this->update($id, $data);
        } else return null;
    }
    public function get_all_categorias_by_planes($plan_id)
    {
        $this->db->select('*');
        $this->db->from('plan');
        $this->db->join('plan_categoria', 'plan_categoria.plan_categoria_id = plan.plan_categoria_id');

        $this->db->where('plan.plan_id', $plan_id);




        $query = $this->db->get();
        return $query->row();
    }
}
