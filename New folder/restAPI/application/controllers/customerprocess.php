<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customerprocess extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */

		public function __construct()
			{
				parent::__construct();
                $this->load->helper('url');
                $this->load->database();
                $this->load->model('Customerprocess_model');
			}
			
		public function add()
		{
            $data = array(
                'name'      => $this->post('name'),
                'email'     => $this->post('email'),
                'Password'  => $this->post('Password'),
                'is_married'  => $this->post('is_married'),
                'gender'  => $this->post('gender'),
                'address'  => $this->post('address')
            );
			$insert = $this->Customerprocess_model->add($data);
			echo json_encode(array("status" => TRUE));
		}

	public function delete($iddata)
	{
		$this->Customerprocess_model->delete($iddata);
		echo json_encode(array("status" => TRUE));
	}


		public function edit($id)
		{
			$data = $this->Customerprocess_model->get_by_id($id);
			echo json_encode($data);
		}




public function update()
	{
        $data = array(
            'name'      => $this->post('name'),
            'email'     => $this->post('email'),
            'Password'  => $this->post('Password'),
            'is_married'  => $this->post('is_married'),
            'gender'  => $this->post('gender'),
            'address'  => $this->post('address')
        );
		$this->Customerprocess_model->update(array('Id_customer' => $this->input->post('Id_customer')), $data);
		echo json_encode(array("status" => TRUE));
	}

}
