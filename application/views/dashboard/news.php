<?php
                                   
    foreach ($news as $new)
    {
                
        $id = $new['id'];
        $title = $new['news_title'];
        $content = $new['news_content'];
        $created = $new['created_at'];

        echo "
        <div class=\"panel panel-default\">
            <div class=\"panel-body\">

            <h3>$title</h3>
            <hr>
            <p>$content</p>
            <hr>
            <strong>$created</strong>
    
            </div>
        </div> ";

                                                 
    }
            
?>


