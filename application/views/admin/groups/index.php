<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="layout-content">
        <!-- Modal -->
        <div id="edit_groups_modal" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <form method='post' id='form_edit_group'>
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true"></span></button>
                            <h4 class="modal-title">Edit Group</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="box-body">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <input type='hidden' name='groups_modal_id' id='groups_modal_id'>
                                            <label for="groups_modal_name">Name</label>
                                            <input type="text" name="groups_modal_name" id="groups_modal_name" placeholder="Group Name" required="" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="groups_modal_description">Description</label>
                                            <input type="text" name="groups_modal_description" id="groups_modal_description" placeholder="Description" required="" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-warning pull-left" data-dismiss="modal"><i class='fa fa-close'></i> Close</button>
                            <button type="submit" class="btn btn-success"><i class='fa fa-check'></i> Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- /.Modal -->
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
                <span class=" icon icon-wpforms"></span>
                <span class="d-ib">Security Groups</span>
            </h1>
          </div>
          <div class="row gutter-xs">
            <div class="col-md-4">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="reset" class="card-action card-reload" title="Reload"></button>
                    
                  </div>
                  <strong>New Security Groups</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="demo-form-wrapper">
                                <form data-toggle="validator" id='create_group'>
                                    <div class="form-group form-group-sm">
                                        <label for="group_name">Group name</label>
                                        <input type='text' id='group_name' name='group_name'  placeholder="Group name" class="form-control input-thin pill">
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="description">Description</label>
                                        <input type='text' id='description' name='description'  placeholder="Description" class="form-control input-thin pill">
                                    </div>
                                    <div class="form-group pull-right">
                                        <div class="col-xs-12">
                                        <button type="submit" class="btn btn-primary">
                                            <span class="icon icon-download icon-xs icon-fw"></span>
                                            Save
                                        </button>
                                        <button type="reset" class="btn btn-info">
                                            <span class="icon icon-refresh icon-xs icon-fw"></span>
                                            Clear
                                        </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="col-md-8">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                   
                  </div>
                  <strong>List of Category</strong>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-nowrap dataTable no-footer" role="grid" id='groupTable'>
                        <thead>
                            <tr role="row">
                                <th class="sorting" tabindex="0" aria-controls="listofCategory" rowspan="1" colspan="1" aria-label="Category Name: activate to sort column ascending" style="width: 302px;"><?php echo lang('groups_name');?></th>
                                <th class="sorting" tabindex="0" aria-controls="listofCategory" rowspan="1" colspan="1" aria-label="Category Name: activate to sort column ascending" style="width: 302px;"><?php echo lang('groups_description');?></th>
                                <th class="sorting" tabindex="0" aria-controls="listofCategory" rowspan="1" colspan="1" aria-label="Category Name: activate to sort column ascending" style="width: 302px;"><?php echo lang('groups_action');?></th>
                            </tr>
                        </thead>
                        <tbody id='groups_table'>
                            
                        </tbody>
                    </table>
                </div>
            </div>
          </div>
          
        </div>
      </div>
<script>

$(function(){
    $('#groupTable').DataTable();
    All();
    
    function All()
    {
        GET('<?=base_url('admin/groups/getGroups')?>', 'table', 'groupTable');
    }

    $('#create_group').on('submit', function(e){
        e.preventDefault();
        POST('<?=base_url('admin/groups/create')?>', $(this).serialize(), "create_group");
    });

    $(document).on('mouseover', 'a[id^="delete_"]', function(e){
        e.preventDefault();
        let id = ($(this)[0].id).split('_')[1];
        $('#'+$(this)[0].id+'').confirmation({
            onConfirm: function(){
                DELETE('<?=base_url('admin/groups/delete')?>', {id : id});
            },
            onCancel: function(){}
        });
    });
    
    $(document).on('click', 'button[id^="edit_"]', function(){
        var id = ($(this)[0].id).split('_')[1];
        GET('<?=base_url('admin/groups/getGroups')?>', id, '', 'json').then(function(data){
            $('#groups_modal_id').val(id);
            $('#groups_modal_name').val(data.name);
            $('#groups_modal_description').val(data.description);
            $('#edit_groups_modal').modal('show');
        });
    });

    $(document).on('submit', '#form_edit_group', function(e){
        e.preventDefault();
        PUT('<?=base_url('admin/groups/edit')?>', $(this).serialize(), "form_edit_group" , 'edit_groups_modal');
    });
});
</script>