<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	require APPPATH . 'libraries/REST_Controller.php';

	class User extends REST_Controller{
		function __construct(){
			parent::__construct();
			$this->load->model('user_models');
		}

		function index_post(){
			$username = $this->post('username');
			$password = $this->post('password');
			$data = $this->user_models->login($username, $password);

			if(empty($data)){
				$output = array(
					'success' => false,
					'message' => 'Login failed, Please check your username/password',
					'data' => null
				);
				$this->response($output, REST_Controller::HTTP_OK);
				$this->output->_display();
				exit();
			} else {
				$result = $data;
				$output = array(
					'success' => true,
					'message' => 'Login success',
					'data' => $data
				);
				$this->response($output, REST_Controller::HTTP_OK);
			}
			
		}

		public function index_put()
{
    $username = $this->put('username'); // Mengambil input username dari request PUT
    $new_password = $this->put('new_password'); // Mengambil input password dari request PUT

    // Validasi input
    if (empty($username) || empty($new_password)) {
        $response = [
            'status' => false,
            'message' => 'Username dan password baru harus diisi.'
        ];
        $this->response($response, REST_Controller::HTTP_BAD_REQUEST);
        return;
    }



    $update = $this->user_models->update_password($username, $new_password);

    if ($update) {
        $response = [
            'status' => true,
            'message' => 'Password berhasil diperbarui.'
        ];
        $this->response($response, REST_Controller::HTTP_OK);
    } else {
        $response = [
            'status' => false,
            'message' => 'Gagal memperbarui password. Pastikan username benar.'
        ];
        $this->response($response, REST_Controller::HTTP_NOT_FOUND);
    }
}


	}

?>
