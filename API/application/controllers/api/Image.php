<?php

defined('BASEPATH');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Image extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model("M_Products");
        $this->load->model("M_Products_Image");
        $this->load->helper('url', 'form'); 
        $this->load->library('form_validation');    
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // $method = $_SERVER['REQUEST_METHOD'];
        // if($method == "OPTIONS") {
        // die();
        }
    }

    public function index_post() {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 5000;  
        $config['overwrite'] = TRUE;
        $config['encrypt_name'] = TRUE;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('image')){
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => "FAILED TO UPLOAD IMAGE"

                ),
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        } else {
            $uploadData = $this->upload->data();
            $this->response(
                array(
                    'status' => TRUE,
                    'message' => base_url() . 'uploads/' . $uploadData['file_name']
                ),
                REST_Controller::HTTP_OK
            );
        }
    }

}
