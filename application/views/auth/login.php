<?php
defined('BASEPATH') OR exit('No direct script access allowed');

?>
    <div class="login-body">
        <a class="login-brand" href="#">
            <img class="img-responsive" src="../assets/bio.png" alt="Item Monitoring">
        </a>
        <h3 class="login-heading">Daily Time Record</h3>
        <div class="login-form">
            <form data-toggle="validator" id='login'>
                <div class="form-group input-with-icon">
                <input id="username" class="form-control" placeholder="Username" type="text" name="username" spellcheck="false" autocomplete="off" data-msg-required="Please enter your username." required>
                <span class="icon icon-user input-icon"></span>
                </div>
                <div class="form-group input-with-icon">
                <input id="password" class="form-control" placeholder="Password" type="password" name="password" minlength="3" data-msg-minlength="Password must be 6 characters or more." data-msg-required="Please enter your password." required>
                <span class="icon icon-lock input-icon"></span>
                </div>
                <div class="form-group">
                <button class="btn btn-info btn-block" type="submit">Sign in</button>
                </div>
                <div class="form-group">
                    <ul class="list-inline">
                        Don't have an account? <li><a href='#'>Sign Up</a></li>
                    </ul>
                    
                </div>
            </form>
        </div>
    </div>
    
