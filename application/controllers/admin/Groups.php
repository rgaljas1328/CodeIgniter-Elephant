<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Groups extends Admin_Controller {

    public function __construct()
    {
        parent::__construct();

        $this->lang->load('admin/groups');

        /* Title Page :: Common */
        $this->page_title->push(lang('menu_security_groups'));
        $this->data['pagetitle'] = $this->page_title->show();

        /* Breadcrumbs :: Common */
        $this->breadcrumbs->unshift(1, lang('menu_security_groups'), 'admin/groups');
    }

	public function getGroups()
	{
		$response = Requests::get($this->data['apiurl'].'group/', $this->data['authentication']);
		$results = json_decode($response->body);
		$type = $this->input->get('type');
		//DISPLAY TABLE
		if($type == 'table')
		{
			echo "
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id='groups_table'>
				
			
			";
			foreach ($results as $key => $value) {
				echo "
				<tr>
					<td>".$value->name."</td>
					<td>".$value->description."</td>
					<td><button id='edit_".$value->id."' class='btn btn-warning btn-xs'><i class='fa fa-edit'></i> Edit</button>  <a href='#' class='btn btn-xs btn-danger' id='delete_".$value->id."' data-placement='top' title='Delete group?' data-singleton='true' ><i class='fa fa-trash'></i> Delete</a></td>
				</tr>
				";
			}
			echo 
			"</tbody>
			";
		}
		//DISPLAY COMBOBOX
		else if($type == 'option')
		{	
			echo "<option value=''>--Select--</option>";
			foreach ($results as $key => $value) {
				echo "<option value='".$value->id."_".$value->description."'>".$value->description."</option>";
			}
		}
		else {
			$this->getGroup();
		}
		return;
	}

	public function getGroup()
	{
		$id = $this->is_valid_get('id');
		$response = Requests::get($this->data['apiurl'].'group/?id='.$id, $this->data['authentication']);
		echo $response->body;
	}

	public function index()
	{
        if (false)
        {
            redirect('auth/login', 'refresh');
        }
        else
        {
            /* Breadcrumbs */
			$this->data['breadcrumb'] = $this->breadcrumbs->show();
			
            /* Load Template */
            $this->template->admin_render('admin/groups/index', $this->data);
        }
    }

	public function create()
	{
		if (false)
        {
            redirect('auth/login', 'refresh');
        }
        elseif (true)
        {
			$group_name = $this->is_valid_post('group_name');
			$description = $this->is_valid_post('description');

			if( $group_name && $description)
			{
				$data = array(
					'name' => $group_name,
					'description' => $description
				);

				$response = Requests::post($this->data['apiurl'].'group/', $this->data['authentication'], json_encode($data));
				$this->validateRequest($response->status_code);
			}
			else
			{
				$this->BadRequest();
			}
		}
	}

	public function delete()
	{
        if (false)
        {
            redirect('auth/login', 'refresh');
        }
        elseif (true)
		{
			$id = $this->is_valid_get('id');
			
			if($id)
			{
				$response = Requests::delete($this->data['apiurl'].'group/?id='.$id, $this->data['authentication']);
				$this->validateRequest($response->status_code);
			}
			else
			{
				$this->BadRequest();
			}
        }
	}

	public function edit()
	{
		if (false)
        {
            redirect('auth/login', 'refresh');
        }
        elseif (true)
		{
			$id = $this->is_valid_post('groups_modal_id');
			$group_name = $this->is_valid_post('groups_modal_name');
			$description = $this->is_valid_post('groups_modal_description');

			if($id && $group_name && $description)
			{
				$data = array(
					'name' => $group_name,
					'description' => $description
				);

				$response = Requests::put($this->data['apiurl'].'group/?id='.$id, $this->data['authentication'], json_encode($data));
				$this->validateRequest($response->status_code);
			}
			else
			{
				$this->BadRequest();
			}
        }
	}
}
