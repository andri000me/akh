<?php

/* * *************************************************************************************
 *                       		group.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	group
 *      Created:   	26 Jan 14 10:22:41 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class group extends Admin_Controller {

    //put your code here

    function __construct()
    {
        parent::__construct();
    }

    function debuk()
    {
        $groups = $this->ion_auth->groups()->result_array();
        dump($groups);
        exit;
    }

    function _manage()
    {
        if ($this->ion_auth->is_admin())
        {
            $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . validation_errors() . '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
            $uri_segment = 3;
            $data['offset'] = $this->uri->segment($uri_segment);

            $config['base_url'] = base_url() . 'group/index/';
            $config['total_rows'] = $this->ion_auth->groups()->num_rows();
            $config['per_page'] = 18;
            $config['next_link'] = '<li>Selanjutnya</li>';
            $config['prev_link'] = '<li>Sebelumnya</li>';
            $config['cur_tag_open'] = '<li class="active"><a href="#">..</a> - Halaman ke ';
            $config['cur_tag_close'] = ' </li>';

            // I don't know how this work! i found it in ellislab.com sharing forum
            $data['groups'] = $this->ion_auth->offset(
                            $this->uri->segment($uri_segment))
                    ->limit($config['per_page'])
                    ->order_by('name') //active
                    ->groups()
                    ->result_array();

            // run paging
            $this->pagination->initialize($config);
            $data['paging'] = $this->pagination->create_links();

            // Template
            $data['group'] = "group"; // Controller
            $data['view'] = "index_group"; // View
            $data['module'] = "group"; // Controller

            echo Modules::run('template/admin', $data);
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

    function formGroup()
    {
        $this->load->view('group/tambah_group');
    }

    function add($id=null)
    {
        $data['title'] = "Tambah Group";

        if (!$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }
        
        $group = $this->ion_auth->group($id)->row();

        // Setting Form
        $this->form_validation->set_rules('group_name', 'Nama Level', 'xss_clean|required');
        $this->form_validation->set_rules('group_description', 'Penjelasan', 'xss_clean|required');

        if ($this->form_validation->run() == true)
        {
            // cek passing valuenya
            $name = $this->input->post('group_name');
            $description = $this->input->post('group_description');
        }

        if ($this->form_validation->run() == true && $this->ion_auth->create_group($name, $description))
        {
            // jika berhasil arahkan ke tabel group
            $this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Level Pengguna berhasil ditambahkan!</div>");
            redirect(base_url() . 'group', 'refresh');
        }
        else
        {
            // Pesan errur kalo inputnya kurang, dan berhasil jika berhasil
            $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . validation_errors() . '</div>' :
                            ($this->ion_auth->errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . $this->ion_auth->errors() . '</div>' : $this->session->flashdata('message')));
            
            $data['groups'] = $group;
            
            $data['group_name'] = array(
                'name' => 'group_name',
                'id' => 'group_name',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('group_name'),
            );
            $data['group_description'] = array(
                'name' => 'group_description',
                'id' => 'group_description',
                'type' => 'text',
                'class' => 'form-control',
                'value' => $this->form_validation->set_value('description'),
            );

            $data['group'] = "group"; // Controller
            $data['view'] = "form_group"; // View
            $data['module'] = "group"; // Controller

            echo Modules::run('template/admin', $data);
        }
    }

    function edit($id = false)
    {
        $id = (int) $id;

        $data['title'] = "Edit Level";

        if (!$this->ion_auth->logged_in() || !$this->ion_auth->is_admin())
        {
            redirect('group', 'refresh');
        }

        $group = $this->ion_auth->group($id)->row();

        // setting validasi
        $this->form_validation->set_rules('group_name', 'Nama Level', 'required|xss_clean');
        $this->form_validation->set_rules('group_description', 'Penjelasan', 'required|xss_clean');

        if (isset($_POST) && !empty($_POST))
        {
            $group_name = $this->input->post('group_name');
            $group_description = $this->input->post('group_description');

            if ($this->form_validation->run() === TRUE &&
                    //dump($_POST))
                    $this->ion_auth->update_group($id, $group_name, $group_description))
            {
                $this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Group sudah terupdate! </div>");
                redirect('group', 'refresh');
            }
        }

        // Pesan errur kalo inputnya kurang
        $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . validation_errors() . '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

        // pass group to view
        $data['groups'] = $group;

        $data['group_name'] = array(
            'name' => 'group_name',
            'id' => 'group_name',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('group_name', $group->name),
        );

        $data['group_description'] = array(
            'name' => 'group_description',
            'id' => 'group_description',
            'type' => 'text',
            'class' => 'form-control',
            'value' => $this->form_validation->set_value('group_description', $group->description),
        );

        // Template
        $data['group'] = "group"; // Controller
        $data['view'] = "form_group"; // View
        $data['module'] = "group"; // Controller

        echo Modules::run('template/admin', $data);
    }

    function delete($id = null)
    {
        $data['title'] = "Hapus Group";

        if (!$this->ion_auth->is_admin())
        {
            redirect(base_url() . 'group');
        }

        // pass the right arguments and it's done
        $group_delete = $this->ion_auth->delete_group($id);

        if (!$group_delete)
        {
            $data['message'] = (validation_errors() ? '<div class="alert alert-error"><a class="close" data-dismiss="alert">X</a>' . validation_errors() . '</div>' : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));
        }
        else
        {
            $this->session->set_flashdata('message', "'<div class=\"alert alert-success\"><a class=\"close\" data-dismiss=\"alert\">X</a>'Level Pengguna berhasil dihapus!</div>");
            redirect(base_url('group'), $data);
        }
    }

}

/* End of File: group.php */