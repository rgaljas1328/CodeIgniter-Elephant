<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();

        /* COMMON :: ADMIN & PUBLIC */
        /* Load */
        
        $this->load->library('PHPRequests');
        $this->load->library('session');
        $this->load->config('common/common_config');
        $this->load->config('common/common_language');
        $this->load->library(array('form_validation', 'template', 'common/mobile_detect'));
        $this->load->helper(array('array', 'language', 'url'));
        

        /* Data */
        $this->data['lang']           = element($this->config->item('language'), $this->config->item('language_abbr'));
        $this->data['charset']        = $this->config->item('charset');
        $this->data['js_dir'] = $this->config->item('js_dir');
        $this->data['assets_dir'] = $this->config->item('assets_dir');
        $this->data['css_dir']    = $this->config->item('css_dir');
        $this->data['fonts_dir']    = $this->config->item('fonts_dir');
        $this->data['avatar_dir']     = $this->config->item('avatar_dir');

        $this->data['apiurl'] = 'http://127.0.0.1:8000/dtr/';
        // $this->data['apiurl'] = 'http://192.168.0.105:8000/dtr/';
        $this->data['authentication'] = array('Authorization' => 'Token 51235bdff7462a92de3c6e0870ca90031a7e0b38');

        /* Any mobile device (phones or tablets) */
        if ($this->mobile_detect->isMobile())
        {
            $this->data['mobile'] = TRUE;

            if ($this->mobile_detect->isiOS()){
                $this->data['ios']     = TRUE;
                $this->data['android'] = FALSE;
            }
            else if ($this->mobile_detect->isAndroidOS())
            {
                $this->data['ios']     = FALSE;
                $this->data['android'] = TRUE;
            }
            else
            {
                $this->data['ios']     = FALSE;
                $this->data['android'] = FALSE;
            }

            if ($this->mobile_detect->getBrowsers('IE')){
                $this->data['mobile_ie'] = TRUE;
            }
            else
            {
                $this->data['mobile_ie'] = FALSE;
            }
        }
        else
        {
            $this->data['mobile']    = FALSE;
            $this->data['ios']       = FALSE;
            $this->data['android']   = FALSE;
            $this->data['mobile_ie'] = FALSE;
        }
    }
    public function isLogin()
    {
        return false;
    }
    public function is_valid_post($variable)
    {
        if (!empty($this->input->post($variable)))
        {   
            return $this->input->post($variable);
        }
        else
        {
            return false;
        }
    }
    public function is_valid_get($variable)
    {
        if (!empty($this->input->get($variable)))
        {   
            return $this->input->get($variable);
        }
        else
        {
            return false;
        }
    }

    public function validateRequest($status_code)
    {
        switch($status_code)
        {
            case '200':
                $this->Ok();
                break;
            case '201':
                $this->Created();
                break;
            case '204':
                $this->Deleted();
                break;
            case '400':
                $this->BadRequest();
                break;
            case '409':
                $this->Conflict();
                break;
            case '404':
                $this->UrlNotFound();
                break;
            case '500':
                $this->InternalServerError();
        }
    }

    public function Ok()
    {
        $result = array(
            'status_code' => '200',
            'status_description' => 'Ok'
        );
        echo json_encode($result);
    }
    public function Created()
    {
        $result = array(
            'status_code' => '201',
            'status_description' => 'Successfully Created!'
        );
        echo json_encode($result);
    }
    public function Deleted()
    {
        $result = array(
            'status_code' => '204',
            'status_description' => 'Successfully Deleted!'
        );
        echo json_encode($result);
    }
    public function BadRequest()
    {
        $result = array(
            'status_code' => '400',
            'status_description' => 'Bad Request'
        );
        echo json_encode($result);
    }
    public function InternalServerError()
    {
        $result = array(
            'status_code' => '500',
            'status_description' => 'Internal Server Error'
        );
        echo json_encode($result);
    }
    public function UrlNotFound()
    {
        $result = array(
            'status_code' => '404',
            'status_description' => 'Url Not Found'
        );
        echo json_encode($result);
    }
    public function Conflict()
    {
        $result = array(
            'status_code' => '409',
            'status_description' => 'Duplicate'
        );
        echo json_encode($result);
    }
}
class Admin_Controller extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();

        // if ( ! $this->ion_auth->logged_in())
        // {
        //     redirect('auth/login', 'refresh');
        // }
        // else
        // {
            /* Load */
            $this->load->config('common/common_config');
            $this->load->library('admin/page_title');
            $this->load->library('admin/breadcrumbs');
            $this->load->helper('menu');
            $this->lang->load(array('admin/main_header', 'admin/main_sidebar', 'admin/footer', 'admin/actions'));

            /* Load library function  */
            $this->breadcrumbs->unshift(0, $this->lang->line('menu_dashboard'), 'admin/dashboard');

            /* Data */
            $this->data['title']       = $this->config->item('title');
            $this->data['title_lg']    = $this->config->item('title_lg');
            $this->data['title_mini']  = $this->config->item('title_mini');
            

        // }
    }
    
}




