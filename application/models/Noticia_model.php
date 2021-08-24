<?php

class Noticia_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    function create($data)
    {
        $this->db->insert('noticia', $data);
        $id = $this->db->insert_id();
       // $this->activelog($id,$data['name'],1);
        return $id;
    }
    function create_noticia_category($data)
    {
        $this->db->insert('noticia_categoria', $data);
        $id = $this->db->insert_id();
        // $this->activelog($id,$data['name'],1);
        return $id;
    }

    function create_noticia_category_array($id,$array)
    {

        $this->db->where('noticia_id', $id);
        $this->db->delete('noticia_categoria');

        foreach ($array as $item)
        {
            $data = ['noticia_id'=>$id,'categoria_id'=>$item];
            $this->db->insert('noticia_categoria', $data);
        }
    }

    function get_by_id($id)
    {
        $this->db->where('noticia_id', $id);
        $query = $this->db->get('noticia');

        return $query->row();
    }

    function get_all($conditions = [], $get_as_row = FALSE, $order = false, $by = false, $cant = false,$active = false)
    {
        if($order)
            $this->db->order_by($order,$by);
        if($cant)
            $this->db->limit($cant);
        if($active)
        $this->db->where('is_active',1);
        if($conditions)
        foreach ($conditions as $key => $value) {
            $this->db->where($key, $value);
        }
        $query = $this->db->get('noticia');

        return ($get_as_row) ? $query->row() : $query->result();
    }

    function get_all_cat_by_noticia_simple($id)
    {
        $this->db->select('categoria_id');
        $this->db->where('noticia_id', $id);
        $query = $this->db->get('noticia_categoria');
        $all_cats_noticia = $query->result();
        if($all_cats_noticia)
        {
            $all_cats_ids = [];
            foreach ($all_cats_noticia as $item) {
                $cat = $this->cat->get_by_id($item->categoria_id);
                if($cat)
                    array_push($all_cats_ids,$cat->categoria_id);
            }
            return $all_cats_ids;
        }
        else return null;

    }


    function get_all_cat_by_noticia($id)
    {

        $this->db->where('noticia_id', $id);
        $query = $this->db->get('noticia_categoria');
        $this->load->model('Category_model', 'cat');
        $all_cats_noticia = $query->result();
        if($all_cats_noticia)
        {
            $all_cats = [];
            foreach ($all_cats_noticia as $item) {
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
        $this->db->order_by('categoria_id','DESC');
        $query = $this->db->get('noticia_categoria');

        $all_noticias_cat = $query->result();
        if($all_noticias_cat)
        {
            $all_noticias = [];
            foreach ($all_noticias_cat as $item) {
                $noticia = $this->get_by_id($item->noticia_id);
                
                if($noticia)
                    if($noticia->is_active ==1)
                    array_push($all_noticias,$noticia);
            }
            return $all_noticias;
        }
        else return null;

    }
    
    

    function update($id, $data)
    {
        $old = $this->get_by_id($id);
        $this->db->where('noticia_id', $id);
        foreach ($data as $key => $value) {
            $this->db->set($key, $value);
        }
        $this->db->update('noticia');
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
        $this->db->where('noticia_id', $id);
        $this->db->delete('noticia');
        $afec = $this->db->affected_rows();
        if($afec>0)
        {
          //  $this->activelog($id,null,3);
        }
           
        return $afec;
    }

      public function activelog($id,$field,$action,$new=null,$old=null) {
        $model = 'noticia';
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
