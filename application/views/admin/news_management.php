<h1>News Management</h1>
<p>Here you can manage the news updates of the site, , only the administrator user group can see/use this.</p>

<? echo $message; ?>
     
<div class="table-responsive">
    <table class="table table-hover">
                                     
            <thead>
                <th>Title</th>
                <th>Created</th>                   
                <th>Action</th>                             
            </thead>
                                   
            <?php
                                   
            foreach ($news as $new)
            {
                
                $id = $new['id'];
                $title = $new['news_title'];
                $created = $new['created_at'];

                                                          
                echo "<tr>";
                echo "<td>$title</td>";
                echo "<td>$created</td>";
                echo "<td><a href=\"news/edit/$id\">Edit</a> - <a href=\"news/delete/$id\" onClick=\"return confirm('Are you sure you want to delete this news post, this function cannot be reversed!')\">Delete</td>";
                echo "</tr>";
            }
            
            ?>
                            
    </table>

    <a class="btn btn-primary" href="news/add">Create News Post</a>
</div> <!-- ./end of table -->
