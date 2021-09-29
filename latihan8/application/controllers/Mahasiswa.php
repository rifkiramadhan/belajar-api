<?php 

    class Mahasiswa extends CI_Controller {
        public function __construct()
        {
            parent::__construct();
            $this->load->model('Mahasiswa_model');
            $this->load->library('form_validation');
        }

        public function index()
        {

            $data['judul'] = 'Daftar Mahasiswa';
            // Jika tombol cari tidak ditekan maka tampilkan seluruh data mahasiswa
            $data['mahasiswa'] = $this->Mahasiswa_model->getAllMahasiswa();
            // Jika tombol cari ditekan maka cari data mahasiswa berdasarkan keywordnya
            if( $this->input->post('keyword') ) {
                $data['mahasiswa'] = $this->Mahasiswa_model->cariDataMahasiswa();
            }
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/index', $data);
            $this->load->view('templates/footer');
        }

        public function tambah()
        {
            $data['judul'] = 'Form Tambah Data Mahasiswa';

            // Membuat aturan script bawaan codeigniter untuk form tambah data mahasiswa
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            // Jika datanya gagal
            if( $this->form_validation->run() == FALSE ) {
                // Maka tampilkan template untuk menambahkan data mahasiswa
                $this->load->view('templates/header', $data);
                $this->load->view('mahasiswa/tambah');
                $this->load->view('templates/footer');
            } else {
                // Jika berhasil maka akan menjalankan fungsi di dalam model dan dimasukkan ke dalam database
                $this->Mahasiswa_model->tambahDataMahasiswa();

                // Membuat sebuah session terlebih dahulu
                $this->session->set_flashdata('flash', 'Ditambahkan');

                // Kemudian halamannya pindah ke controller mahasiswa method index
                redirect('mahasiswa');
            }
        }

        // Membuat fungsi hapus yang datanya nanti diambil dari id masing-masing mahasiswa
        public function hapus($id)
        {
            $this->Mahasiswa_model->hapusDataMahasiswa($id);
            
            // Jika datanya berhasil dihapus maka tampilkan flash Dihapus
            $this->session->set_flashdata('flash', 'Dihapus');
            redirect('mahasiswa');
        }

        // Membuat fungsi untuk melihat detail mahasiswa yang diambil dari masing-masing id mahasiswa
        public function detail($id)
        {
            $data['judul'] = 'Detail Data Mahasiswa';
            $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/detail', $data);
            $this->load->view('templates/footer');
        }

        // Membuat fungsi untuk mengubah data mahasiswa yang diambil dari masing-masing id mahasiswa
        public function ubah($id)
        {
            $data['judul'] = 'Form Ubah Data Mahasiswa';
            $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaById($id);
            $data['jurusan'] = ['Teknik Informatika', 'Teknik Mesin', 'Teknik Industri', 'Teknik Planologi', 'Teknik Pangan', 'Teknik Lingkungan'];

            // Membuat aturan script bawaan codeigniter untuk form ubah data mahasiswa
            $this->form_validation->set_rules('nama', 'Nama', 'required');
            $this->form_validation->set_rules('nrp', 'NRP', 'required|numeric');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email');

            // Jika datanya gagal
            if( $this->form_validation->run() == FALSE ) {
                // Maka tampilkan template untuk mengubah data mahasiswa
                $this->load->view('templates/header', $data);
                $this->load->view('mahasiswa/ubah', $data);
                $this->load->view('templates/footer');
            } else {
                // Jika berhasil maka akan menjalankan fungsi di dalam model dan dimasukkan ke dalam database
                $this->Mahasiswa_model->ubahDataMahasiswa();

                // Membuat sebuah session terlebih dahulu
                $this->session->set_flashdata('flash', 'Diubah');

                // Kemudian halamannya pindah ke controller mahasiswa method index
                redirect('mahasiswa');
            }
        }
    }

?>