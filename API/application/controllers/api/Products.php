<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Products extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model("M_Products");
        $this->load->model("M_Products_Image");
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
        die();
        }
    }

    public function index_post() {
        $name = $this->post('name');
        $price = $this->post('price');
        $location = $this->post('location');
        $facility = $this->post('facility');
        $document = $this->post('document');
        $lt = $this->post('lt');
        $lb = $this->post('lb');
        $images = $this->post('images');

        if(
            !isset($name) || !isset($price) || !isset($location) || !isset($facility) || !isset($document) || !isset($images) || !isset($lt) || !isset($lb)
        ) {
            $required_parameter = [];
            if(!isset($name)) array_push($required_parameter, 'name');
            if(!isset($price)) array_push($required_parameter, 'price');
            if(!isset($location)) array_push($required_parameter, 'location');
            if(!isset($facility)) array_push($required_parameter, 'facility');
            if(!isset($document)) array_push($required_parameter, 'document');
            if(!isset($images)) array_push($required_parameter, 'images');
            if(!isset($lt)) array_push($required_parameter, 'lt');
            if(!isset($lb)) array_push($required_parameter, 'lb');
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE . implode(', ', $required_parameter)
                ),
                REST_Controller::HTTP_BAD_REQUEST
            ); return;
        }

        // Create
        if($id = $this->M_Products->create($name,$price,$location,$facility,$document,$lt,$lb)) {
            // Create row in image
            if($this->M_Products_Image->create($id,$images)) {
                // Status Message
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
                $index = 0;
                $result = $this->M_Products->get_all();
                foreach ($result as $row) {
                    $img = $this->M_Products_Image->get_by_id($row['id']);
                    $temp = array_merge($result[$index], array('images' => $img));
                    $result[$index] = $temp;
                    $index++;
                }
                $this->response($result,REST_Controller::HTTP_OK);
        }
    }

    public function index_put() {
        $id = $this->put('id');
        $name = $this->put('name');
        $price = $this->put('price');
        $location = $this->put('location');
        $facility = $this->put('facility');
        $document = $this->put('document');
        $lt = $this->put('lt');
        $lb = $this->put('lb');
        $images = $this->put('images');
        $status = $this->put('status');

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
        if($this->M_Products->is_not_exists($id)){
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
        if(isset($price)) {
            $datas = array_merge($datas, array('price' => $price));
        }
        if(isset($location)) {
            $datas = array_merge($datas, array('location' => $location));
        }
        if(isset($facility)) {
            $datas = array_merge($datas, array('facility' => $facility));
        }
        if(isset($document)) {
            $datas = array_merge($datas, array('document' => $document));
        }
        if(isset($lt)) {
            $datas = array_merge($datas, array('lt' => $lt));
        }
        if(isset($lb)) {
            $datas = array_merge($datas, array('lb' => $lb));
        }
        if(isset($status)) {
            $datas = array_merge($datas, array('status' => $status));
        }

        if($this->M_Products->update($id, $datas)) {
            if(isset($images)) {
                if($this->M_Products_Image->update($id,$images)) {
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
                            'message' => 'test1'
                        ),
                        REST_Controller::HTTP_BAD_REQUEST
                    );
                }
            } else {
                $this->response(
                    array(
                        'status' => TRUE,
                        'message' => $this::UPDATE_SUCCESS_MESSSAGE
    
                    ),
                    REST_Controller::HTTP_OK
                );
            }
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

        if ($this->M_Products->is_not_exists($id)) {
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::INVALID_ID_MESSAGE . " id does not exist"
                ),
                REST_Controller::HTTP_BAD_REQUEST
            );
            return;
        }

        if ($this->M_Products->delete($id)) {
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
