<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->load->helper('number');
        
    }


	public function index()
	{
        
        $this->template->admin_render('admin/dashboard/index', $this->data);
        
	}
}
