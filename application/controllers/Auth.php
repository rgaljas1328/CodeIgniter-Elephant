<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends MY_Controller {

	function __construct()
	{
		parent::__construct();
		
	}


	function index()
	{
		
        if ( ! $this->isLogin())
        {
			redirect('auth/login', 'refresh');
        }
        else
        {
            redirect('/', 'refresh');
        }
	}
	public function login()
	{
		$this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');
		$this->data['identity'] = array(
			'name'        => 'identity',
			'id'          => 'identity',
			'type'        => 'email',
			'value'       => $this->form_validation->set_value('identity'),
			'class'       => 'form-control',
			'placeholder' => lang('auth_your_email')
		);
		$this->data['password'] = array(
			'name'        => 'password',
			'id'          => 'password',
			'type'        => 'password',
			'class'       => 'form-control',
			'placeholder' => lang('auth_your_password')
		);
		$this->data['title']               = $this->config->item('title');
		$this->data['title_lg']            = $this->config->item('title_lg');
		$this->data['auth_social_network'] = $this->config->item('auth_social_network');
		$this->data['forgot_password']     = $this->config->item('forgot_password');
		$this->data['new_membership']      = $this->config->item('new_membership');
		$this->template->auth_render('auth/login', $this->data);
	}


 //    function login()
	// {
 //        if ( ! $this->ion_auth->logged_in())
 //        {
 //            /* Load */
 //            $this->load->config('admin/dp_config');
 //            $this->load->config('common/dp_config');

 //            /* Valid form */
 //            $this->form_validation->set_rules('identity', 'Identity', 'required');
 //            $this->form_validation->set_rules('password', 'Password', 'required');

 //            /* Data */
 //            $this->data['title']               = $this->config->item('title');
 //            $this->data['title_lg']            = $this->config->item('title_lg');
 //            $this->data['auth_social_network'] = $this->config->item('auth_social_network');
 //            $this->data['forgot_password']     = $this->config->item('forgot_password');
 //            $this->data['new_membership']      = $this->config->item('new_membership');

 //            if ($this->form_validation->run() == TRUE)
 //            {
 //                $remember = (bool) $this->input->post('remember');

 //                if ($this->ion_auth->login($this->input->post('identity'), $this->input->post('password'), $remember))
 //                {
 //                    if ($this->ion_auth->is_admin())
 //                    {
 //                        /* Data */
 //                        $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

 //                        /* Load Template */
 //                        //$this->template->auth_render('auth/choice', $this->data);
 //                        $this->session->set_userdata('ugroup', 'admin');
 //                        redirect('admin/dashboard', 'refresh');
                        
 //                    }
 //                    else
 //                    {

 //                        /* 
 //                        1 - Chairman
 //                        2 - Assessor
 //                        3 - Registrar
 //                        */
 //                        $ugroup = array();

 //                        if ($this->ion_auth->is_chairman()) 
 //                        {
 //                            array_push($ugroup, '1');
 //                        }
 //                        /*if ($this->ion_auth->is_assessor()) 
 //                        {
 //                            array_push($ugroup, '2');
 //                        }
 //                        if ($this->ion_auth->is_registrar()) 
 //                        {
 //                            array_push($ugroup, '3');
 //                        }
 //                      */
 //                        if ($ugroup == null)
 //                        {
 //                            $this->session->set_flashdata('message', $this->ion_auth->messages());
 //                            redirect('/', 'refresh');
 //                        }
                            
 //                        $this->session->set_userdata('ugroup', $ugroup);
 //                        redirect('admin/dashboard', 'refresh');
 //                    }
 //                }
 //                else
 //                {
 //                    $this->session->set_flashdata('message', $this->ion_auth->errors());
	// 			    redirect('auth/login', 'refresh');
 //                }
 //            }
 //            else
 //            {
 //                $this->data['message'] = (validation_errors()) ? validation_errors() : $this->session->flashdata('message');

 //                $this->data['identity'] = array(
 //                    'name'        => 'identity',
 //                    'id'          => 'identity',
 //                    'type'        => 'email',
 //                    'value'       => $this->form_validation->set_value('identity'),
 //                    'class'       => 'form-control',
 //                    'placeholder' => lang('auth_your_email')
 //                );
 //                $this->data['password'] = array(
 //                    'name'        => 'password',
 //                    'id'          => 'password',
 //                    'type'        => 'password',
 //                    'class'       => 'form-control',
 //                    'placeholder' => lang('auth_your_password')
 //                );

 //                /* Load Template */
 //                $this->template->auth_render('auth/login', $this->data);
 //            }
 //        }
 //        else
 //        {
 //           redirect('/', 'refresh');
 //        }
 //   }
 //   function create_user()
	// {
	// 	$this->data['title'] = "Create User";

		

	// 	$tables = $this->config->item('tables','ion_auth');

	// 	// validate form input
	// 	$this->form_validation->set_rules('first_name', $this->lang->line('create_user_validation_fname_label'), 'required');
	// 	$this->form_validation->set_rules('last_name', $this->lang->line('create_user_validation_lname_label'), 'required');
	// 	$this->form_validation->set_rules('email', $this->lang->line('create_user_validation_email_label'), 'required|valid_email|is_unique['.$tables['users'].'.email]');
	// 	$this->form_validation->set_rules('phone', $this->lang->line('create_user_validation_phone_label'), 'required');
	// 	$this->form_validation->set_rules('company', $this->lang->line('create_user_validation_company_label'), 'required');
	// 	$this->form_validation->set_rules('password', $this->lang->line('create_user_validation_password_label'), 'required|min_length[' . $this->config->item('min_password_length', 'ion_auth') . ']|max_length[' . $this->config->item('max_password_length', 'ion_auth') . ']|matches[password_confirm]');
	// 	$this->form_validation->set_rules('password_confirm', $this->lang->line('create_user_validation_password_confirm_label'), 'required');

	// 	if ($this->form_validation->run() == true)
	// 	{
	// 		$username = strtolower($this->input->post('first_name')) . ' ' . strtolower($this->input->post('last_name'));
	// 		$email    = strtolower($this->input->post('email'));
	// 		$password = $this->input->post('password');

	// 		$additional_data = array(
	// 			'first_name' => $this->input->post('first_name'),
	// 			'last_name'  => $this->input->post('last_name'),
	// 			'company'    => $this->input->post('company'),
	// 			'phone'      => $this->input->post('phone'),
	// 		);
	// 	}
	// 	if ($this->form_validation->run() == true && $this->ion_auth->register($username, $password, $email, $additional_data))
	// 	{
	// 		// check to see if we are creating the user
	// 		// redirect them back to the admin page
	// 		$this->session->set_flashdata('message', $this->ion_auth->messages());
	// 		redirect("auth", 'refresh');
	// 	}
	// 	else
	// 	{
	// 		// display the create user form
	// 		// set the flash data error message if there is one
	// 		$this->data['message'] = (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->session->flashdata('message')));

	// 		$this->data['first_name'] = array(
	// 			'name'  => 'first_name',
	// 			'id'    => 'first_name',
 //                'type'  => 'text',
 //                'class' => 'form-control',
 //                'placeholder' => 'First Name',
	// 			'value' => $this->form_validation->set_value('first_name'),
	// 		);
	// 		$this->data['last_name'] = array(
	// 			'name'  => 'last_name',
	// 			'id'    => 'last_name',
 //                'type'  => 'text',
 //                'class' => 'form-control',
 //                'placeholder' => 'Last Name',
	// 			'value' => $this->form_validation->set_value('last_name'),
	// 		);
	// 		$this->data['email'] = array(
	// 			'name'  => 'email',
	// 			'id'    => 'email',
 //                'type'  => 'email',
 //                'class' => 'form-control',
 //                'placeholder' => 'Email address',
	// 			'value' => $this->form_validation->set_value('email'),
	// 		);
	// 		$this->data['company'] = array(
	// 			'name'  => 'company',
	// 			'id'    => 'company',
 //                'type'  => 'text',
 //                'class' => 'form-control',
 //                'placeholder' => 'Organization',
	// 			'value' => $this->form_validation->set_value('company'),
	// 		);
	// 		$this->data['phone'] = array(
	// 			'name'  => 'phone',
	// 			'id'    => 'phone',
 //                'type'  => 'text',
 //                'class' => 'form-control',
 //                'placeholder' => 'Phone #',
	// 			'value' => $this->form_validation->set_value('phone'),
	// 		);
	// 		$this->data['password'] = array(
	// 			'name'  => 'password',
	// 			'id'    => 'password',
 //                'type'  => 'password',
 //                'class' => 'form-control',
 //                'placeholder' => 'Password',
	// 			'value' => $this->form_validation->set_value('password'),
	// 		);
	// 		$this->data['password_confirm'] = array(
	// 			'name'  => 'password_confirm',
	// 			'id'    => 'password_confirm',
 //                'type'  => 'password',
 //                'class' => 'form-control',
 //                'placeholder' => 'Re-type password',
	// 			'value' => $this->form_validation->set_value('password_confirm'),
	// 		);

	// 		$this->template->auth_render('auth/create_admin', $this->data);
	// 	}
	// }

    
 //    function logout($src = NULL)
	// {
 //        $logout = $this->ion_auth->logout();

        

 //        if ($src == 'admin')
 //        {
 //            $this->session->set_flashdata('message', $this->ion_auth->messages());
 //            redirect('auth/login', 'refresh');
 //        }
 //        else
 //        {
 //            redirect('auth/login', 'refresh');
 //        }
	// }

}
