<?php

class Product extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Product_model', 'product');
        $this->load->model('Variety_model', 'variety');

        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $all_products = $this->product->get_all_products();

        $data['all_products'] = $all_products;

        $this->load_view_admin_g("product/index", $data);
    }

    public function add_index()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Product_category_model', 'product_category');

        $all_product_category = $this->product_category->get_all();

        $data['all_product_category'] = $all_product_category;

        $this->load_view_admin_g('product/add', $data);
    }

    public function add()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }


        $name = $this->input->post('name');
        $descripcion = $this->input->post('descripcion');
        $category = $this->input->post('category');

        $subcategory = $this->input->post('subcategoria');
        $bunch = $this->input->post('bunch');
        $colour  = $this->input->post('colour');
        $button_size  = $this->input->post('button_size');

        $petalos = "";
        $tallo = $this->input->post("tallo");
        $florero = $this->input->post("florero");
        $visible = $this->input->post("visible");
        $commentary  = $this->input->post('commentary');

        //establecer reglas de

        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('category', "Seleccione una categoria", 'required');
        $this->form_validation->set_rules('bunch', translate('stems_bunch'), 'required');


        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product/add_index");
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            if ($name_file == "") {
                $data = ['name' => $name, 'descriptions' => $descripcion, 'product_category_id' => $category, 'subcat_id' => $subcategory, 'status' => 1, 'stems_bunch' => $bunch, 'colour' => $colour, 'button_size' => $button_size, 'commentary' => $commentary, 'petalos' => $petalos, 'largotallo' => $tallo, 'diasflorero' => $florero, 'visible' => $visible];
                $this->product->create($data);
                $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                redirect("product/index", "location", 301);
            } else {
                $w = 570;
                $h = 570;

                $separado = explode('.', $name_file);
                $ext = end($separado); // me quedo con la extension
                $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
                $allow_extension = in_array($ext, $allow_extension_array);
                if ($allow_extension) {
                    $result = save_image_from_post('archivo', './uploads/product', time(), $w, $h);
                    if ($result[0]) {
                        $data = ['name' => $name, 'descriptions' => $descripcion, 'photo' => $result[1], 'product_category_id' => $category, 'subcat_id' => $subcategory, 'status' => 1, 'stems_bunch' => $bunch, 'colour' => $colour, 'button_size' => $button_size, 'commentary' => $commentary, 'petalos' => $petalos, 'largotallo' => $tallo, 'diasflorero' => $florero, 'visible' => $visible];

                        $this->product->create($data);

                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("product/index", "location", 301);
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("product/add_index", "location", 301);
                    }
                } else {

                    $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                    redirect("product/add_index", "location", 301);
                }
            }
        }
    }

    function update_index($product_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model('Measure_model', 'measure');
        $this->load->model('Product_category_model', "cat");
        $product_object = $this->product->get_by_id($product_id);
        //$subcat_id = $product_object->subcat_id;
        $subcat = $this->cat->get_subcat_idcat2(@$product_object->subcat_id);
        //die(var_dump($subcat));
        $datos = $this->cat->get_by_id($product_object->product_category_id);
        $datos = $this->cat->get_subcat_idcat(($datos->product_category_id));
        $datos2 = "<select class='form-control' name='subcategoria'>";
        if (($subcat == "") or ($subcat == null))
            @$datos2 .= "<option  value=''>Seleccione</option>";
        else
            @$datos2 .= "<option  selected value='$subcat->idsub'>$subcat->nombre</option>";

        foreach ($datos as $item) {
            if (@$subcat->idsub != @$item->idsub)
                $datos2 .= "<option value='$item->idsub'>$item->nombre</option>";
        }
        $datos2 .= "</select>";
        if (isset($product_object)) {
            $this->load->model('Product_category_model', 'product_category');
            $all_product_category = $this->product_category->get_all();
            $data['all_product_category'] = $all_product_category;
            $data['product_object'] = $product_object;
            $data["subcat"] = $subcat;
            // die(var_dump($datos2));
            $data["datos"] = $datos2;
            $this->load_view_admin_g('product/update', $data);
        } else {
            show_404();
        }
    }

    public function update()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $descripcion = $this->input->post('descripcion');
        $category = $this->input->post('category');
        $product_id = $this->input->post('product_id');
        $bunch = $this->input->post('bunch');
        $colour  = $this->input->post('colour');
        $button_size  = $this->input->post('button_size');
        $commentary  = $this->input->post('commentary');

        $subcategory = $this->input->post('subcategoria');

        $petalos = $this->input->post("petalos");
        $tallo = $this->input->post("tallo");
        $florero = $this->input->post("florero");
        $visible = $this->input->post("visible");

        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');
        $this->form_validation->set_rules('category', "Seleccione una categoria", 'required');
        $this->form_validation->set_rules('bunch', translate('stems_bunch'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product/update_index/" . $product_id);
        } else {
            //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {

                    $data = ['name' => $name, 'descriptions' => $descripcion, 'product_category_id' => $category, 'stems_bunch' => $bunch, 'colour' => $colour, 'button_size' => $button_size, 'commentary' => $commentary, 'subcat_id' => $subcategory, 'petalos' => $petalos, 'diasflorero' => $florero, 'visible' => $visible, 'largotallo' => $tallo];
                    $this->product->update($product_id, $data);
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("product/index", "location", 301);
                } else {

                    $product_object = $this->product->get_by_id($product_id);

                    if ($product_object) {

                        $result = save_image_from_post('archivo', './uploads/product', time(), 570, 570);
                        if ($result[0]) {
                            if (file_exists($product_object->photo))
                                unlink($product_object->photo);
                            $data = ['name' => $name, 'descriptions' => $descripcion, 'photo' => $result[1], 'product_category_id' => $category, 'stems_bunch' => $bunch, 'colour' => $colour, 'button_size' => $button_size, 'commentary' => $commentary, 'subcat_id' => $subcategory, 'petalos' => $petalos, 'diasflorero' => $florero, 'visible' => $visible, 'largotallo' => $tallo];
                            $this->product->update($product_id, $data);
                            $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                            redirect("product/index", "location", 301);
                        } else {

                            $this->response->set_message($result[1], ResponseMessage::ERROR);
                            redirect("product/add_index", "location", 301);
                        }
                    } else {
                        show_404();
                    }
                }
            } else {
                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("product/update_index/" . $product_id, "location", 301);
            }
        }
    }



    public function delete($product_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $product_object = $this->product->get_by_id($product_id);

        if (isset($product_object)) {
            unlink($product_object->photo);
            $this->product->update($product_id, ['status' => 0]);

            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("product/index");
        } else {
            show_404();
        }
    }



    public function variety_index($product_id = 0)
    {

        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $product_object = $this->product->get_by_id($product_id);
        if (isset($product_object)) {
            $all_varieties = $this->variety->get_variety_by_product($product_id);

            if (isset($all_varieties)) {
                foreach ($all_varieties as $item) {
                    $item->measure = $this->variety->get_by_measure_id($item->variety_id);
                }
            }
            $data['all_varieties'] = $all_varieties;

            $data['product_id'] = $product_id;

            $this->load_view_admin_g("product/variety_index", $data);
        } else {
            show_404();
        }
    }

    public function add_variety_index($product_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }
        $product_object = $this->product->get_by_id($product_id);
        if (isset($product_object)) {

            $data['product_id'] = $product_id;


            $this->load_view_admin_g('product/add_variety', $data);
        } else {
            show_404();
        }
    }

    public function add_variety()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }


        $name = $this->input->post('name');
        $product_id = $this->input->post('product_id');
        $measure  = $this->input->post('medida');
        $descripcion = $this->input->post('descripcion');

        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');



        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product/add_variety_index");
        } else { //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];
            $w = 253;
            $h = 300;

            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension) {
                $result = save_image_from_post('archivo', './uploads/variety', time(), $w, $h);
                if ($result[0]) {
                    $data = ['name' => $name, 'photo' => $result[1], 'product_id' => $product_id, 'description' => $descripcion];

                    $id =  $this->variety->create($data);

                    for ($i = 0; $i < sizeof($measure); $i++) {

                        $data_measure = [
                            'variety_id	' => $id,
                            'measure' => $measure[$i]
                        ];

                        $this->variety->create_variety_mesure($data_measure);
                    }
                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("product/variety_index/" . $product_id, "location", 301);
                } else {
                    $this->response->set_message($result[1], ResponseMessage::ERROR);
                    redirect("product/add_variety_index", "location", 301);
                }
            } else {

                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("product/add_variety_index", "location", 301);
            }
        }
    }
    function update_variety_index($variety_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $variety_object = $this->variety->get_by_id($variety_id);


        if (isset($variety_object)) {

            $measure = $this->variety->get_by_measure_id($variety_object->variety_id);


            $data['variety_object'] = $variety_object;
            $data['measure'] = $measure;

            $this->load_view_admin_g('product/update_variety', $data);
        } else {
            show_404();
        }
    }
    public function update_variety()
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $name = $this->input->post('name');
        $variety_id = $this->input->post('variety_id');
        $measure  = $this->input->post('medida');
        $descripcion = $this->input->post('descripcion');
        $variety_object = $this->variety->get_by_id($variety_id);

        //establecer reglas de validacion
        $this->form_validation->set_rules('name', translate('nombre_lang'), 'required');

        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("product/update_variety_index/" . $variety_id);
        } else {

            //en caso de que todo este bien
            $name_file = $_FILES['archivo']['name'];

            $separado = explode('.', $name_file);
            $ext = end($separado); // me quedo con la extension
            $allow_extension_array = ["JPEG", "JPG", "jpg", "jpeg", "png", "bmp", "gif"];
            $allow_extension = in_array($ext, $allow_extension_array);
            if ($allow_extension || $_FILES['archivo']['error'] == 4) {

                if ($_FILES['archivo']['error'] == 4) {
                    $data = ['name' => $name, 'description' => $descripcion];

                    $this->variety->update($variety_id, $data);
                    $this->variety->delete_product_measue($variety_id);

                    for ($i = 0; $i < sizeof($measure); $i++) {

                        $data_measure = [
                            'variety_id	' => $variety_id,
                            'measure' => $measure[$i]
                        ];

                        $this->variety->create_variety_mesure($data_measure);
                    }

                    $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                    redirect("product/variety_index/" . $variety_object->product_id, "location", 301);
                } else {

                    $result = save_image_from_post('archivo', './uploads/variety', time(), 253, 300);
                    if ($result[0]) {
                        if (file_exists($variety_object->phoyo))
                            unlink($variety_object->phoyo);
                        $data = ['name' => $name, 'photo' => $result[1], 'description' => $descripcion];

                        $this->variety->update($variety_id, $data);
                        $this->variety->delete_variety_measue($variety_id);

                        for ($i = 0; $i < sizeof($measure); $i++) {

                            $data_measure = [
                                'variety_id	' => $variety_id,
                                'measure' => $measure[$i]
                            ];

                            $this->variety->create_variety_mesure($data_measure);
                        }
                        $this->response->set_message(translate("data_saved_ok"), ResponseMessage::SUCCESS);
                        redirect("product/variety_index/" . $variety_object->product_id, "location", 301);
                    } else {
                        $this->response->set_message($result[1], ResponseMessage::ERROR);
                        redirect("client/add_variety_index", "location", 301);
                    }
                }
            } else {
                $this->response->set_message(translate("not_allow_extension"), ResponseMessage::ERROR);
                redirect("client/update_variety_index/" . $variety_id, "location", 301);
            }
        } //cierra la validacion
    }

    public function delete_variety($variety_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $variety_object = $this->variety->get_by_id($variety_id);

        if (isset($variety_object)) {
            unlink($variety_object->photo);
            $this->variety->delete($variety_id);

            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("product/variety_index/" . $variety_object->product_id);
        } else {
            show_404();
        }
    }

    public function change($product_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $product_object = $this->product->get_by_id($product_id);

        if ($product_object) {
            if ($product_object->status == 1)
                $this->product->update($product_id, ['status' => 0]);
            if ($product_object->status == 0)
                $this->product->update($product_id, ['status' => 1]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("product/index");
        } else {
            show_404();
        }
    }

    public function change_variety($variety_id = 0)
    {
        if (!in_array($this->session->userdata('role_id'), [1, 2, 4])) {
            $this->log_out();
            redirect('login/index');
        }

        $variety_object = $this->variety->get_by_id($variety_id);

        if ($variety_object) {
            if ($variety_object->status == 1)
                $this->variety->update($variety_id, ['status' => 0]);
            if ($variety_object->status == 0)
                $this->variety->update($variety_id, ['status' => 1]);
            $this->response->set_message(translate('data_changed_ok'), ResponseMessage::SUCCESS);
            redirect("product/variety_index/" . $variety_object->product_id, "location", 301);
        } else {
            show_404();
        }
    }

    public function search_product()
    {

        $name = $this->input->post('name');
        $result = $this->product->search_by_name($name, false);

        echo json_encode($result);
        exit();
    }

    public function get_by_id_producto()
    {

        $id = $this->input->post('id');
        $result = $this->product->get_by_id($id);

        echo json_encode($result);
        exit();
    }
}
