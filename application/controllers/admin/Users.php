<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        /* Load :: Common */
        $this->lang->load('admin/users');

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_users'));
        $this->data['pagetitle'] = $this->page_title->show();
		
        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_users'), 'admin/users');
    }


    public function index()
    {
        $this->template->admin_render('admin/users/index', $this->data);
    }
    public function create()
    {
        if (false)
        {
            redirect('auth/login', 'refresh');
        }
        elseif (true)
        {
			$first_name = $this->is_valid_post('fname');
            $middle_name = $this->is_valid_post('mname');
            $last_name = $this->is_valid_post('lname');
            $email = $this->is_valid_post('email');
            $phone = $this->is_valid_post('phone');
            $address = $this->is_valid_post('address');
            $groupID_id = $this->is_valid_post('selectGroup');
            $password = $this->is_valid_post('password');
           

			if( $first_name && $middle_name && $last_name && $email && $phone && $address && $groupID_id )
			{
                $group = explode('_',$groupID_id);
				$data = array(
					'first_name' => $first_name,
                    'middle_name' => $middle_name,
                    'last_name' => $last_name,
                    'email' => $email,
                    'phone' => $phone,
                    'address' => $address,
                    'first_name' => $first_name,
                    'created' => date('Y-m-d H:i:s'),
                    'modified' => date('Y-m-d H:i:s'),
                    'password' => $password,
                    'status' => 'Active',
                    'groupID_id' => $group[0]
				);
                var_dump($data);
				$response = Requests::post($this->data['apiurl'].'users/', $this->data['authentication'], json_encode($data));
				$this->validateRequest($response->status_code);
			}
			else
			{
				$this->BadRequest();
			}
		}
    }
}
