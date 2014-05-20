<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends Admin_Controller {

    function __construct()
    {
        // Everyting in on place
        parent::__construct();
    }

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

    function debuk()
    {
        $query = $this->db->get('users');

        $this->excel_generator->set_query($query);
        $this->excel_generator->set_header(array('username', 'email', 'company', 'first_name'));
        $this->excel_generator->set_column(array('username', 'email', 'company', 'first_name'));
        $this->excel_generator->set_width(array(25, 15, 30, 15));
        $this->excel_generator->exportTo2003('Laporan Users');
    }

    function _manage()
    {
        if ($this->ion_auth->is_admin())
        {
            //$data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
            $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . validation_errors() . '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            // paging
            $this->load->library('pagination');

            $uri_segment = 3;
            $data['offset'] = $this->uri->segment($uri_segment);

            $config['base_url'] = base_url() . 'user/index/';
            $config['total_rows'] = $this->ion_auth->users()->num_rows();
            $config['per_page'] = 18;
            $config['next_link'] = '<li>Selanjutnya</li>';
            $config['prev_link'] = '<li>Sebelumnya</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
            $config['cur_tag_close'] = ' </li>';

            // I don't know how this work! i found it in ellislab.com sharing forum
            $data['users'] = $this->ion_auth->offset(
                            $this->uri->segment($uri_segment))
                    ->limit($config['per_page'])
                    ->order_by('created_on') //active
                    ->users()
                    ->result();

            // get user group of
            foreach ($data['users'] as $k => $user) {
                // cek groups user
                $data['users'][$k]->groups = $this->ion_auth->get_users_groups($user->id)->result();
            }


            // run paging
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();

            // Template
            $data['user'] = "user"; // Controller
            $data['view'] = "index_users"; // View
            $data['module'] = "user"; // Controller

            echo Modules::run('template/admin', $data);
        }
        else
        {
            redirect('auth', 'refresh');
        }
    }

    function index()
    {
        if (!$this->ion_auth->logged_in())
        {
            redirect('auth/login');
        }

        $this->_manage();
    }

    function add($id = null)
    {
        $data['title'] = "Create User";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('auth', 'refresh');
        }
        $user = $this->ion_auth->user($id)->row();

        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();


        //$user = $this->ion_auth
        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required|xss_clean');
        $this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'required|xss_clean');
        $this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
        $this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

        if ($this->form_validation->run() == true)
        {
            $username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
            $email = strtolower($this->input->post('email'));
            $password = $this->input->post('password');

            $additional_data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );
        }

        $groupData = $this->input->post('groups');

        if (isset($groupData) && !empty($groupData))
        {

            $this->ion_auth->remove_from_group('', $id);

            foreach ($groupData as $grp) {
                $this->ion_auth->add_to_group($grp, $id);
            }
        }

        if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
        {
            //check to see if we are creating the user
            //redirect them back to the admin page
            $this->session->set_flashdata('message', $this->ion_auth->messages());
            redirect("auth", 'refresh');
        }
        else
        {
            $data['csrf'] = $this->_get_csrf_nonce();

            //display the create user form
            //set the flash data error message if there is one
            $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

            $data['users'] = $user;

            $data['groups'] = $groups;
            $data['currentGroups'] = $currentGroups;


            $data['first_name'] = array(
                'name' => 'first_name',
                'id' => 'first_name',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('first_name'),
            );
            $data['last_name'] = array(
                'name' => 'last_name',
                'id' => 'last_name',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('last_name'),
            );
            $data['email'] = array(
                'name' => 'email',
                'id' => 'email',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('email'),
            );
            $data['company'] = array(
                'name' => 'company',
                'id' => 'company',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('company'),
            );
            $data['phone'] = array(
                'name' => 'phone',
                'id' => 'phone',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('phone'),
            );
            $data['password'] = array(
                'name' => 'password',
                'id' => 'password',
                'type' => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password'),
            );
            $data['password_confirm'] = array(
                'name' => 'password_confirm',
                'id' => 'password_confirm',
                'type' => 'password',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('password_confirm'),
            );
        }

        //$data['users'] = 
        $data['user'] = "user"; // Controller
        $data['view'] = "form_user"; // View
        $data['module'] = "user"; // Controller

        echo Modules::run('template/admin', $data);
    }

    function edit($id)
    {
        $data['title'] = "Edit User";
        /*
          if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
          {
          redirect('auth', 'refresh');
          }
         */
        $user = $this->ion_auth->user($id)->row();
        $groups = $this->ion_auth->groups()->result_array();
        $currentGroups = $this->ion_auth->get_users_groups($id)->result();

        //validate form input
        $this->form_validation->set_rules('first_name', $this->lang->line('edit_user_validation_fname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('last_name', $this->lang->line('edit_user_validation_lname_label'), 'required|xss_clean');
        $this->form_validation->set_rules('phone', $this->lang->line('edit_user_validation_phone_label'), 'required|xss_clean');
        $this->form_validation->set_rules('company', $this->lang->line('edit_user_validation_company_label'), 'required|xss_clean');
        $this->form_validation->set_rules('groups', $this->lang->line('edit_user_validation_groups_label'), 'xss_clean');

        if (isset($_POST) && !empty($_POST))
        {
            // do we have a valid request?
            if ($this->_valid_csrf_nonce() === FALSE || $id != $this->input->post('id'))
            {
                show_error($this->lang->line('error_csrf'));
            }

            $data = array(
                'first_name' => $this->input->post('first_name'),
                'last_name' => $this->input->post('last_name'),
                'company' => $this->input->post('company'),
                'phone' => $this->input->post('phone'),
            );

            //Update the groups user belongs to
            $groupData = $this->input->post('groups');

            if (isset($groupData) && !empty($groupData))
            {

                $this->ion_auth->remove_from_group('', $id);

                foreach ($groupData as $grp) {
                    $this->ion_auth->add_to_group($grp, $id);
                }
            }

            // update the password if it was posted
            // but we don't need this
            /*
              if ($this->input->post('password'))
              {
              $this->form_validation->set_rules('password', $this->lang->line('edit_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
              $this->form_validation->set_rules('password_confirm', $this->lang->line('edit_user_validation_password_confirm_label'), 'required');

              $data['password'] = $this->input->post('password');
              }
             */
            if ($this->form_validation->run() === TRUE)
            {
                $this->ion_auth->update($user->id, $data);

                //check to see if we are creating the user
                //redirect them back to the admin page
                $this->session->set_flashdata('message', "User Saved");
                redirect("user", 'refresh');
            }
        }

        //display the edit user form
        $data['csrf'] = $this->_get_csrf_nonce();
        //set the flash data error message if there is one
        $data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        //pass the user to the view
        $data['users'] = $user;
        $data['groups'] = $groups;
        $data['currentGroups'] = $currentGroups;

        $data['first_name'] = array(
            'name' => 'first_name',
            'id' => 'first_name',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('first_name', $user->first_name),
        );
        $data['last_name'] = array(
            'name' => 'last_name',
            'id' => 'last_name',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('last_name', $user->last_name),
        );
        $data['company'] = array(
            'name' => 'company',
            'id' => 'company',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('company', $user->company),
        );
        $data['phone'] = array(
            'name' => 'phone',
            'id' => 'phone',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('phone', $user->phone),
        );

        $data['email'] = array(
            'name' => 'email',
            'id' => 'email',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('email', $user->email),
        );


        $data['password'] = array(
            'name' => 'password',
            'id' => 'password',
            'type' => 'password',
            'class' => 'form-control'
        );
        $data['password_confirm'] = array(
            'name' => 'password_confirm',
            'id' => 'password_confirm',
            'type' => 'password',
            'class' => 'form-control'
        );


        $data['user'] = "user"; // Controller
        $data['view'] = "form_user"; // View
        $data['module'] = "user"; // Controller

        echo Modules::run('template/admin', $data);
    }

    function delete($id = null)
    {
        if (!$this->ion_auth->is_admin() && !$this->ion_auth->in_group('manajer'))
        {
            echo 'You don\'t have an access';
        }
        /*
         * Admin done
         */
        elseif ($this->ion_auth->is_admin() && $this->ion_auth->delete_user($id))
        {
            $this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Pengguna berhasil dihapus!</div>");
            redirect('user/index');
        }
        /*
         * Manajer done
         */
        elseif ($this->ion_auth->in_group('manajer') && $this->ion_auth->delete_user($id))
        {
            $this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Pengguna berhasil dihapus!</div>");
            redirect('user/index');
        }
    }

    function form_pengguna()
    {
        $this->load->view('user/tambah');
    }

    function proses()
    {
        $data = $_REQUEST;

        // this for add new records
        if ($data['type'] == 'addUser')
        {
            $this->ion_auth->register($data);
        }
        // this for update records
        else if ($data['type'] == 'updateUser')
        {
            $this->ion_auth->update($data);
        }

        if ($data['tambahUser'] === "true")
        {

            $output['success'] = 1;
            $output['msg'] = "data process complete successfully";
            echo json_encode($output);
        }
        else
        {
            header("Location: " . base_url() . "index.php/user/");
            exit();
        }
    }

}