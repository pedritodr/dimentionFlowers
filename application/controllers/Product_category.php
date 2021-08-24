<?php

class Product_category extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Product_category_model', 'cat');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $all_categories = $this->cat->get_all();
        $cat_active = $this->cat->get_all(["is_active" => "1"]);
        $cat_desactivado = $this->cat->get_all(["is_active" => "2"]);
        $data["cat_active"] = $cat_active;
        $data["cat_desactivado"] = $cat_desactivado;
        $data['all_categories'] = $all_categories;
        $this->load_view_admin_g("category/index", $data);
    }



    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $this->load_view_admin_g('category/add');
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $name_file = $_FILES['archivo']['name'];
       // die(var_dump( $this->input->post()));
        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product_category/add_index");
        } else { //en caso de que todo este bien
        
            $w = 500;
            $h = 500;
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/categorias', time(), $w, $h);
                if ($result[0]) {

            $data = [
                'name' => $name,
                'foto' => $result[1],
                'is_active' => 1
                ];
                $this->cat->create($data);
            }
            else{
                $data = [
                    'name' => $name,
                    'is_active' => 1
                    ];
                    $this->cat->create($data);
            }
            }
            else{
                $data = [
                    'name' => $name,
                    'is_active' => 1
                    ];
                    $this->cat->create($data);
            
            $this->cat->create($data);
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("product_category/index", "location", 301);
        }
    }
}

    function update_index($cat_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

         $category_object = $this->cat->get_by_id($cat_id);

        if ($category_object) {
            $data['category_object'] = $category_object;
            $this->load_view_admin_g('category/update', $data);
        } else {
            show_404();
        }
    }


    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $name_file = $_FILES['archivo']['name'];
        $category_id = $this->input->post('category_id');
        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product_category/update_index/" . $category_id);
        } else { //en caso de que todo este bien
            $category_object = $this->cat->get_by_id($category_id);

            if ($category_object) {

                $data = ['name' => $name, 'is_active' => 1];
                $this->cat->update($category_id, $data);

                if($name_file != "")
                    {
                       unset($category_object->foto);
                       $w = 500;
                       $h = 500;
                       $separado = explode('.', $name_file);
                       $ext = end($separado); // me quedo con la extension
                       $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
                       $allow_extension = in_array($ext, $allow_extension_array);
                       if ($allow_extension) {
                           $result = save_image_from_post('archivo', './uploads/categorias', time(), $w, $h);
                           if ($result[0]) {
                            $data = ['foto' => $result[1]];
                            $this->cat->update($category_id, $data);
                            }
                        }
                    }
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("product_category/index", "location", 301);
            } else {
                show_404();
            }
        }
    }

    public function delete($cat_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $category_object = $this->cat->get_by_id($cat_id);
        if ($category_object) {
            $this->cat->update($cat_id, ['is_active' => 2]);
            $this->response->set_message("El elemento ha sido desactivado", ResponseMessage::SUCCESS);
            redirect("product_category/index");
        } else {
            show_404();
        }
    }

    public function activar($cat_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $category_object = $this->cat->get_by_id($cat_id);
        if ($category_object) {
            $this->cat->update($cat_id, ['is_active' => 1]);
            $this->response->set_message("El elemento ha  sido activado", ResponseMessage::SUCCESS);
            redirect("product_category/index");
        } else {
            show_404();
        }
    }


    public function delete_sub($cat_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $category_object = $this->cat->get_subcat_idcat3($cat_id);
        $idcat = $category_object->idcat;
        if ($category_object) {
            $this->cat->update_sub2($cat_id, ['is_active' => 2]);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("product_category/subcategoria/$idcat");
        } else {
            show_404();
        }
        redirect("product_category/subcategoria/$cat_id");
    }

    function subcategoria($cat_id = 0)
    {
       // die(var_dump($cat_id));
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }
        $category_object = $this->cat->get_by_id($cat_id);
        if ($category_object) {
            $subcategory_object = $this->cat->get_subcat_idcat2($cat_id);
            $data['category_object'] = $category_object;
            $data["subcategoria"] = $subcategory_object;
            $this->load_view_admin_g('category/subcategoria', $data);
        }
        else {
        show_404();
        }
    }

    public function add_sub($idcat = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $name_file = $_FILES['archivo']['name'];

        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product_category/add_index");
        } else { //en caso de que todo este bien
            $w = 500;
            $h = 500;
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/categorias', time(), $w, $h);
                if ($result[0]) {
            $data = [
                'idcat' => $idcat,
                'nombre' => $name,
                'foto' => $result[1],
                'is_active' => 1
                ];
                }
                $this->cat->create_sub($data);

            }
            else{
                $data = [
                    'idcat' => $idcat,
                    'nombre' => $name,
                  
                    'is_active' => 1
                    ];
                    }
                    $this->cat->create_sub($data);
            }
            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
            redirect("product_category/subcategoria/$idcat", "location", 301);
        }
    

    function update_sub($subcat_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $subcategory_object = $this->cat->get_subcat_idcat2($subcat_id);
        //die(var_dump($subcategory_object));
        if ($subcategory_object) {
            $data['subcategory_object'] = $subcategory_object;
            $this->load_view_admin_g('category/update_sub', $data);
        } else {
            show_404();
        }
    }

    public function update_sub2()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $name_file = $_FILES['archivo']['name'];
        $category_id = $this->input->post('category_id');
       // die(var_dump($category_id));
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product_category/subcategoria/" . $category_id);
        } 
        else { //en caso de que todo este bien
            $category_object = $this->cat->get_subcat_idcat2($category_id);
         //   die(var_dump($category_object));
            if ($category_object) {
                $data = ['nombre' => $name, 'is_active' => 1];
                $this->cat->update_sub2($category_object->idsub, $data);
              //  die(var_dump($category_object));
                if($name_file != "")
                    {
                    unset($category_object->foto);
                    $w = 500;
                    $h = 500;
                    $separado = explode('.', $name_file);
                    $ext = end($separado); // me quedo con la extension
                    $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
                    $allow_extension = in_array($ext, $allow_extension_array);
                    if ($allow_extension) {
                        $result = save_image_from_post('archivo', './uploads/categorias', time(), $w, $h);
                        if ($result[0]) {
                            $data = ['foto' => $result[1]];
                            $this->cat->update_sub2($category_object->idsub, $data);
                            }
                        }
                    }
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("product_category/subcategoria/$category_object->idcat", "location", 301);
            } else {
                show_404();
            }
        }
    }

    public function search_subcat($idcat = 0)
    {
        $subcat = $this->cat->get_subcat_idcat($idcat);
      //  die(var_dump($subcat));
      $select = "";
        if($subcat)
            {
                $select = "<select class='form-control' name='subcategoria' required>";
                foreach($subcat as $item)
                    {
                        if($idcat == $item->idcat)
                        $select .= "<option selected value='$item->idsub'>".$item->nombre."</option>";
                        else
                        $select .= "<option value='$item->idsub'>".$item->nombre."</option>";
                    }
                $select .= "</select>";
            }
        else{
                $select .= "<select class='form-control' name='subcategoria' required><option value='0' selected>Sin resultados</option></select>";
            }
        echo $select;
      
        
    }

    
}
