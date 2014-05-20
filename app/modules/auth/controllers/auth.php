<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Auth extends Front_Controller {

    function __construct()
    {
        parent::__construct();
    }
    
    function index()
    {
        if ($this->ion_auth->logged_in())
        {
            /*
             * setting groups yang ada di tabel
             * require settings: config/routes.php
             */
            if ($this->ion_auth->is_admin())
            {
                // Administrator Sistem
                redirect('user/admin', 'refresh');
            }
            if ($this->ion_auth->in_group('members'))
            {
                // Unregister Pengguna
                redirect('user/member', 'refresh');
            }
            if ($this->ion_auth->in_group('staff'))
            {
                // Staff Pegawai
                redirect('user/staff', 'refresh');
            }
            if ($this->ion_auth->in_group('bos'))
            {
                // Para Atasan/ Bos
                redirect('user/bos', 'refresh');
            }
        }
        else
        {
            redirect('auth/login', 'refresh');

            /*
              $data['login'] = "login";
              $data['view'] = "login";
              $data['module'] = "auth";
              $data['message'] = "";
              echo Modules::run('template/login',$data);
             */
        }
    }

    function login()
    {
        $data['title'] = "Login";
       
        //validate form input
        $this->form_validation->set_rules('identity', 'Identity', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true)
        {
            
            //check to see if the user is logging in
            //check for "remember me"
            $remember = (bool) $this->input->post('remember');

            if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
            {
                //if the login is successful, redirect them back to the home page
                $this->session->set_flashdata('message', '<div class="alert alert-error">' . $this->ion_auth->messages() . '</div>');
                redirect('auth', 'refresh');
            }
            else
            {
                //if the login was un-successful
                //redirect them back to the login page
                $this->session->set_flashdata('message', '<div class="alert alert-error">' . $this->ion_auth->errors() . '</div>');
                //use redirects instead of loading views for compatibility with MY_Controller libraries
                redirect('auth/login', 'refresh');
            }
        }
        else
        {
            //the user is not logging in so display the login page
            //set the flash data error message if there is one
            $data['message'] = (validation_errors()) ? '<div class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert">×</button>' . validation_errors() . '</div>' : $this->session->flashdata('message');

            $data['identity'] = array('name' => 'identity',
                'id' => 'identity',
                'type' => 'text',
                'value' => $this->form_validation->set_value('identity'),
            );
            $data['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
            );
            
            // Template
            // $data['welcome'] = ucfirst($this->session->userdata('email'));
            // $data['title']  = "Modul Pengguna - Daftar Pengguna Sistem";
            $data['auth'] = "auth"; // Controller
            $data['view'] = "login"; // View
            $data['module'] = "auth"; // Controller

            echo Modules::run('template/login', $data);
        }
    }

    function logout()
    {
        $this->ion_auth->logout();
        //redirect them to the login page
        $this->session->set_flashdata('message', '<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">×</button>' . $this->ion_auth->messages() . '</div>');
        redirect('auth/login', 'refresh');
    }
    
    function registrasi_popup()
    {
        //apabila user sudah login, maka halaman register tidak dapat ditampilkan
        if ($this->ion_auth->logged_in())
        {
            redirect('auth/index');
        }

        $data['title'] = "Halaman Registrasi";

        $this->form_validation->set_rules('username', 'Username', 'required|xss_clean|min_length[4]');
        //alamat email wajib diisi dan sesuai dengan format email
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|valid_email');
        //nama depan wajib diisi dan bersih dari cross site scripting
        $this->form_validation->set_rules('first_name', 'Nama Depan', 'required|xss_clean');
        //nama belakang wajib diisi dan bersih dari cross site scripting
        $this->form_validation->set_rules('last_name', 'Nama Belakang', 'required|xss_clean');
        //nomor telepon wajib diisi dengan angka, bersih dari cross site scripting, rentang 7-12 karakter
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required|numeric|xss_clean|min_length[7]|max_length[12]');
        //nama perusahaan wajib diisi dan bersih dari cross site scripting
        $this->form_validation->set_rules('company', 'Divisi', 'required|xss_clean');
        //password wajib diisi, jumlah karakter lebih dari angka pengaturan min_password_length dan cocok dengan field password_confirm
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required');

        //apabila validasi benar
        if ($this->form_validation->run() == true)
        {
            //Field utama untuk autentikasi adalah username, email dan password, disimpan di table users
            //post nilai untuk username, email dan password
            $username = $this->input->post('username', true);
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            //ini data tambahan untuk profil user
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone')
            );
        }

        //apabila proses registrasi berhasil
        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
        {
            //$this->session->set_flashdata('message', "Akun berhasil dibuat");
            $this->session->set_flashdata('message', '<div class="alert alert-info">' . $this->ion_auth->messages() . '</div>');
            redirect('auth/login');
        }
        else //apabila validasi salah atau membuka halaman pertama kali
        {
            //set flashdata untuk kesalahan input atau untuk pesan error sebelumnya
            $main['message'] = (validation_errors()) ? validation_errors() : $this->ion_auth->errors();

            //buat array untuk membuat field form
            $main['username'] = array('name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'value' => $this->form_validation->set_value('username'),
            );
            $main['email'] = array('name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $main['first_name'] = array('name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $main['last_name'] = array('name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $main['company'] = array('name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $main['phone'] = array('name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $main['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $main['password_confirm'] = array('name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $data['message'] = (validation_errors()) ? '<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">×</button>' . validation_errors() . '</div>' : $this->session->flashdata('message');

            $data['auth'] = "auth"; // Controller
            $data['view'] = "register_popup"; // View
            $data['module'] = "auth"; // Controller

            echo Modules::run('template/login', $data);
        }
    }
    

    function registrasi()
    {
        //apabila user sudah login, maka halaman register tidak dapat ditampilkan
        if ($this->ion_auth->logged_in())
        {
            redirect('auth/index');
        }

        $data['title'] = "Halaman Registrasi";

        $this->form_validation->set_rules('username', 'Username', 'required|xss_clean|min_length[4]');
        //alamat email wajib diisi dan sesuai dengan format email
        $this->form_validation->set_rules('email', 'Alamat Email', 'required|valid_email');
        //nama depan wajib diisi dan bersih dari cross site scripting
        $this->form_validation->set_rules('first_name', 'Nama Depan', 'required|xss_clean');
        //nama belakang wajib diisi dan bersih dari cross site scripting
        $this->form_validation->set_rules('last_name', 'Nama Belakang', 'required|xss_clean');
        //nomor telepon wajib diisi dengan angka, bersih dari cross site scripting, rentang 7-12 karakter
        $this->form_validation->set_rules('phone', 'Nomor Telepon', 'required|numeric|xss_clean|min_length[7]|max_length[12]');
        //nama perusahaan wajib diisi dan bersih dari cross site scripting
        $this->form_validation->set_rules('company', 'Divisi', 'required|xss_clean');
        //password wajib diisi, jumlah karakter lebih dari angka pengaturan min_password_length dan cocok dengan field password_confirm
        $this->form_validation->set_rules('password', 'Password', 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', 'Konfirmasi Password', 'required');

        //apabila validasi benar
        if ($this->form_validation->run() == true)
        {
            //Field utama untuk autentikasi adalah username, email dan password, disimpan di table users
            //post nilai untuk username, email dan password
            $username = $this->input->post('username', true);
            $email = $this->input->post('email');
            $password = $this->input->post('password');

            //ini data tambahan untuk profil user
            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone')
            );
        }

        //apabila proses registrasi berhasil
        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
        {
            //$this->session->set_flashdata('message', "Akun berhasil dibuat");
            $this->session->set_flashdata('message', '<div class="alert alert-info">' . $this->ion_auth->messages() . '</div>');
            redirect('auth/login');
        }
        else //apabila validasi salah atau membuka halaman pertama kali
        {
            //set flashdata untuk kesalahan input atau untuk pesan error sebelumnya
            $main['message'] = (validation_errors()) ? validation_errors() : $this->ion_auth->errors();

            //buat array untuk membuat field form
            $main['username'] = array('name' => 'username',
                'id' => 'username',
                'type' => 'text',
                'value' => $this->form_validation->set_value('username'),
            );
            $main['email'] = array('name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'value' => $this->form_validation->set_value('email'),
            );
            $main['first_name'] = array('name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $main['last_name'] = array('name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $main['company'] = array('name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'value' => $this->form_validation->set_value('company'),
            );
            $main['phone'] = array('name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'value' => $this->form_validation->set_value('phone'),
            );
            $main['password'] = array('name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password'),
            );
            $main['password_confirm'] = array('name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'value' => $this->form_validation->set_value('password_confirm'),
            );

            $data['message'] = (validation_errors()) ? '<div class="alert alert-success"> <button type="button" class="close" data-dismiss="alert">×</button>' . validation_errors() . '</div>' : $this->session->flashdata('message');

            $data['auth'] = "auth"; // Controller
            $data['view'] = "register"; // View
            $data['module'] = "auth"; // Controller

            echo Modules::run('template/login', $data);
        }
    }
    
    function ubah_profile()
    {
        
    }
    
    function ubah_password()
    {
        
    }

    /*
     * Ionauth additional support
     */

    function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return array($key => $value);
    }

    function _valid_csrf_nonce()
    {
        if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
                $this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
        {
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    /* END OF IONauth Line */
}