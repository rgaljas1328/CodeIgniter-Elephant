<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
<div class="layout-main">
    <div class="layout-sidebar">
        <div class="layout-sidebar-backdrop"></div>
        <div class="layout-sidebar-body">
            
                <nav id="sidenav" class="sidenav-collapse collapse">
                    <ul class="sidenav">
                        <li class="sidenav-search hidden-md hidden-lg">
                            <form class="sidenav-form" action="http://demo.naksoid.com/">
                            <div class="form-group form-group-sm">
                                <div class="input-with-icon">
                                <input class="form-control" type="text" placeholder="Search">
                                <span class="icon icon-search input-icon"></span>
                                </div>
                            </div>
                            </form>
                        </li>
                        <li class="sidenav-heading">Record</li>
                            <li class="<?=active_link_controller('groups');?>">
                    
                                <a href="<?=site_url('admin/groups');?>">
                                    <!-- <span class="badge badge-success">26</span> -->
                                    <span class="sidenav-icon icon icon-forward"></span>
                                    <span class="sidenav-label">Security Groups</span>
                                </a>
                            </li>

                            <li class="<?=active_link_controller('users');?>">
                    
                                <a href="<?=site_url('admin/users');?>">
                                    <!-- <span class="badge badge-success">26</span> -->
                                    <span class="sidenav-icon icon icon-forward"></span>
                                    <span class="sidenav-label">User Accounts</span>
                                </a>
                            </li>
                            
                            <li class="sidenav-item">
                    
                                <a href="widgets.html">
                                    <!-- <span class="badge badge-success">26</span> -->
                                    <span class="sidenav-icon icon icon-forward"></span>
                                    <span class="sidenav-label">Salary</span>
                                </a>
                            </li>
                    </ul>
                </nav>
            
        </div>
    </div>  
        
