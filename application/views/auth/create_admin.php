<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
    <div class="login-logo">
        <center>
        <img src="<?php echo base_url('assets/bio.png') ?>" class="img-responsive" alt="USTP Logo" style="width:200px;height:200px;">
        </center>
        
        <a href="#"><small><b>D</b>aily <b>T</b>ime <b>R</b>ecord</small></a><hr />
    </div>

            <div class="login-box-body">
                
                

                <?php echo form_open(current_url(), array("id" => "create_user")); ?>
                                <div class="box-body">
                                <p class="login-box-msg">Create administrator account</p>
                                    
                                            <?php echo lang('users_firstname', 'first_name'); ?>
                                            <?php echo form_input($first_name);?>
                                        
                                            <?php echo lang('users_lastname', 'last_name'); ?>
                                            
                                                <?php echo form_input($last_name);?>

                                        
                                            <?php echo lang('users_company', 'company'); ?>
                                            
                                                <?php echo form_input($company);?>

                                        
                                            <?php echo lang('users_email', 'email'); ?>
                                            
                                                <?php echo form_input($email);?>

                                       
                                            <?php echo lang('users_phone', 'phone'); ?>
                                            
                                                <?php echo form_input($phone);?>

                                        
                                            <?php echo lang('users_password', 'password'); ?>
                                            
                                                <?php echo form_input($password);?>
                                                <div class="progress" style="margin:0">
                                                    <div class="pwstrength_viewport_progress"></div>
                                                </div>
                                        
                                            <?php echo lang('users_password_confirm', 'password_confirm'); ?>
                                            
                                                <?php echo form_input($password_confirm);?>

                                       
                                    
                                </div>
                                <!-- /.box-body -->

                                <div class="box-footer">
                                    <div class='pull-right'>
                                        <button type="submit" class="btn btn-success"><i class="fa fa-check"></i> Submit</button> &nbsp;
                                        <button type="reset" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button> &nbsp;
                                        <a class="btn btn-warning" href="<?php echo site_url('auth/login'); ?>">Cancel</a>
                                    </div>
                                </div>
                                <?php echo form_close(); ?>




            </div>


