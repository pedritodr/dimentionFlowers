<?php
class Solicitud_tecnico_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('solicitud_tecnico', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    function get_by_id($id)
    {
        $this->db->where('solicitud_tecnico_id', $id);
        $query = $this->db->get('solicitud_tecnico');
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
        $query = $this->db->get('solicitud_tecnico');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('solicitud_id', $id);

        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('solicitud_tecnico');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }

    function update_tecnico($solicitud_id, $tecnico_id, $data)
    {

        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->where('solicitud_id', $solicitud_id);
        $this->db->where('tecnico_id', $tecnico_id);
        $this->db->update('solicitud_tecnico');
    }

    function delete($id)
    {
        $this->db->where('solicitud_tecnico_id', $id);
        $this->db->delete('solicitud_tecnico');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_by_id_tecnico($solicitud_id = 0, $tecnico_id = 0)
    {
        $this->db->where('solicitud_id', $solicitud_id);
        $this->db->where('tecnico_id', $tecnico_id);

        $query = $this->db->get('solicitud_tecnico');
        return $query->row();
    }

    function get_tecnicos_by_solicitudes($solicitud_id)
    {

        $query = "SELECT * FROM solicitud_tecnico AS st JOIN user AS u on st.tecnico_id= u.user_id   JOIN dato_tecnico AS dt on dt.user_id =u.user_id WHERE st.solicitud_id =$solicitud_id AND st.estado_tecnico !=4 AND st.estado_tecnico !=5";
        $resultados = $this->db->query($query);
        return $resultados->result();
    }
}
