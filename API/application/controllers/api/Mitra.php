<?php

defined('BASEPATH');

require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class Mitra extends REST_Controller {

    function __construct(){
        parent::__construct();
        $this->load->model("M_Mitra");
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
        // $method = $_SERVER['REQUEST_METHOD'];
        // if($method == "OPTIONS") {
        // die();
        // }
    }

    public function index_post() {
        $propertyName = $this->post('propertyName');
        $propertyAddress = $this->post('propertyAddress');
        $propertylt = $this->post('propertylt');
        $propertylb = $this->post('propertylb');
        $propertyBedroom = $this->post('propertyBedroom');
        $propertyBathroom = $this->post('propertyBathroom');
        $propertyElectricity = $this->post('propertyElectricity');
        $propertyFacility = $this->post('propertyFacility');
        $propertyLetterStatus = $this->post('propertyLetterStatus');
        $propertyTypePrice = $this->post('propertyTypePrice');
        $ownerName = $this->post('ownerName');
        $ownerAddress = $this->post('ownerAddress');
        $ownerPhone = $this->post('ownerPhone');
        $ownerEmail = $this->post('ownerEmail');
        $ownerLetter = $this->post('ownerLetter');
        $ownerCommission = $this->post('ownerCommission');
        $status = $this->post('status');

        if(
            !isset($propertyName) ||
            !isset($propertyAddress) ||
            !isset($propertylt) ||
            !isset($propertylb) ||
            !isset($propertyBedroom) ||
            !isset($propertyBathroom) ||
            !isset($propertyElectricity) ||
            !isset($propertyFacility) ||
            !isset($propertyLetterStatus) ||
            !isset($propertyTypePrice) ||
            !isset($ownerName) ||
            !isset($ownerAddress) ||
            !isset($ownerPhone) ||
            !isset($ownerEmail) ||
            !isset($ownerLetter) ||
            !isset($ownerCommission)
        ) {
            $required_parameter = [];
            if(!isset($propertyName)) array_push($required_parameter, 'propertyName');
            if(!isset($propertyAddress)) array_push($required_parameter, 'propertyAddress');
            if(!isset($propertylt)) array_push($required_parameter, 'propertylt');
            if(!isset($propertylb)) array_push($required_parameter, 'propertylb');
            if(!isset($propertyBedroom)) array_push($required_parameter, 'propertyBedroom');
            if(!isset($propertyBathroom)) array_push($required_parameter, 'propertyBathroom');
            if(!isset($propertyElectricity)) array_push($required_parameter, 'propertyElectricity');
            if(!isset($propertyFacility)) array_push($required_parameter, 'propertyFacility');
            if(!isset($propertyLetterStatus)) array_push($required_parameter, 'propertyLetterStatus');
            if(!isset($propertyTypePrice)) array_push($required_parameter, 'propertyTypePrice');
            if(!isset($ownerName)) array_push($required_parameter, 'ownerName');
            if(!isset($ownerAddress)) array_push($required_parameter, 'ownerAddress');
            if(!isset($ownerPhone)) array_push($required_parameter, 'ownerPhone');
            if(!isset($ownerEmail)) array_push($required_parameter, 'ownerEmail');
            if(!isset($ownerLetter)) array_push($required_parameter, 'ownerLetter');
            if(!isset($ownerCommission)) array_push($required_parameter, 'ownerCommission');
            $this->response(
                array(
                    'status' => FALSE,
                    'message' => $this::REQUIRED_PARAMETER_MESSAGE . implode(', ', $required_parameter)
                ),
                REST_Controller::HTTP_BAD_REQUEST
            ); return;
        }

        // Create
        if($this->M_Mitra->create($propertyName, $propertyAddress, $propertylt, $propertylb, $propertyBedroom, $propertyBathroom, $propertyElectricity, $propertyFacility, $propertyLetterStatus, $propertyTypePrice, $ownerName, $ownerAddress, $ownerPhone, $ownerEmail, $ownerLetter, $ownerCommission, $status)) {
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
    }


    public function index_get() {
        $command = $this->get('command');
        switch($command) {
            // Get All Data without any condition
            default:
                $result = $this->M_Mitra->get_all();
                $this->response($result,REST_Controller::HTTP_OK);
        }
    }

    public function index_put() {
        $id = $this->put('id');
        $propertyName = $this->put('propertyName');
        $propertyAddress = $this->put('propertyAddress');
        $propertylt = $this->put('propertylt');
        $propertylb = $this->put('propertylb');
        $propertyBedroom = $this->put('propertyBedroom');
        $propertyBathroom = $this->put('propertyBathroom');
        $propertyElectricity = $this->put('propertyElectricity');
        $propertyFacility = $this->put('propertyFacility');
        $propertyLetterStatus = $this->put('propertyLetterStatus');
        $propertyTypePrice = $this->put('propertyTypePrice');
        $ownerName = $this->put('ownerName');
        $ownerAddress = $this->put('ownerAddress');
        $ownerPhone = $this->put('ownerPhone');
        $ownerEmail = $this->put('ownerEmail');
        $ownerLetter = $this->put('ownerLetter');
        $ownerCommission = $this->put('ownerCommission');
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
        if($this->M_Mitra->is_not_exists($id)){
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
        if(isset($propertyName)) { $datas = array_merge($datas, array('propertyName' => $propertyName));}
        if(isset($propertyAddress)) { $datas = array_merge($datas, array('propertyAddress' => $propertyAddress));}
        if(isset($propertylt)) { $datas = array_merge($datas, array('propertylt' => $propertylt));}
        if(isset($propertylb)) { $datas = array_merge($datas, array('propertylb' => $propertylb));}
        if(isset($propertyBedroom)) { $datas = array_merge($datas, array('propertyBedroom' => $propertyBedroom));}
        if(isset($propertyBathroom)) { $datas = array_merge($datas, array('propertyBathroom' => $propertyBathroom));}
        if(isset($propertyElectricity)) { $datas = array_merge($datas, array('propertyElectricity' => $propertyElectricity));}
        if(isset($propertyFacility)) { $datas = array_merge($datas, array('propertyFacility' => $propertyFacility));}
        if(isset($propertyLetterStatus)) { $datas = array_merge($datas, array('propertyLetterStatus' => $propertyLetterStatus));}
        if(isset($propertyTypePrice)) { $datas = array_merge($datas, array('propertyTypePrice' => $propertyTypePrice));}
        if(isset($ownerName)) { $datas = array_merge($datas, array('ownerName' => $ownerName));}
        if(isset($ownerAddress)) { $datas = array_merge($datas, array('ownerAddress' => $ownerAddress));}
        if(isset($ownerPhone)) { $datas = array_merge($datas, array('ownerPhone' => $ownerPhone));}
        if(isset($ownerEmail)) { $datas = array_merge($datas, array('ownerEmail' => $ownerEmail));}
        if(isset($ownerLetter)) { $datas = array_merge($datas, array('ownerLetter' => $ownerLetter));}
        if(isset($ownerCommission)) { $datas = array_merge($datas, array('ownerCommission' => $ownerCommission));}
        if(isset($status)) { $datas = array_merge($datas, array('status' => $status));}
        
        if($this->M_Mitra->update($id, $datas)) {
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

        if ($this->M_Mitra->delete($id)) {
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
