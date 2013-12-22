
<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="padding-top:60px;">

            <img src="<?php echo base_url(); ?>assets/img/logo.png" alt="Trident Logo" style="display:block;margin:20px auto;"></img>

            <div class="panel panel-primary">

                
                <div class="panel-heading">
                    <h3 class="panel-title">Change Password</h3>
                </div>
                <?php 
                
                if (!empty($message)) 
                {         
                    //incorrect login
                    echo "<div class=\"alert alert-danger login-alert alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Something went wrong!</strong>$message</div>";                            
                }
                        
                ?>
               
               <div class="panel-body">

               <?php echo form_open('auth/reset_password/' . $code);?>

                <div class="form-group">
                    <label for="new_password">New Password (at least 6 characters long): </label>
                    <?php echo form_input($new_password);?>
                    <div class="help-block text-danger"><?php echo form_error($new_password['name']); ?></div>
                </div>

                <div class="form-group">
                    <?php echo lang('reset_password_new_password_confirm_label', 'new_password_confirm');?> <br />
                    <?php echo form_input($new_password_confirm);?>
                    <div class="help-block text-danger"><?php echo form_error($new_password_confirm['name']); ?></div>
                </div>

                <?php echo form_input($user_id);?>
   
                <input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Change">

                <?php echo form_close();?>


                </div>
            </div>

        </div>
    </div>