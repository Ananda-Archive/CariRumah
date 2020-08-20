<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class About extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model("M_About");
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == "OPTIONS") {
        die();
        }
    }

    // public function index_post() {
    //     $name = $this->post('name');
    //     $address = $this->post('address');
    //     $city = $this->post('city');
    //     $education = $this->post('education');
    //     $email = $this->post('email');
    //     $phoneNumber = $this->post('phoneNumber');
    //     $status = $this->post('status');

    //     if(
    //         !isset($name) ||
    //         !isset($address) ||
    //         !isset($city) ||
    //         !isset($education) ||
    //         !isset($email) ||
    //         !isset($phoneNumber) ||
    //         !isset($status)
    //     ) {
    //         $required_parameter = [];
    //         if(!isset($name)) array_push($required_parameter, 'name');
    //         if(!isset($address)) array_push($required_parameter, 'address');
    //         if(!isset($city)) array_push($required_parameter, 'city');
    //         if(!isset($education)) array_push($required_parameter, 'education');
    //         if(!isset($email)) array_push($required_parameter, 'email');
    //         if(!isset($phoneNumber)) array_push($required_parameter, 'phoneNumber');
    //         if(!isset($status)) array_push($required_parameter, 'status');
    //         $this->response(
    //             array(
    //                 'status' => FALSE,
    //                 'message' => $this::REQUIRED_PARAMETER_MESSAGE . implode(', ', $required_parameter)
    //             ),
    //             REST_Controller::HTTP_BAD_REQUEST
    //         ); return;
    //     }

    //     // Create
    //     if($this->M_About->create($name, $address, $city, $education, $email, $phoneNumber, $status)) {
    //         // Status Message
    //         $this->response(
    //             array(
    //                 'status' => TRUE,
    //                 'message' => $this::INSERT_SUCCESS_MESSSAGE
    //             ),
    //             REST_Controller::HTTP_CREATED
    //         );
    //     } else {
    //         $this->response(
    //             array(
    //                 'status' => FALSE,
    //                 'message' => $this::INSERT_FAILED_MESSAGE
    //             ),
    //             REST_Controller::HTTP_INTERNAL_SERVER_ERROR
    //         );
    //     }
    // }


    public function index_get() {
        $command = $this->get('command');
        switch($command) {
            // Get All Data without any condition
            default:
                $index = 0;
                $result = $this->M_About->get_all();
                $this->response($result,REST_Controller::HTTP_OK);
        }
    }

    public function index_put() {
        $id = $this->put('id');
        $about = $this->put('about');
        $phone = $this->put('phone');

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
        if($this->M_About->is_not_exists($id)){
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
        if(isset($about)) { $datas = array_merge($datas, array('about' => $about));}
        if(isset($phone)) { $datas = array_merge($datas, array('phone' => $phone));}
        
        if($this->M_About->update($id, $datas)) {
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
                    'message' => $this::UPDATE_FAILED_MESSAGE
                ),
                REST_Controller::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }

    // public  function index_delete() {
    //     $id = $this->input->get('id');
        
    //     if (!isset($id)) {
    //         $this->response(
    //             array(
    //                 'status' => FALSE,
    //                 'message' => $this::REQUIRED_PARAMETER_MESSAGE. "id"
    //             ),
    //             REST_Controller::HTTP_BAD_REQUEST
    //         );
    //         return;
    //     }

    //     if ($this->M_Products->is_not_exists($id)) {
    //         $this->response(
    //             array(
    //                 'status' => FALSE,
    //                 'message' => $this::INVALID_ID_MESSAGE . " id does not exist"
    //             ),
    //             REST_Controller::HTTP_BAD_REQUEST
    //         );
    //         return;
    //     }

    //     if ($this->M_About->delete($id)) {
    //         $this->response(
    //             array(
    //                 'status' => TRUE,
    //                 'message' => $this::DELETE_SUCCESS_MESSSAGE
    //             ),
    //             REST_Controller::HTTP_OK
    //         );
    //     } else {
    //         $this->response(
    //             array(
    //                 'status' => FALSE,
    //                 'message' => $this::DELETE_FAILED_MESSAGE

    //             ),
    //             REST_Controller::HTTP_INTERNAL_SERVER_ERROR
    //         );
    //     }
    // }

}
