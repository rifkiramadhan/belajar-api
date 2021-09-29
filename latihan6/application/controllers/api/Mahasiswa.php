<?php

    use Restserver\Libraries\REST_Controller;
    defined('BASEPATH') OR exit('No direct script access allowed');

    require APPPATH . 'libraries/REST_Controller.php';
    require APPPATH . 'libraries/Format.php';


    class Mahasiswa extends REST_Controller 
    {

        public function __construct()
        {
            parent::__construct();
            $this->load->model('Mahasiswa_model', 'mahasiswa');

            // Untuk membuat limit per key per method yang mana dalam satu jam hanya boleh dua kali
            $this->methods['index_get']['limit'] = 1000;
        }

        public function index_get()
        {
            $id = $this->get('id');
            
            if($id === null) {
                $mahasiswa = $this->mahasiswa->getMahasiswa();
            } else {
                $mahasiswa = $this->mahasiswa->getMahasiswa($id);
            }

            
            if($mahasiswa) {
                $this->response([
                    'status' => true,
                    'data' => $mahasiswa
                ], REST_Controller::HTTP_OK);
            } else {
                $this->response([
                    'status' => false,
                    'message' => 'id not found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }
        }

        public function index_delete()
        {
            $id = $this->delete('id');

            if($id === null) {
                $this->response([
                    'status' => false,
                    'message' => 'provide an id!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            } else {
                if($this->mahasiswa->deleteMahasiswa($id) > 0) {
                    // Oke
                    $this->response([
                        'status' => true,
                        'id' => $id,
                        'message' => 'deleted.'
                    ], REST_Controller::HTTP_NO_CONTENT);
                } else {
                    // Id Not Found
                    $this->response([
                        'status' => false,
                        'message' => 'id not found!'
                    ], REST_Controller::HTTP_BAD_REQUEST);
                }
            }
        }

        public function index_post()
        {
            $data = [
                'nrp' => $this->post('nrp'),
                'nama' => $this->post('nama'),
                'email' => $this->post('email'),
                'jurusan' => $this->post('jurusan')
            ];

            // Memasukkan data ke dalam database mahasiswa
            if($this->mahasiswa->createMahasiswa($data) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'new mahasiswa has been created.'
                ], REST_Controller::HTTP_CREATED);
            } else {
                // Failed To Create New Data
                $this->response([
                    'status' => false,
                    'message' => 'failed to create new data!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }

        public function index_put()
        {
            $id = $this->put('id');

            $data = [
                'nrp' => $this->put('nrp'),
                'nama' => $this->put('nama'),
                'email' => $this->put('email'),
                'jurusan' => $this->put('jurusan')
            ];

            // Mengubah data ke dalam database mahasiswa
            if($this->mahasiswa->updateMahasiswa($data, $id) > 0) {
                $this->response([
                    'status' => true,
                    'message' => 'data mahasiswa has been updated.'
                ], REST_Controller::HTTP_NO_CONTENT);
            } else {
                // Failed To Create New Data
                $this->response([
                    'status' => false,
                    'message' => 'failed to updated data!'
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
        }
    }

?>