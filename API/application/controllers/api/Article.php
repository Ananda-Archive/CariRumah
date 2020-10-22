<?php

defined('BASEPATH');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Article extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model("M_Article");
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // $method = $_SERVER['REQUEST_METHOD'];
        // if($method == "OPTIONS") {
        // die();
        }
    }

    public function index_post() {
        $title = $this->post('title');
        $content = $this->post('content');
        $image = $this->post('image');

        if(!isset($title) || !isset($content)) {
            $required_parameter = [];
            if(!isset($title)) array_push($required_parameter, 'title');
            if(!isset($content)) array_push($required_parameter, 'content');
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE . implode(', ', $required_parameter)
                ),
                REST_Controller::HTTP_BAD_REQUEST
            ); return;
        }

        // Create
        if($id = $this->M_Article->create($title,$content,$image)) {
            $this->response(
                array(
                    'status' => TRUE,
                    'message' => $this::INSERT_SUCCESS_MESSSAGE
                ),
                REST_Controller::HTTP_CREATED
            );
        } else {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::INSERT_FAILED_MESSAGE
                ),
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }


    public function index_get() {
        $command = $this->get('command');
        switch($command) {
            // Get All Products without any condition
            default:
                $this->response($this->M_Article->get_all(),REST_Controller::HTTP_OK);
        }
    }

    public function index_put() {
        $id = $this->put('id');
        $title = $this->put('title');
        $content = $this->put('content');
        $image = $this->put('image');

        $datas = array();

        if(!isset($id)){
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE." id"
                ),
                REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }
        if($this->M_Article->is_not_exists($id)){
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::INVALID_ID_MESSAGE. " id does not exist"
                ),
                REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }

        $datas = array_merge($datas, array('id' => $id));
        if(isset($title)) {
            $datas = array_merge($datas, array('title' => $title));
        }
        if(isset($content)) {
            $datas = array_merge($datas, array('content' => $content));
        }
        if(isset($image)) {
            $datas = array_merge($datas, array('image' => $image));
        }
        if($this->M_Article->update($id, $datas)) {
            $this->response(
                array(
                    'status' => TRUE,
                    'message' => $this::UPDATE_SUCCESS_MESSSAGE

                ),
                REST_Controller::HTTP_OK
            );
        } else {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => 'test2'
                ),
                REST_Controller::HTTP_BAD_REQUEST
            );
        }
    }

    public  function index_delete() {
        $id = $this->input->get('id');
        
        if (!isset($id)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE. "id"
                ),
                REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }

        if ($this->M_Article->is_not_exists($id)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::INVALID_ID_MESSAGE . " id does not exist"
                ),
                REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }

        if ($this->M_Article->delete($id)) {
            $this->response(
                array(
                    'status' => TRUE,
                    'message' => $this::DELETE_SUCCESS_MESSSAGE
                ),
                REST_Controller::HTTP_OK
            );
        } else {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::DELETE_FAILED_MESSAGE

                ),
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

}
