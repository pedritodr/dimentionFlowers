<?php

class Service_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('service', $data);
        $id = $this->db->insert_id();
       // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_service_category($data)
    {
        $this->db->insert('service_categoria', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function create_service_category_array($id,$array)
    {

        $this->db->where('service_id', $id);
        $this->db->delete('service_categoria');

        foreach ($array as $item)
        {
            $data = ['service_id'=>$id,'categoria_id'=>$item];
            $this->db->insert('service_categoria', $data);
        }
    }

    function get_by_id($id)
    {
        $this->db->where('service_id', $id);
        $query = $this->db->get('service');
        return $query->row();
    }

    function get_services_not_star(){
        $this->db->where('is_active',1);
        $this->db->where('estrella',0);
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('service');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function get_all($conditions = [], $get_as_row = FALSE)
    {
        $this->db->where('is_active',1);
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('service');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function get_all_cat_by_service_simple($id)
    {
        $this->db->select('categoria_id');
        $this->db->where('service_id', $id);
        $query = $this->db->get('service_categoria');
        $all_cats_service = $query->result();
        if($all_cats_service)
        {
            $all_cats_ids = [];
            foreach ($all_cats_service as $item) {
                $cat = $this->cat->get_by_id($item->categoria_id);
                if($cat)
                    array_push($all_cats_ids,$cat->categoria_id);
            }
            return $all_cats_ids;
        }
        else return null;

    }


    function get_all_cat_by_service($id)
    {

        $this->db->where('service_id', $id);
        $query = $this->db->get('service_categoria');
        $this->load->model('Category_model', 'cat');
        $all_cats_service = $query->result();
        if($all_cats_service)
        {
            $all_cats = [];
            foreach ($all_cats_service as $item) {
                $cat = $this->cat->get_by_id($item->categoria_id);
                if($cat)
                    array_push($all_cats,$cat);
            }
            return $all_cats;
        }
        else return null;
    }
    function get_all_by_cat($id)
    {

        $this->db->where('categoria_id', $id);
        $query = $this->db->get('service_categoria');

        $all_services_cat = $query->result();
        if($all_services_cat)
        {
            $all_services = [];
            foreach ($all_services_cat as $item) {
                $service = $this->get_by_id($item->service_id);
                if($service)
                    array_push($all_services,$service);
            }
            return $all_services;
        }
        else return null;

    }
    
    

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('service_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('service');
        $afec = $this->db->affected_rows();
        
        if($afec>0)
        {
            $new = $this->get_by_id($id);
          //  $this->activelog($id,null,2,$new,$old);
        }
           
        return $afec;
    }

    function delete($id)
    {
        $this->db->where('service_id', $id);
        $this->db->delete('service');
        $afec = $this->db->affected_rows();
        if($afec>0)
        {
          //  $this->activelog($id,null,3);
        }
           
        return $afec;
    }

    function estrella($id)
    {


        $item = $this->get_by_id($id);
        if(isset($item))
        {
            $this->db->where('service_id', $id);
            if($item->estrella==0) $this->db->update('service',['estrella'=>1]);
            else $this->db->update('service',['estrella'=>0]);
        }else
            return null;



        $afec = $this->db->affected_rows();
        if($afec>0)
        {
            //  $this->activelog($id,null,3);
        }

        return $afec;
    }

      public function activelog($id,$field,$action,$new=null,$old=null) {
        $model = 'service';
        $this->load->model('Activelog_model', 'activelog');
        $log = new Activelog_model();
        $log->model = $model;
        $log->idModel = $id;
        $log->field = $field;
        if($action == 1)
            $log->afterSave($log);
        else if($action == 2)
            $log->afterUpdate($log,$new,$old);
        else if($action == 3)
            $log->afterDelete($log);

      }


    //------------------------------------------------------------------------------------------------------------------------------------------
}
