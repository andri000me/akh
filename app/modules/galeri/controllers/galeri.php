<?php

/* * *************************************************************************************
 *                       		galeri.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	galeri
 *      Created:   	27 Mar 14 23:30:20 WIB
 *      Copyright:  	(c) 2012 - desta
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Galeri extends Front_Controller {

    //put your code here
    function __construct()
    {
        parent::__construct();
        $this->load->library('upload');
        $this->load->model("galeri/galeri_model", "galeri");
        $this->load->model('modul/modul_model');
    }

    function debuk()
    {
        $var = $this->galeri
                ->with("modul")
                ->get('1');
        dump($var);
    }

    function index()
    {
        $this->_manage();
    }

    function _manage()
    {




        $data['galeri'] = "galeri"; // Controller
        $data['view'] = "index_galeri"; // View
        $data['module'] = "galeri"; // Controller
        // render template
        if ($this->ion_auth->is_admin())
        {
            echo Modules::run('template/admin', $data);
        }
        if ($this->ion_auth->in_group('staff'))
        {
            echo Modules::run('template/staff', $data);
        }
    }

    function add()
    {
        $data['title'] = "Tambah Gambar";

        if (!$this->ion_auth->is_admin())
        {
            redirect('auth/login', 'refresh');
        }

        // Configurasi tipe upload
        $config['upload_path'] = "./assets/img/real/"; //lokasi folder yang akan digunakan untuk menyimpan file
        $config['allowed_types'] = 'gif|jpg|png|JPEG'; //extension yang diperbolehkan untuk diupload
        $config['max_size'] = '2000';
        $config['max_width'] = '2000';
        $config['max_height'] = '2000';
        $config['file_name'] = url_title($this->input->post('file_upload'));

        $this->upload->initialize($config);

        if (!$this->upload->do_upload('file_upload'))
        {
            
            $data['messages'] = $this->upload->display_errors();
            $data['galeri'] = "galeri"; // Controller
            $data['view'] = "form_galeri"; // View
            $data['module'] = "galeri"; // Controller
            // render template
            echo Modules::run('template/admin', $data);
        }
        else
        {
            $data = $this->upload->data();

            $this->load->library('image_lib');

            // Setting tempat gambar
            $source = "./assets/img/real/" . $data['file_name'];
            $destination_thumb = "./assets/img/thumbnail/";
            $destination_medium = "./assets/img/medium/";

            $limit_medium = 200;
            $limit_thumb = 90;

            $limit_use = $data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'];

            // Percentase Resize
            if ($limit_use > $limit_medium || $limit_use > $limit_thumb)
            {
                $percent_medium = $limit_medium / $limit_use;
                $percent_thumb = $limit_thumb / $limit_use;
            }

            //// Making THUMBNAIL ///////
            $img['width'] = $limit_use > $limit_thumb ? $data['image_width'] * $percent_thumb : $data['image_width'];
            $img['height'] = $limit_use > $limit_thumb ? $data['image_height'] * $percent_thumb : $data['image_height'];

            // Configuration Of Image Manipulation :: Dynamic
            $img['thumb_marker'] = '_thumb-' . floor($img['width']) . 'x' . floor($img['height']);
            $img['quality'] = '100%';
            $img['source_image'] = $source;
            $img['new_image'] = $destination_thumb;

            // Do Resizing
            $this->image_lib->initialize($img);
            $this->image_lib->resize();
            $this->image_lib->clear();

            ////// Making MEDIUM /////////////
            $img['width'] = $limit_use > $limit_medium ? $data['image_width'] * $percent_medium : $data['image_width'];
            $img['height'] = $limit_use > $limit_medium ? $data['image_height'] * $percent_medium : $data['image_height'];

            // Configuration Of Image Manipulation :: Dynamic
            $img['thumb_marker'] = '_medium-' . floor($img['width']) . 'x' . floor($img['height']);
            $img['quality'] = '100%';
            $img['source_image'] = $source;
            $img['new_image'] = $destination_medium;

            // Do Resizing
            $this->image_lib->initialize($img);
            if (!$this->image_lib->resize())
            {
                echo $this->image_lib->display_errors();
            }
            $this->image_lib->clear();
            
            $this->form_validation->set_rules('ket','Keterangan','xss_clean');
            $this->form_validation->set_rules('modul_id','Modul Gambar','xss_clean');
            
            // Insert
            $info = array(
                'name' => $this->upload->file_name,
                'nama_file' => $this->input->post('nama_file')
            );

            $this->galeri->insert($info, 'images');
            redirect('galeri/index', 'refresh');
        }

        $data['galeri'] = "galeri"; // Controller
        $data['view'] = "form_galeri"; // View
        $data['module'] = "galeri"; // Controller
        // render template
        echo Modules::run('template/admin', $data);
    }

    function edit()
    {

        $data['galeri'] = "galeri"; // Controller
        $data['view'] = "form_galeri"; // View
        $data['module'] = "galeri"; // Controller
        // render template
        echo Modules::run('template/admin', $data);
    }

    function delete()
    {
        
    }

}

/* End of File: galeri.php */