<?php

/* * *************************************************************************************
 *                       		jkueri.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	jkueri
 *      Created:   	10:01:48 15 Apr 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jkueri extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();

        $this->load->helper(array('form', 'url'));
    }

    function index() {
        $data['multiupload'] = "jkueri"; // Controller
        $data['view'] = "form_jkueri"; // View
        $data['module'] = "multiupload"; // Controller
        $data['error'] = ' ';

        echo Modules::run('template/staff', $data);
    }

    public function upload() {
        if (isset($_FILES['image'])) {

            $data = $_FILES['image'];
            $total = count($data['name']);
            $data2 = array();
            for ($i = 0; $i < $total; $i++) {
                $data2[] = array(
                    'name' => $data['name'][$i],
                    'type' => $data['type'][$i],
                    'tmp_name' => $data['tmp_name'][$i],
                    'error' => $data['error'][$i],
                    'size' => $data['size'][$i],
                );
            }

            $no = 0;
            foreach ($data2 as $row) {
                $config['upload_path'] = './assets/uploads';
                $config['allowed_types'] = 'gif|jpg|png|bmp';
                $this->load->library('multi_upload', $config);
                if ($this->multi_upload->do_upload($data2[$no])) {
                    $image_data = $this->multi_upload->data();

                    echo img(array(
                        'src' => base_url("assets/uploads/$image_data[file_name]"),
                        'width' => 300,
                        'style' => 'margin:10px; padding:10px; background:#bbb'
                    ));
                }
                $no++;
            }
        }
    }

//    
//    function do_upload()
//    {
//        $upload_path_url = base_url('assets/doc/img/real/');
//        
//        $config['upload_path'] = FCPATH.'assets/doc/img/real/';
//        $config['allowed_types'] = 'jpg|jpeg|png';
//        $config['max_sizes'] = '30000';
//        
//        $this->load->library('upload',$config);
//        
//        // cek
//        if (!$this->upload->do_upload())
//            {
//            $data['error'] = array('error' => $this->upload->display_errors());
//            $data['multiupload'] = "jkueri"; // Controller
//        $data['view'] = "form_jkueri"; // View
//        $data['module'] = "multiupload"; // Controller
//        $data['error'] = ' ';
//            echo Modules::run('template/staff', $data);
//            }
//            else
//            {
//                $data = $this->upload->data();
//                
//                /*
//                $config = array(
//                    'source_image' => $data['full_path'],
//                    'new_image' => $this->$upload_path_url'/assets/doc/img/',
//                    'maintain_ratio' => true,
//                    'width' => 80,
//                    'height' => 80,
//                );
//                
//                $this->load->library('image_lib', $config);
//                $this->image_lib->resize();
//                */
//                
//                $info->name = $data['file_name'];
//                $info->type = $data['file_type'];
//                $info->size = $data['file_size'];
//                $info->url  = $upload_path_url.$data['file_name'];
//                
//                $info->thumb = $upload_path_url.$data['file_name'];
//                /*
//                $info->delete_url = base_url().'upload/deleteImage/'.$data['file_name'];
//                $info->delete_type = 'DELETE';
//                */
//                
//                if (IS_AJAX)
//                {
//                    echo json_encode(array($info));
//                }
//                else
//                {
//                    $data['upload_data'] = $this->upload->data();
//                    $data['multiupload'] = "jkueri"; // Controller
//        $data['view'] = "form_jkueri"; // View
//        $data['module'] = "multiupload"; // Controller
//        $data['error'] = ' ';
//                    echo Modules::run('template/staff', $data);
//                }
//            }
//    }
}

/* End of File: jkueri.php */