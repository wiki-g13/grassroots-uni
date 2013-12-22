<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3" style="padding-top:60px;">

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
                

            <div class="panel panel-primary">
                
                <div class="panel-heading">
                    <h3 class="panel-title">Forgot Password</h3>
                </div>
               

                <div class="panel-body">

                	<p>Please enter your Email so we can send you an email to reset your password.</p>
            
                    <?php echo form_open("forgot-password");?>
              
                        <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
                           <?php echo form_input($email);?>
                           <div class="help-block text-danger"><?php echo form_error($email['name']); ?></div>
                        </div>
            
                        <input class="btn btn-lg btn-primary btn-block" name="submit" type="submit" value="Submit">
                                  
                    <?php echo form_close();?>

                </div>
            </div>
            <p class="text-center"><a href="<?= base_url('login'); ?>">Back to login</a></p> 
        </div>
    </div>
</div>