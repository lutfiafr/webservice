<?php
defined('BASEPATH') OR exite('No direct script access allowed');

require APPATH . '/libraries/REST_Controller.php';
ise Restserver\Libraries\REST_Controller;

class Customers extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
    }

    //menampilkan data
    public function index_get() {

        $id = $this->get('id');
        if ($id == '') {
            $data = $this->db->get->('customers')->result();
        }else {
            $this->db->where('CustomerID', $id);
            $data = $this->db->get('customers')->result();
        }
        $result = ["took"=>$_SERVER["REQUEST_TIME_FLOAT"],
                    "code"=>200,
                    "message"=>"response successfully",
                    "data"=>$data];
        $this->response($result, 200);
    }

    //menambah data
    public function index_post() {
        $data = array(
            'CustomerID' => $this->post('CustomerID'),
            'CompanyName' => $this->post('CompanyName'),
            'ContactTitle' => $this->post('ContactTitle'),
            'Address' => $this->post('Address'),
            'City' => $this->post('City'),
            'Region' => $this->post('Region'),
            'PostalCode' => $this->post('PostalCode'),
            'Country' => $this->post('Country'),
            'Phone' => $this->post('Phone'),
            'Fax' => $this->post('Fax'));
        $insert = $this->db->insert('customers', $data);
        if ($insert) {
            //$this->response($data, 200);
            $result = ["took"=>$_SERVER["REQUEST_TIME_FLOAT"],
                    "code"=>201,
                    "message"=>"data has successfully added",
                    "data"=>$data];
            $this->response($result, 201);
        }else{
            $result = ["took"=>$_SERVER["REQUEST_TIME_FLOAT"],
                    "code"=>502,
                    "message"=>"failed adding data",
                    "data"=>null];
            $this->response($result, 502);
        }
    }

    //memperbarui data yang telah ada
    public function index_put() {
        $id = $this->put('id');
        $data = array(
            'CustomerID' => $this->post('CustomerID'),
            'CompanyName' => $this->post('CompanyName'),
            'ContactTitle' => $this->post('ContactTitle'),
            'Address' => $this->post('Address'),
            'City' => $this->post('City'),
            'Region' => $this->post('Region'),
            'PostalCode' => $this->post('PostalCode'),
            'Country' => $this->post('Country'),
            'Phone' => $this->post('Phone'),
            'Fax' => $this->post('Fax'));
        $this->db->where('CustomerID', $id);
        $update = $this->db->update('customers', $data);
        if ($update) {
            $this->response($data, 200);
        }else{
            $this->response(array('status' => 'fail', 502));
        }
    }

    //menghapus data customers
    public function_delete() {
        $id = $this->delete('id');
        $this->db->where('CustomerID', $id);
        $delete = $this->db->delete('customers');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        }else{
            $this->response(array('status' => 'fail'), 502);
        }
    }
}
?>