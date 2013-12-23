<h1>Edit User</h1>
<p>Please edit the users information below.</p>

<?php 
                
      if (!empty($message)) 
      {         
            //incorrect login
            echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Something went wrong!</strong>$message</div>";                            
      }
                        
?>

<div class="form-container">

      <?php echo form_open(uri_string());?>

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
            <label for="password">Password: (if changing password)</label>
            <?php echo form_input($password);?>
      </div>


      <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
            <label for="password_confirm">Confirm Password: (if changing password)</label>
            <?php echo form_input($password_confirm);?>
      </div>


      <div class="form-group">

              <?php foreach ($groups as $group):?>

                   <label class="checkbox-inline">

                 <?php
                      
                  $gID     = $group['id'];
                      $checked = null;
                      $item    = null;

                  foreach($currentGroups as $grp) 
                  {
                                 if ($gID == $grp->id)
                        {
                                      $checked= ' checked="checked"';
                                    break;
                              }
                      }
                   
                  ?>
                    
                  <input type="checkbox" name="groups[]" value="<?php echo $group['id'];?>"<?php echo $checked;?>>
                    <?php echo $group['description'];?>  
                  </label>

            <?php endforeach ?>
      </div>

      <?php echo form_hidden('id', $user->id);?>
     
      <input type="submit" class="btn btn-primary" name="submit" value="Save User"  />

      <?php echo form_close();?>

</div>