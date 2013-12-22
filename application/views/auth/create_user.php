


<div class="container">
      <div class="row">
            <div class="col-md-12">
                  
            <?php 
                
                  if (!empty($message)) 
                  {         
                        //incorrect login
                        echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Something went wrong!</strong>$message</div>";                            
                  }
                        
            ?>

            </div>
      </div>
      
      <div class="row">
            <div class="col-md-6">


            <h1>Register</h1>
            <p>Please enter the new users information below.<p>

            <?php echo form_open("register");?>

            <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                  <label for="first_name">First Name</label>
                  <?php echo form_input($first_name);?>
                  <div class="help-block text-danger"><?php echo form_error($first_name['name']); ?></div>
            </div>

            <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                  <label for="last_name">Last Name</label>
                  <?php echo form_input($last_name);?>
                  <div class="help-block text-danger"><?php echo form_error($last_name['name']); ?></div>
            </div>

            <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                  <label for="email">Email</label>
                  <?php echo form_input($email);?>
                  <div class="help-block text-danger"><?php echo form_error($email['name']); ?></div>
            </div>

            <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                  <label for="password">Password</label>
                  <?php echo form_input($password);?>
                  <div class="help-block text-danger"><?php echo form_error($password['name']); ?></div>
            </div>


            <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                  <label for="confirm_password">Confirm Password</label>
                  <?php echo form_input($password_confirm);?>
                  <div class="help-block text-danger"><?php echo form_error($password_confirm['name']); ?></div>
            </div>

            <input type="submit" class="btn btn-success" name="submit" value="Register"  />

            <?php echo form_close();?>


            </div>
      </div>
</div>
