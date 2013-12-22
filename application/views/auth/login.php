<div class="container">
    <div class="row">
        <div clas="col-md-12">


                <?php 

                //ion auth is a pain when it comes to validation
                //this is the quickest work around i could think of for success/error messages

                $logout_success = 'Logout was successful';
                $password_changed = 'Password successfully changed';

                if (!empty($message)) 
                {
                   
                    if ($this->session->flashdata('message') == $logout_success) 
                    {
                        echo "<div class=\"alert alert-success login-alert alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Yippee!</strong><p>$message</p></div>";
                    } 
                    elseif ($this->session->flashdata('message') == $password_changed)
                    { 
                        echo "<div class=\"alert alert-success login-alert alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Yippee!</strong><p>$message</p></div>";
                    } 
                    else 
                    {
                        //incorrect login
                        echo "<div class=\"alert alert-danger login-alert alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Something went wrong!</strong>$message</div>";
                    }
                }

                ?> 

        </div>
    </div>
    <div class="row">
        <div class="col-md-4">



            <h3>Login</h3>
               

           
            
                    <?php echo form_open("login");?>
              
                        <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                            <?php echo form_input($identity);?>
                            <div class="help-block text-danger"><?php echo form_error($identity['name']); ?></div>
                        </div>
                    
                        <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                            <?php echo form_input($password);?>
                            <div class="help-block text-danger"><?php echo form_error($password['name']); ?></div>
                        </div>
                    
                        <div class="checkbox">                    
                            <label>
                                <?php echo form_checkbox('remember', '1', FALSE, 'id="remember"');?> Remember Me
                            </label>
                        </div>
                    
                        <input class="btn btn-success" name="submit" type="submit" value="Login">
                                  
                    <?php echo form_close();?>
   
         
            <p style="margin:10px 0;"><a href="<?= base_url('forgot-password'); ?>">Forgot your password?</a></p>
             
        </div>
    </div>
</div>