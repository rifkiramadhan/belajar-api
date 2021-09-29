<?php 

    use GuzzleHttp\Client;

    class Mahasiswa_model extends CI_model 
    {
        
        private $_client;

        // Membuat constructor supaya instansiasi URL API nya hanya dilakukan sekali
        public function __construct()
        {
            $this->_client = new Client([
                // Base URI dapat di simpan di dalam instansiasi client nya
                'base_uri' => 'http://localhost/belajar-api/latihan6/api/',
                'auth' => ['rifki', 'wpu123']
            ]);
        }


        public function getAllMahasiswa()
        {

            $response = $this->_client->request('GET', 'mahasiswa', [
                'query' => [
                    'wpu-key' => 'wpu123'
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            return $result['data'];
        }

        // Membuat function untuk mengambil data mahasiswa berdasarkan id untuk melihat detail setiap mahasiswa yang terdaftar
        public function getMahasiswaById($id)
        {   

            $response = $this->_client->request('GET', 'mahasiswa', [
                'query' => [
                    'wpu-key' => 'wpu123',
                    'id' => $id
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);

            return $result['data'][0];
        }

        public function tambahDataMahasiswa()
        {
            $data = [
                "nama" => $this->input->post('nama', true),
                "nrp" => $this->input->post('nrp', true),
                "email" => $this->input->post('email', true),
                "jurusan" => $this->input->post('jurusan', true),
                'wpu-key' => 'wpu123'
            ];

            $response = $this->_client->request('POST', 'mahasiswa', [
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        // Membuat function untuk menghapus data mahasiswa yang data id nya diambil dari setiap id pada tabel mahasiswa
        public function hapusDataMahasiswa($id)
        {

            $response = $this->_client->request('DELETE', 'mahasiswa', [
                'form_params' => [
                    'id' => $id,
                    'wpu-key' => 'wpu123'
                ]
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        public function ubahDataMahasiswa()
        {
            $data = [
                "nama" => $this->input->post('nama', true),
                "nrp" => $this->input->post('nrp', true),
                "email" => $this->input->post('email', true),
                "jurusan" => $this->input->post('jurusan', true),
                "id" => $this->input->post('id', true),
                'wpu-key' => 'wpu123'

            ];

            $response = $this->_client->request('PUT', 'mahasiswa', [
                'form_params' => $data
            ]);

            $result = json_decode($response->getBody()->getContents(), true);
            return $result;
        }

        // Membuat function untuk mencari data mahasiswa bedasarkan keyword yang diketik maupun
        public function cariDataMahasiswa()
        {
            $keyword = $this->input->post('keyword', true);
            $this->db->like('nama', $keyword);
            $this->db->or_like('jurusan', $keyword);
            $this->db->or_like('nrp', $keyword);
            $this->db->or_like('email', $keyword);
            return $this->db->get('mahasiswa')->result_array();
        }
    }

?>