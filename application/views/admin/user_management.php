<h1>User Management</h1>
<p>Here you can manage the users of the site, only the administrator user group can see/use this.</p>

<?php echo $message;?>
     
<div class="table-responsive">
    <table class="table table-hover">
                                     
            <thead>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email</th>                      
                    <th>Action</th>                             
            </thead>
                                   
            <?php foreach ($users as $user):?>
                    <tr>
                            <td><?php echo $user->first_name;?></td>
                            <td><?php echo $user->last_name;?></td>
                            <td><?php echo $user->email;?></td>
                            <td>
                                    <?php 

                                  echo anchor("admin/users/edit/".$user->id, 'Edit');

                                  //display delete function for all users with an id greate than 1 
                                  //there is a fallback if they try to delete the root admin they wont be able to coz swag
                                  if($user->id > 1)
                                  {
                                          echo " | ";
                                    echo anchor("admin/users/delete/".$user->id, 'Delete', array('onClick' => 'return confirm(\'Are you sure you want to delete this user, this function cannot be reversed!\')'));
                      }

                                ?>
                            </td>   
                    </tr>
            <?php endforeach;?>
                            
    </table>
</div> <!-- ./end of table -->
