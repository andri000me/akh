<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class MY_Controller extends MX_Controller {

    public $data = array();

    function __construct()
    {
        parent::__construct();
        // $this->data['errors'] = array();
        // $this->data['site_name'] = config_item('site_name');
    }

}