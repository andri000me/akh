<?php

/* * *************************************************************************************
 *                       		multiupload.php
 * **************************************************************************************
 *      Author:     	Topidesta as Shabiki <m.desta.fadilah@hotmail.com>
 *      Website:    	http://www.twitter.com/emang_dasar
 *
 *      File:          	multiupload
 *      Created:   	12:17:27 14 Apr 14
 *      Copyright:  	(c) 2014 - JohnDoe
 *                  	DON'T BE A DICK PUBLIC LICENSE
 * 			Version 1, December 2009
 * 			Copyright (C) 2009 Philip Sturgeon
 *      source:         https://snipt.net/raw/f9519011d704be9e77af9f36f1f44f16/?nice
 *      source:         https://github.com/blueimp/jQuery-File-Upload/wiki/jQuery-File-Upload,---Multi-file-upload-with-CodeIgniter
 *      source:         https://github.com/nicdev/CodeIgniter-Multiple-File-Upload/blob/master/MY_Upload.php
 *      source:         https://github.com/stvnthomas/CodeIgniter-Multi-Upload/blob/master/MY_Upload.php
 *      source:         http://ellislab.com/forums/viewthread/88484/#446033
 * ************************************************************************************** */
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Multiupload extends MY_Controller {
    /* -----------------------------------------------------------------------------------
     * It's actualy not my own source, but I just want to share & bookmark it here ;)
     *
     * Thanks to Anggy Trisnawan
     * Url: http://anggytrisnawan.com/blog/2012/07/21/upload-multiple-file-codeigniter
     * -----------------------------------------------------------------------------------
     */

    function __construct() {
        parent::__construct();

        // load the libraries at first
        $this->load->library('image_lib');
        $this->load->helper(array('form', 'url'));
    }

    function debuk() 
    {
        dump($this->upload->data());
    }

    function watermarking($filename) 
    {
        
        //$config['source_image'] = $gb;
        $upload_conf['image_library'] = 'gd2';
        $upload_conf['wm_text'] = 'belionderdil.com'; // tanda yang akan tercetak di gambar
        $upload_conf['wm_type'] = 'text';
        $upload_conf['source_image'] = $filename;
        $upload_conf['wm_font_path'] = 'assets/fonts/texb.ttf'; //pastikan fontnya ada
        $upload_conf['wm_font_size'] = 40;
        $upload_conf['wm_font_color'] = '#B5622A';
        $upload_conf['wm_vrt_alignment'] = 'middle';
        $upload_conf['wm_hor_alignment'] = 'center';
        $upload_conf['wm_padding'] = 5;
        $upload_conf['thumb_marker'] = '_water';
        $upload_conf['wm_opacity'] = 5;
        $upload_conf['wm_shadow_color'] = 333333;
        
        $this->image_lib->initialize($upload_conf);
        $this->image_lib->watermark();
    }

    // front view
    function index() {
        /* -----------------------------------------------------------------------------------
         * It's what you need for the 'upload' view
         * -----------------------------------------------------------------------------------
         * <?php echo form_open_multipart('upload/do_upload');?>
         *
         *     <!-- make sure you give an array (userfile[]) to the "name" attribute and have attribute "multiple" on it --> 
         *     <?php echo form_input( array( 'name'=>'userfile[]', 'multiple'=>true ) ); ?><br />
         *
         *     <!-- just, another submit button --> 
         *     <?php echo form_submit('submit', 'Upload'); ?>
         *
         * <!-- well, close the form -->
         * <?php echo form_close();?>
         * -----------------------------------------------------------------------------------
         */

        $data['multiupload'] = "multiupload"; // Controller
        $data['view'] = "form_multiupload"; // View
        $data['module'] = "multiupload"; // Controller
        $data['error'] = ' ';

        echo Modules::run('template/staff', $data);
    }

    // Upload & Resize in action
    function do_upload() {

        /*
          $upload_data = $this->upload->data();
          $mr = $upload_data['full_path'];
          $this->_watermarking($mr);
         */
        
        $upload_conf = array(
            
            'upload_path' => realpath('assets/doc/img/real/'),
            'allowed_types' => 'gif|jpg|png|JPEG|JPG',
            'max_size' => '30000',
            'encrypt_name' => FALSE,
            'overwrite' => TRUE,
        );
        
        $this->load->library('upload', $upload_conf);
        //$this->upload->initialize($upload_conf);
        
        
        /*
        $config['upload_path'] = realpath('assets/doc/img/real/');
        $config['allowed_types'] = 'gif|jpg|png|JPEG|JPG';
        $config['max_size']  = '30000';
        $config['overwrite'] = TRUE;
        $config['remove_spaces'] = TRUE;
        $config['file_name'] = 'test';
        $config['encrypt_name'] = TRUE;

        $this->load->library('upload', $config);
        */
        
        /*
        $name = $_FILES['userfile']['name'];
        $fileNameParts = explode(".", $name);
        $fileExtension = end($fileNameParts);
        $fileExtension = strtolower($fileExtension);
        $enkripsiPic = sh1($name).".".$fileExtension;
        $config['file_name'] = $enkripsiPic;
        */
        
        /*
        $fileExt = explode(' . ', $_FILES['userfile']['name']);
        $fileExt = end($fileExt);
        
        $_FILES['userfile'] = sha1($fileExt).' . '.$fileExt;
        */
        
        // Change $_FILES to new vars and loop them
      
        foreach ($_FILES['userfile'] as $key => $val) 
        {
            $i = 1;
            foreach ($val as $v) 
            {
                
                $field_name = "file_" . $i;
                $_FILES[$field_name][$key] = $v;
                $i++;
            }
        }
        // Unset the useless one ;)
        unset($_FILES['userfile']);

        // Put each errors and upload data to an array
        // $error = array();
        // $success = array();
        // main action to upload each file
        
        foreach ($_FILES as $field_name => $file) 
        {
            if (!$this->upload->do_upload($field_name)) 
            {
                // if upload fail, grab error 
                //$error['upload'][] = $this->upload->display_errors();
                echo $this->image_lib->display_errors();
            } 
            else 
            {
                // otherwise, put the upload datas here.
                // if you want to use database, put insert query in this loop
                $upload_data = $this->upload->data();

                /*
                  $resize_conf = array(
                  // it's something like "/full/path/to/the/image.jpg" maybe
                  'source_image' => $upload_data['full_path'],
                  // and it's "/full/path/to/the/" + "thumb_" + "image.jpg
                  // or you can use 'create_thumbs' => true option instead
                  'new_image' => $upload_data['file_path'] . 'thumb_' . $upload_data['file_name'],
                  'width' => 200,
                  'height' => 200
                  );
                  $this->image_lib->initialize($resize_conf);
                  $this->image_lib->resize();
                  $this->image_lib->clear();
                 */
                
                $ori = $upload_data['file_name'];
                $mr = $upload_data['file_path'] . $ori;
                
                $this->watermarking($mr);
                
                //this is the larger image
                $config['image_library'] = 'gd2';
             
                $config['source_image'] = $upload_data['full_path'];
                $config['new_image'] = 'assets/doc/img/full/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 0;
                $config['height'] = 0;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
                

                //this is the larger image
                $config['image_library'] = 'gd2';
            
                $config['source_image'] = $upload_data['full_path'];
                $config['new_image'] = 'assets/doc/img/medium/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 342;
                $config['height'] = 342;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
                               

                //small image
                $config['image_library'] = 'gd2';
            
                $config['source_image'] = $upload_data['full_path'];
                $config['new_image'] = 'assets/doc/img/small/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 152;
                $config['height'] = 152;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();

                //cropped thumbnail
                $config['image_library'] = 'gd2';
               
                $config['source_image'] = $upload_data['full_path'];
                $config['new_image'] = 'assets/doc/img/thumbnails/' . $upload_data['file_name'];
                $config['maintain_ratio'] = TRUE;
                $config['width'] = 62;
                $config['height'] = 62;
                $this->image_lib->initialize($config);
                $this->image_lib->resize();
                $this->image_lib->clear();
                
                // do it!
                if (!$this->image_lib->resize()) {
                    // if got fail.
                    //$error['resize'][] = $this->image_lib->display_errors();
                    echo $this->image_lib->display_errors();
                } else {
                    // otherwise, put each upload data to an array.
                    $success[] = $upload_data;
                }
            }
        }

        // see what we get
        if (count($error > 0)) {
            $data['error'] = $error;
        } else {
            $data['success'] = $upload_data;
        }

        $data['multiupload'] = "multiupload"; // Controller
        $data['view'] = "index_multiupload"; // View
        $data['module'] = "multiupload"; // Controller
        $data['error'] = ' ';
        
        dump($this->upload->data());
        
        echo Modules::run('template/staff', $data);
    }
    
    function ubah_nama_sh1()
    {
        return sha1($_FILES);
    }

}

/* End of File: multiupload.php */