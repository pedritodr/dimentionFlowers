<?php

class Gallery_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('gallery', $data);
        $id = $this->db->insert_id();
       // $this->activelog($id, $data['image'], 1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('gallery_id', $id);
        $query = $this->db->get('gallery');

        return $query->row();
    }

    function get_gallery_evento_by_id($gallery_id)
    {
        $this->db->where('gallery_evento_id', $gallery_id);
        $query = $this->db->get('gallery_evento');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('gallery');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function get_all2()
    {
        $this->db->where("orden", "asc");
        $query = $this->db->get('banner');
        return $query->result();
    }

    public function get_all_evento($conditions = [], $get_as_row = FALSE)
    {
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('gallery_evento');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    public function create_gallery_evento($data)
    {
        $this->db->insert("gallery_evento", $data);
    }

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('gallery_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('gallery');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
          //  $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }

    function delete($id)
    {
        $this->db->where('gallery_id', $id);
        $this->db->delete('gallery');
        $afec = $this->db->affected_rows();
        if ($afec > 0) {
          //  $this->activelog($id, null, 3);
        }

        return $afec;
    }


    function delete_gallery_evento($id)
    {
        $this->db->where('gallery_evento_id', $id);
        $this->db->delete('gallery_evento');
    }

    public function activelog($id, $field, $action, $new = null, $old = null)
    {
        $model = 'gallery';
        $this->load->model('ActiveLog_model', 'activelog');
        $log = new ActiveLog_model();
        $log->model = $model;
        $log->idModel = $id;
        $log->field = $field;
        if ($action == 1)
            $log->afterSave($log);
        else if ($action == 2)
            $log->afterUpdate($log, $new, $old);
        else if ($action == 3)
            $log->afterDelete($log);

    }
    public function get_aleatorio($limit=1)
    {//SELECT * FROM tabla ORDER BY RAND() LIMIT 1;
        //$this->db->where('tipo', $tipo);
        $this->db->order_by('RAND()');
        $this->db->limit($limit);
        $query = $this->db->get('gallery_evento');
        return  $query->result();
    }

    //------------------------------------------------------------------------------------------------------------------------------------------
}
