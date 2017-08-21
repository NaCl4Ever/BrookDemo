
        <div class="page-header">
            <h1>Project Categories</h1>
        </div>
        <?php 
            foreach($categories as $category)
            { 
               echo '<button class="btn btn-default">';
               echo $this->Html->link(
                $category['cate']['description'],
                'show/'.$category['cate']['id'],
                array('class' => 'button')
               );
               echo ' <span class = "badge">'.$category[0]['count'].'</span></button>';
            }
        ?>
