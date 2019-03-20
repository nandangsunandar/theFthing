<?php

defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/REST_Controller.php';
use Restserver\Libraries\REST_Controller;

class Customer extends REST_Controller {

    function __construct($config = 'rest') {
        parent::__construct($config);
        $this->load->database();
    }

    function index_get() {
        $id = $this->get('Id_customer');
        if ($id == '') {
            $kontak = $this->db->get('customer')->result();
        } else {
            $this->db->where('Id_customer', $id);
            $kontak = $this->db->get('customer')->result();
        }
        $this->response($kontak, 200);
    }

    function index_post() {
        $id = $this->post('Id_customer');
        $proses = $this->post('proses');
        $data = array(
                    'name'      => $this->post('name'),
                    'email'     => $this->post('email'),
                    'Password'  => $this->post('Password'),
                    'is_married'  => $this->post('is_married'),
                    'gender'  => $this->post('gender'),
                    'address'  => $this->post('address')
                );
        if($proses==1){
            if($id){

                $this->db->where('Id_customer', $id);
                $insert = $this->db->update('customer', $data);
            }else{
            $insert = $this->db->insert('customer', $data);
            }
        }else{
            $this->db->where('Id_customer', $id);
            $delete = $this->db->delete('customer');
        }
        if ($insert) {
            $this->response($data, 200);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

    function index_put() {
        $id = $this->put('Id_customer');
        $data = array(
            'name'      => $this->post('name'),
            'email'     => $this->post('email'),
            'Password'  => $this->post('Password'),
            'is_married'  => $this->post('is_married'),
            'gender'  => $this->post('gender'),
            'address'  => $this->post('address')
        );
        $this->db->where('Id_customer', $id);
        $update = $this->db->update('customer', $data);
     
            $this->response($data, 200);
    
    }

    function index_delete() {
        $id = $this->post('Id_customer');
        $this->db->where('Id_customer', $id);
        $delete = $this->db->delete('customer');
        if ($delete) {
            $this->response(array('status' => 'success'), 201);
        } else {
            $this->response(array('status' => 'fail', 502));
        }
    }

}
?>