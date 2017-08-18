<?php 
            foreach($projects as $project)
            {
                
                echo $project['Project']['id'];
                echo $project['Project']['name'];
                echo $project['Project']['scope'];
            }
        ?>