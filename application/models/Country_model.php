<?php

class Country_model extends CI_Model
{

    function __construct()
    {

        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {

        $this->db->insert('country', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }


    function get_by_id($id)
    {
        $this->db->where('country_id', $id);
        $query = $this->db->get('country');

        return $query->row();
    }

    function delete($id)
    {
        $this->db->where('country_id', $id);
        $this->db->delete('country');
        $afec = $this->db->affected_rows();


        return $afec;
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {

        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('country');

        return ($get_as_row) ? $query->row() : $query->result();
    }



    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('country_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('country');
        $afec = $this->db->affected_rows();

        if ($afec > 0) {
            $new = $this->get_by_id($id);
            // $this->activelog($id, null, 2, $new, $old);
        }

        return $afec;
    }







    public function activelog($id, $field, $action, $new = null, $old = null)
    {
        $model = 'banner';
        $this->load->model('Activelog_model', 'activelog');
        $log = new Activelog_model();
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
    public function gell_citys_by_country($country_id)
    {
        $this->db->where('country_id', $country_id);
        $query = $this->db->get('destination');

        return $query->result();
    }


    //------------------------------------------------------------------------------------------------------------------------------------------
}
