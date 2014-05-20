<?php

class Upload extends Front_Controller {

	function __construct()
	{
		parent::__construct();
		$this->load->helper(array('form', 'url'));
	}

	function index()
	{
            //$this->load->view('upload_form', array('error' => ' ' ));
            
            $data['error'] = ' ';
            $data['dokumen'] = "upload"; // Controller
            $data['view'] = "upload_form"; // View
            $data['module'] = "dokumen"; // Controller

            echo Modules::run('template/admin', $data);
	}

	function do_upload()
	{
		$config['upload_path'] = './assets/doc/';
		$config['allowed_types'] = 'gif|jpg|png';
		$config['max_size']	= '100';
		$config['max_width']  = '1024';
		$config['max_height']  = '768';

		$this->load->library('upload', $config);

                $error = array('error' => $this->upload->display_errors());

		if ( ! $this->upload->do_upload())
		{
			$data['error'] = $error;

            $data['dokumen'] = "upload"; // Controller
            $data['view'] = "upload_form"; // View
            $data['module'] = "dokumen"; // Controller

            echo Modules::run('template/admin', $data);
		}
		else
		{
			$data = array('upload_data' => $this->upload->data());
            $data['upload_data'] = $this->upload->data();
            $data['error'] = $error;
            $data['dokumen'] = "upload"; // Controller
            $data['view'] = "upload_success"; // View
            $data['module'] = "dokumen"; // Controller

            echo Modules::run('template/admin', $data);
		}
	}
}
?>