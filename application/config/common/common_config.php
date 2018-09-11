<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Base Site URL
|--------------------------------------------------------------------------
|
*/
// Possible hosts locally. You can add some if needed.
$config['host_dev'] = array('localhost', '127.0.0.1', '::1', '192.168.0.105');

// Fill in the file of your project here when you develop locally.
$host_dev = 'DTR-OnlinePortal';

// Fill in the domain name here when your project is online.
// Example : www.johndoe.com
//           johndoe.com
$host_prod = 'www.dtr-op.com';

// WARNING: Do not modify the lines below
$domain = (in_array($_SERVER['HTTP_HOST'], $config['host_dev'], TRUE)) ? $_SERVER['HTTP_HOST'] . '/' . $host_dev : $host_prod;

$config['base_url'] = ( ! empty($_SERVER['HTTPS'])) ? 'https://' . $domain : 'http://' . $domain;

/*
|--------------------------------------------------------------------------
| Index File
|--------------------------------------------------------------------------
|
*/
$config['index_page'] = '';

/*
|--------------------------------------------------------------------------
| Assets
|--------------------------------------------------------------------------
|
*/
$config['assets_dir']     = 'assets';
$config['css_dir'] = $config['assets_dir'] . '/css';
$config['js_dir']    = $config['assets_dir'] . '/js';
$config['fonts_dir']    = $config['assets_dir'] . '/fonts';



/*
|--------------------------------------------------------------------------
| Upload
|--------------------------------------------------------------------------
|
*/
$config['upload_dir']     = 'upload';
$config['avatar_dir']     = $config['upload_dir'] . '/avatar';

/*
|--------------------------------------------------------------------------
| Application
|--------------------------------------------------------------------------
|
*/

$config['title']      = 'DTR - Online Portal';
$config['title_mini'] = 'IC Enrollment';
$config['title_lg']   = 'IC Enrollment';



/* Display panel login */
$config['auth_social_network'] = FALSE;
$config['forgot_password']     = FALSE;
$config['new_membership']      = FALSE;



/*
 * **********************
 * Elephant
 * **********************
 */
/* Page Title */
$config['pagetitle_open']     = '<h1>';
$config['pagetitle_close']    = '</h1>';
$config['pagetitle_el_open']  = '<small>';
$config['pagetitle_el_close'] = '</small>';

/* Breadcrumbs */
$config['breadcrumb_open']     = '<ol class="breadcrumb">';
$config['breadcrumb_close']    = '</ol>';
$config['breadcrumb_el_open']  = '<li>';
$config['breadcrumb_el_close'] = '</li>';
$config['breadcrumb_el_first'] = '<i class="fa fa-dashboard"></i>';
$config['breadcrumb_el_last']  = '<li class="active">';