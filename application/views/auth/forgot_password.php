<div class="container">
    <div class="row">
        <div class="col-md-12">
                <?php 
                
                $email_sent = "Password reset email sent, please check your email.";

                if (!empty($message)) 
                {
                   
                    if ($this->session->flashdata('message') == $email_sent) 
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
        <div class="col-md-6">

                <h3>Forgot Password</h3>

                	<p>Please enter your Email so we can send you an email to reset your password.</p>
            
                    <?php echo form_open("forgot-password");?>
              
                        <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                           <?php echo form_input($email);?>
                           <div class="help-block text-danger"><?php echo form_error($email['name']); ?></div>
                        </div>
            
                        <input class="btn btn-success" name="submit" type="submit" value="Submit">
                                  
                    <?php echo form_close();?>

            <p style="margin:10px 0;"><a href="<?=base_url('login'); ?>">Back to login</a></p> 
        </div>
    </div>
</div>