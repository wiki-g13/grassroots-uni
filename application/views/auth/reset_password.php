
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <?php 
                
                if (!empty($message)) 
                {         
                    //incorrect login
                    echo "<div class=\"alert alert-danger login-alert alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Something went wrong!</strong>$message</div>";                            
                }
            ?>

        </div>
    </div>
    <div class="row">
        <div class="col-md-6">

            <h3>Reset Password</h3>

               <?php echo form_open('auth/reset_password/' . $code);?>

                <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                    <label for="new_password">New Password (at least 6 characters long): </label>
                    <?php echo form_input($new_password);?>
                    <div class="help-block text-danger"><?php echo form_error($new_password['name']); ?></div>
                </div>

                <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                    <label for="confirm_password">Confirm Password</label>
                    <?php echo form_input($new_password_confirm);?>
                    <div class="help-block text-danger"><?php echo form_error($new_password_confirm['name']); ?></div>
                </div>

                <?php echo form_input($user_id);?>
   
                <input class="btn btn-success" name="submit" type="submit" value="Change">

                <?php echo form_close();?>


            </div>

        </div>
    </div>