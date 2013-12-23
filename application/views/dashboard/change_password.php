<h2>Change Password</h2>

    <?php 
                
    $password_changed = "Your password was successfully changed.";

    if (!empty($message)) 
    {         
        if ($this->session->flashdata('message') == $password_changed) 
        {
            echo "<div class=\"alert alert-success alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Yippee!</strong><p>$message</p></div>";
                       
        } else {

            //incorrect login
            echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Something went wrong!</strong>$message</div>";
                             
        }
    }
                        
    ?>



        <?php echo form_open("settings/change-password");?>

        <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
            <label for="old_password">Old Password</label>
            <?php echo form_input($old_password);?>
            <div class="help-block text-danger"><?php echo form_error($old_password['name']); ?></div>
        </div>

        <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
            <label for="new_password">New Password (at least 8 characters long)</label>
            <?php echo form_input($new_password);?>
            <div class="help-block text-danger"><?php echo form_error($new_password['name']); ?></div>
        </div>

        <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
            <label for="new_password_confirm">New Password Confirm</label>
            <?php echo form_input($new_password_confirm);?>
            <div class="help-block text-danger"><?php echo form_error($new_password_confirm['name']); ?></div>
        </div>

        <?php echo form_input($user_id);?>

        <input type="submit" class="btn btn-primary" name="submit" value="Change"  />

        <?php echo form_close();?>



       