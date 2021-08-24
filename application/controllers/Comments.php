<?php

class Comments extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('Comments_model', 'comment');
        $this->load->library(array('session'));
        $this->load->helper("mabuya");

        @session_start();
        $this->load_language();
        $this->init_form_validation();
    }

    public function index()
    {
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }
        $this->load->model("user_model", "user");
        $this->load->model("evento_model", "evento");
        $all_comments = $this->comment->get_all();
        
        foreach ($all_comments as $item)
        {
            $item->user_object = $this->user->get_by_id($item->user_id);
            $item->evento_object = $this->evento->get_by_id($item->evento_id);
        }
        
        $data['all_comments'] = $all_comments;
        $this->load_view_admin_g("comments/index",$data);
    }



    public function add($evento_id){
        //$user_id = $this->session->userdata('user_id');
        //var_dump($this->session->userdata('user_id'));
        //exit();
        if(!$this->session->userdata('user_id')){
            $this->log_out();
            redirect('front/evento/'.$evento_id);
        }

        $user_id = $this->session->userdata('user_id');
        $comment = $this->input->post('comment');
        $date = date('Y-m-d');
        //establecer reglas de validacion

        $this->form_validation->set_rules('comment', translate('comment_lang'), 'required');


        if ($this->form_validation->run() == FALSE){ //si alguna de las reglas de validacion fallaron
            $this->response->set_message(validation_errors(), ResponseMessage::ERROR);
            redirect("front/evento/".$evento_id);

        }else{ //en caso de que todo este bien
            $data = [
                'user_id'=>$user_id,
                'evento_id'=>$evento_id,
                'comment'=>$comment,
                'date'=>$date
            ];

            $this->comment->create($data);
            $this->response->set_message(translate('data_saved_ok'), ResponseMessage::SUCCESS);
            redirect("front/evento/".$evento_id);

        }
    }





    public function delete($comment_id = 0){
        if(!in_array($this->session->userdata('rol_id'),[1])){
            $this->log_out();
            redirect('login/index');
        }

        $comment_object = $this->comment->get_by_id($comment_id);

        if($comment_object){
            //$evento_id = $comment_object->evento_id;
            $this->comment->delete($comment_id);
            $this->response->set_message(translate('data_deleted_ok'), ResponseMessage::SUCCESS);
            redirect("comments/index");
        }else{
            show_404();
        }
    }
    public function change($comment_id = 0)
        {
            if (!in_array($this->session->userdata('rol_id'), [1])) {
                $this->log_out();
                redirect('login/index');
            }

            $comment_object = $this->comment->get_by_id($comment_id);

            if ($comment_object) {
                if($comment_object->state == 1)
                    $this->comment->update($comment_id, ['state' => 0]);
                else
                    $this->comment->update($comment_id, ['state' => 1]);

                $this->response->set_message('El comentario ha sido guardado correctamente, un moderador', ResponseMessage::SUCCESS);
                redirect("comments/index");
            } else {
                show_404();
            }
        }







}
