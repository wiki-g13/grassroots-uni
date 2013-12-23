      <h1>Edit News</h1>

      <p>Please edit the news below</p>

      <?php 
                
      if (!empty($message)) 
      {         
            //if form error
            echo "<div class=\"alert alert-danger alert-dismissable\"><button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">&times;</button><strong>Something went wrong!</strong>$message</div>";                            
      }                     
      
      ?>

      <?php echo form_open(uri_string());?>

      <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
            <label for="first_name">Title</label>
            <?php echo form_input($news_title); ?>
            <div class="help-block text-danger"><?php echo form_error($news_title['name']); ?></div>
      </div>

      <div class="form-group <?php if(validation_errors()){ echo "has-error"; } ?>">
            <label for="first_name">News Content</label>
            <?php echo form_textarea($news_content); ?>
            <div class="help-block text-danger"><?php echo form_error($news_content['name']); ?></div>
      </div>


      <p><b>Add a WYSIWYG editor ^</b></p>

      <input type="submit" class="btn btn-primary" name="submit" value="Save News"  />

      <?php echo form_close();?>

