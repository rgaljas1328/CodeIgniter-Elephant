<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="layout-content">
        <div class="layout-content-body">
          <div class="title-bar">
            <h1 class="title-bar-title">
                <span class=" icon icon-wpforms"></span>
                <span class="d-ib">Users</span>
            </h1>
          </div>
          <div class="row gutter-xs">
            <div class="col-md-3">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="reset" class="card-action card-reload" title="Reload"></button>
                    
                  </div>
                  <strong>New User</strong>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="demo-form-wrapper">
                                <form data-toggle="validator" id='insertUser'>
                                    <div class="form-group form-group-sm">
                                        <label for="fname" class="control-label">First Name</label>
                                        <input id="fname" class="form-control input-thin pill" type="text" name="fname" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="mname" class="control-label">Middle Name</label>
                                        <input id="mname" class="form-control input-thin pill" type="text" name="mname" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="lname" class="control-label">First Name</label>
                                        <input id="lname" class="form-control input-thin pill" type="text" name="lname" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="email" class="control-label">Email</label>
                                        <input id="email" class="form-control input-thin pill" type="text" name="email" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="phone" class="control-label">Phone</label>
                                        <input id="phone" class="form-control input-thin pill" type="text" name="phone" required>
                                    </div>
                                    <div class="form-group form-group-sm">
                                        <label for="address" class="control-label">Address</label>
                                        <input id="address" class="form-control input-thin pill" type="text" name="address" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="address" class="control-label">Group</label>
                                        <select id="selectGroup" name="selectGroup" class="custom-select custom-select-sm input-thin pill" required>
                                            <option value="" selected="">--Small--</option>
                                            
                                        </select>
                                        
                                    </div>
                                    <div class="form-group" id="password">
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
            <div class="col-md-9">
              <div class="card">
                <div class="card-header">
                  <div class="card-actions">
                    <button type="button" class="card-action card-toggler" title="Collapse"></button>
                    <button type="button" class="card-action card-reload" title="Reload"></button>
                   
                  </div>
                  <strong>List of Category</strong>
                </div>
                <div class="card-body">
                    <table id='listofCategory' class="table table-bordered table-nowrap dataTable">
                      
                    </table>
                </div>
            </div>
          </div>
          
        </div>
      </div>
<script>
    $(function(){
        GET('<?=base_url('admin/groups/getGroups')?>', 'option', 'selectGroup', 'html');

        $(document).on('change','#selectGroup', function(e) {
            e.preventDefault();
            let group = $(this).val().split('_')[1].toLowerCase();
            
            if(group == 'administrator' || group == 'admin')
            {
                $('#password').html('<label for="password" class="control-label">Password</label><input id="password" class="form-control input-thin pill" type="password" name="password" required>');
            }
            else
            {
                $('#password').html('');
            }
        });


        $(document).on('submit', '#insertUser', function(e){
            e.preventDefault();
            POST('<?=base_url('admin/users/create')?>', $(this).serialize(), "insertUser");
        })
    })
</script>