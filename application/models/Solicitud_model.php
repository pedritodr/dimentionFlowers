<?php
class Solicitud_model extends CI_Model
{
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    function create($data)
    {
        $this->db->insert('solicitud', $data);
        $id = $this->db->insert_id();
        return $id;
    }
    function get_by_id($solicitud_id = 0)
    {
        $this->db->where('solicitud_id', $solicitud_id);

        $query = $this->db->get('solicitud');
        return $query->row();
    }
    function get_by_id_cliente($solicitud_id = 0, $cliente_id = 0)
    {
        $this->db->where('solicitud_id', $solicitud_id);
        $this->db->where('cliente_id', $cliente_id);

        $query = $this->db->get('solicitud');
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
        $query = $this->db->get('solicitud');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('solicitud_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('solicitud');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            //  $this->activelog($id,null,2,$new,$old);
        }

        return $afec;
    }
    function delete($id)
    {
        $this->db->where('solicitud_id', $id);
        $this->db->delete('solicitud');
        $afec = $this->db->affected_rows();


        return $afec;
    }
    function get_solicitudes_enviadas($cliente_id)
    {
        $this->db->select('*');
        $this->db->from('solicitud');
        $this->db->join('user', 'user.user_id = solicitud.cliente_id');
        $this->db->join('solicitud_datos', 'solicitud_datos.solicitud_id = solicitud.solicitud_id');
        $this->db->join('subcategoria', 'subcategoria.subcategoria_id = solicitud.subcategoria_id');
        $this->db->where('solicitud.cliente_id', $cliente_id);


        $query = $this->db->get();
        return $query->result();
    }
    function get_solicitudes_recibidas($tecnico_id)
    {
        $this->db->select('solicitud.solicitud_id,solicitud.estado_solicitud,solicitud.monto_final,user.nombre as nombre, cliente.apellido,solicitud_datos.fecha, solicitud_datos.hora, solicitud_datos.persona_referencia, solicitud_datos.contacto_celular, solicitud_datos.referencia,solicitud_datos.direccion, solicitud_datos.descripcion_servicio, subcategoria.nombre as sub, solicitud_tecnico.estado_tecnico,solicitud_tecnico.precio,solicitud_tecnico.precio_cliente, solicitud_tecnico.tecnico_id, solicitud.calificacion');
        $this->db->from('solicitud');
        $this->db->join('user', 'user.user_id = solicitud.cliente_id');
        $this->db->join('solicitud_datos', 'solicitud_datos.solicitud_id = solicitud.solicitud_id');
        $this->db->join('subcategoria', 'subcategoria.subcategoria_id = solicitud.subcategoria_id');
        $this->db->join('solicitud_tecnico', 'solicitud_tecnico.solicitud_id = solicitud.solicitud_id');
        $this->db->join('cliente', 'cliente.user_id = user.user_id');
        $this->db->where('solicitud_tecnico.tecnico_id', $tecnico_id);
        $this->db->where('solicitud_tecnico.estado_tecnico!=', 6);

        $query = $this->db->get();
        return $query->result();
    }
    function get_solicitudes_atendidas($tecnico_id)
    {
        $this->db->select('solicitud.solicitud_id,solicitud.estado_solicitud,solicitud.monto_final,user.nombre as nombre, cliente.apellido,solicitud_datos.fecha, solicitud_datos.hora, solicitud_datos.persona_referencia, solicitud_datos.contacto_celular, solicitud_datos.referencia,solicitud_datos.direccion, solicitud_datos.descripcion_servicio, subcategoria.nombre as sub, solicitud_tecnico.estado_tecnico,solicitud_tecnico.precio,solicitud_tecnico.precio_cliente, solicitud_tecnico.tecnico_id, solicitud.calificacion');
        $this->db->from('solicitud');
        $this->db->join('user', 'user.user_id = solicitud.cliente_id');
        $this->db->join('solicitud_datos', 'solicitud_datos.solicitud_id = solicitud.solicitud_id');
        $this->db->join('subcategoria', 'subcategoria.subcategoria_id = solicitud.subcategoria_id');
        $this->db->join('solicitud_tecnico', 'solicitud_tecnico.solicitud_id = solicitud.solicitud_id');
        $this->db->join('cliente', 'cliente.user_id = user.user_id');
        $this->db->where('solicitud_tecnico.tecnico_id', $tecnico_id);
        $this->db->where('solicitud_tecnico.estado_tecnico', 6);

        $query = $this->db->get();
        return $query->result();
    }
    function get_solicitudes_recibidas_by_tecnico($tecnico_id)
    {
        $this->db->select('count(*) as count_1');
        $this->db->from('solicitud');
        $this->db->join('user', 'user.user_id = solicitud.cliente_id');
        $this->db->join('solicitud_datos', 'solicitud_datos.solicitud_id = solicitud.solicitud_id');
        $this->db->join('subcategoria', 'subcategoria.subcategoria_id = solicitud.subcategoria_id');
        $this->db->join('solicitud_tecnico', 'solicitud_tecnico.solicitud_id = solicitud.solicitud_id');
        $this->db->join('cliente', 'cliente.user_id = user.user_id');
        $this->db->where('solicitud_tecnico.tecnico_id', $tecnico_id);
        $this->db->where('solicitud_tecnico.estado_tecnico!=', 6);

        $query = $this->db->get();
        return $query->row();
    }
    function count_solicitudes_atendidas_by_tecnico($tecnico_id)
    {
        $this->db->select('count(*) as count_2');
        $this->db->from('solicitud');
        $this->db->join('user', 'user.user_id = solicitud.cliente_id');
        $this->db->join('solicitud_datos', 'solicitud_datos.solicitud_id = solicitud.solicitud_id');
        $this->db->join('subcategoria', 'subcategoria.subcategoria_id = solicitud.subcategoria_id');
        $this->db->join('solicitud_tecnico', 'solicitud_tecnico.solicitud_id = solicitud.solicitud_id');
        $this->db->join('cliente', 'cliente.user_id = user.user_id');
        $this->db->where('solicitud_tecnico.tecnico_id', $tecnico_id);
        $this->db->where('solicitud_tecnico.estado_tecnico', 6);

        $query = $this->db->get();
        return $query->row();
    }
}
