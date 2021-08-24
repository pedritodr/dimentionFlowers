<?php

class Front extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        //$this->load->model('User_model', 'user');
        $this->load->library(array('session'));
        // Load the library
        $this->load->library('recaptcha');

        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {
        $this->load->model('banner_model', 'banner');
        $this->load->model('Gallery_model', 'gallery');
        $this->load->model('Sobre_nosotros_model', 'nosotros');
        $data['all_banners'] = $this->banner->get_all(['is_active' => 1]);
        $data['gallery'] = $this->gallery->get_all();
        $data['nosotros'] = $this->nosotros->get_all(['is_active' => 1]);
        $this->load_view_front('front/index', $data);
    }

    public function shop()
    {
        
        $this->load->model('banner_model', 'banner');
        $this->load->model('Gallery_model', 'gallery');
        $this->load->model('Sobre_nosotros_model', 'nosotros');
        $this->load->model('Product_category_model', 'cat');
        $this->load->model('Product_model', "product");
        $data['all_banners'] = $this->banner->get_all(['is_active' => 1]);
        $data['gallery'] = $this->gallery->get_all();
        $data['nosotros'] = $this->nosotros->get_all(['is_active' => 1]);
        $data['categorias'] = $cat = $this->cat->get_all2();
        $count = 0;
        $subcat[] = "";
        $this->load->library('pagination');
        
     //   echo $this->pagination->create_links();

        /* Obtiene el numero de registros a mostrar por pagina */

        $config['per_page'] = '12';
        $config['uri_segment'] = 2;

        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('galery/');
        $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1], null, null);

    
        if(isset($_GET["cat"]))
            {
            $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1, "product_category_id" => $_GET["cat"]], null, null);
            $config['total_rows'] = count($p);
            $config['base_url'] = site_url('galery?cat='.$_GET["cat"]);
            }
        elseif(isset($_GET["cat"]) and isset($_GET["per_page"]))
            {
                $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1, "product_category_id" => $_GET["cat"]], null, null);

                $config['base_url'] = site_url('galery?per_page='.$_GET["per_page"].'&cat='.$_GET["cat"]);
            }
        elseif(isset($_GET["name"]))
            {
                $data["productos"] = $p = $this->product->get_all2(["status"=>1, "name" => $_GET["name"]], null, null);
                $config['total_rows'] = count($p);
                $config['base_url'] = site_url('galery?name='.$_GET["name"]);
            }
        elseif(isset($_GET["cat"]) and isset($_GET["per_page"]) and isset($_GET["name"]))
            {
                $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1, "product_category_id" => $_GET["cat"]], null, null);

                $config['base_url'] = site_url('galery?name='.$_GET["name"].'&per_page='.$_GET["per_page"]);
            }
        elseif(isset($_GET["subcat"]))
        {
        $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1, "subcat_id" => $_GET["subcat"]], null, null);
        $config['total_rows'] = count($p);
        $config['base_url'] = site_url('galery?subcat='.$_GET["subcat"]);
        }
       
        else{
            $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1], null, null);
            $config['total_rows'] = count($p);

            $config['base_url'] = site_url('galery');
        }
    
        
        /*Obtiene el total de registros a paginar */

    
        /*Se personaliza la paginación para que se adapte a bootstrap*/
        $config['page_query_string'] = TRUE;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['last_link'] = FALSE;

        $config['first_link'] = FALSE;

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';


        /* Se inicializa la paginacion*/

        $this->pagination->initialize($config);
        $page = $this->uri->segment(2);
            $perpage = @$_GET["per_page"];
            if($perpage =="")
                $perpage = 0;
        $offset = !$page ? 0 : $page;
        if(isset($_GET["cat"]))
            {
                $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1, "product_category_id" => $_GET["cat"]], 12, $perpage);

            }
        elseif(isset($_GET["subcat"]))
            {
                $data["productos"] = $p = $this->product->get_all2(["status"=>1,"visible"=> 1, "subcat_id" => $_GET["subcat"]], 12, $perpage);
            }
        elseif(isset($_GET["name"]))
            {
                $data["productos"] = $p = $this->product->get_all2_like(["status"=>1, "visible"=> 1, "name" => $_GET["name"]], 12, $perpage, $_GET['name']);
            }
        else{
            $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1],  12, $perpage);
            }
        $data["productos"] = $p;

        foreach($cat as $item)
            {
                $count ++;
                if($this->cat->get_subcat_idcat3($item->product_category_id))
                $subcat[$count] = $this->cat->get_subcat_idcat($item->product_category_id);
                else
                $subcat[$count] = "";
            }
           // die(var_dump($subcat));
            $data["subcat"] = $subcat;
         //   die(var_dump($subcat[1]));
           // die(var_dump($subcat[1][0]->idsub));
        $this->load_view_front('front/shop', $data);
    }

    public function categorias_variante()
    {
        
        $this->load->model('banner_model', 'banner');
        $this->load->model('Gallery_model', 'gallery');
        $this->load->model('Sobre_nosotros_model', 'nosotros');
        $this->load->model('Product_category_model', 'cat');
        $this->load->model('Product_model', "product");
        $data['all_banners'] = $this->banner->get_all(['is_active' => 1]);
        $data['gallery'] = $this->gallery->get_all();
        $data['nosotros'] = $this->nosotros->get_all(['is_active' => 1]);
        $data['categorias'] = $cat = $this->cat->get_all2();
        $count = 0;
        $subcat[] = "";
        $this->load->library('pagination');
        
     //   echo $this->pagination->create_links();

        /* Obtiene el numero de registros a mostrar por pagina */

        $config['per_page'] = '9';
        $config['uri_segment'] = 2;

        /* URL a la que se desea agregar la paginación*/
        $config['base_url'] = site_url('galery/');
        $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1], null, null);

    
        if(isset($_GET["cat"]))
            {
            $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1, "product_category_id" => $_GET["cat"]], null, null);
            $config['total_rows'] = count($p);
            $config['base_url'] = site_url('galery?cat='.$_GET["cat"]);
            }
        
        /*Obtiene el total de registros a paginar */

        /*Se personaliza la paginación para que se adapte a bootstrap*/
        $config['page_query_string'] = TRUE;
        $config['cur_tag_open'] = '<li class="active"><a href="#">';

        $config['cur_tag_close'] = '</a></li>';

        $config['num_tag_open'] = '<li>';

        $config['num_tag_close'] = '</li>';

        $config['last_link'] = FALSE;

        $config['first_link'] = FALSE;

        $config['next_link'] = '&raquo;';

        $config['next_tag_open'] = '<li>';

        $config['next_tag_close'] = '</li>';

        $config['prev_link'] = '&laquo;';

        $config['prev_tag_open'] = '<li>';

        $config['prev_tag_close'] = '</li>';


        /* Se inicializa la paginacion*/

        $this->pagination->initialize($config);
        $page = $this->uri->segment(2);
            $perpage = @$_GET["per_page"];
            if($perpage =="")
                $perpage = 0;
        $offset = !$page ? 0 : $page;
        if(isset($_GET["cat"]))
            {
                $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1, "product_category_id" => $_GET["cat"]], 9, $perpage);

            }
        elseif(isset($_GET["subcat"]))
            {
                $data["productos"] = $p = $this->product->get_all2(["status"=>1,"visible"=> 1, "subcat_id" => $_GET["subcat"]], 9, $perpage);
            }
        elseif(isset($_GET["name"]))
            {
                $data["productos"] = $p = $this->product->get_all2_like(["status"=>1, "visible"=> 1, "name" => $_GET["name"]], 9, $perpage, $_GET['name']);
            }
        else{
            $data["productos"] = $p = $this->product->get_all2(["status"=>1, "visible"=> 1],  9, $perpage);
            }
        $data["productos"] = $p;

        foreach($cat as $item)
            {
                $count ++;
                if($this->cat->get_subcat_idcat3($item->product_category_id))
                $subcat[$count] = $this->cat->get_subcat_idcat($item->product_category_id);
                else
                $subcat[$count] = "";
            }
        $data['mostrar_cat'] = $mostrar = $this->cat->get_all_rand();
           // die(var_dump($mostrar));
           // die(var_dump($subcat));
            $data["subcat"] = $subcat;
         //   die(var_dump($subcat[1]));
           // die(var_dump($subcat[1][0]->idsub));
        $this->load_view_front('front/categorias_variantes', $data);
    }

    public function show_404()
    {

        $this->load->view("404");
    }
    public function about()
    {
        $this->load->model('Sobre_nosotros_model', 'nosotros');
        $data['nosotros'] = $this->nosotros->get_all(['is_active' => 1]);
        $this->load_view_front('front/about', $data);
    }
    public function contacto()
    {
        $this->load->model('Equipo_model', 'equipo');
        $data['equipo'] = $this->equipo->get_all(['is_active' => 1]);
        $this->load_view_front('front/contact', $data);
    }
    public function contacto_mensaje()
    {
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $mensaje_text = $this->input->post('message');
        $subject = $this->input->post('subject');

        //establecer reglas de validacion
        $this->form_validation->set_rules('name', "Nombres completos", 'required');
        $this->form_validation->set_rules('email', "Email", 'required');
        $this->form_validation->set_rules('message', "Mensaje", 'required');
        $this->form_validation->set_rules('subject', "Asunto", 'required');
        if ($this->form_validation->run() == FALSE) { //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("contact");
        } else {
            $this->load->model("Mensaje_model", "mensaje");
            $data = [
                'names' => $name,
                'email' => $email,
                'mensaje' => $mensaje_text,
                'is_active' => 1,
                'asunto' => $subject,
                'fecha_creacion' => date("Y-m-d H:i:s")
            ];
            $this->mensaje->create($data);
            $this->response->set_message("Mensaje enviado correctamente. Dimention flowers se pondrá en contacto con usted de inmediato. Muchas gracias", ResponseMessage::SUCCESS);
            redirect("contact");
        }
    }
}
