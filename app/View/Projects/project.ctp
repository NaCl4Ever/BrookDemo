
<?php
$this->Html->addCrumb($category, '/projects/show/'.$categoryId);
$this->Html->addCrumb($projectName, '/projects/show/'.$category.'/'.$projectId);

echo "<h1>".$project['Project']['name']."</h1>";
?>
<button id = "print-button" class="btn btn-default" type="button">Print Page</button>
<div class = "col-xs-12 col-md-4">
    <?php 
        echo $project['Project']['scope'];
    ?>
</div>  
<div class = "col-xs-12 col-md-4">
    <?php
        echo $this->Html->image(substr($selectedImage['path'],45), array('alt' => $selectedImage['name'], 'id' => 'selected-project-image'));
    ?>
    <div class="row">
        
           <?php
               
                foreach($images as $image)
                {   echo '<div class="col-xs-6 col-md-4">';
                    echo '<a class="thumbnail">';
                    echo $this->Html->image(substr($image['ProjectImage']['path'],45), array('alt' => $image['ProjectImage']['name']));
                    echo '</a></div>';

                }
                
            ?>      
        
    </div>
</div>
<div class = "col-xs-12 similar-projects">
    <h1>Similar Projects</h1>
    <div class="row">
        <?php
            foreach($relatedImages as $image)
            {   
                echo '<div class = "related-section col-xs-6 col-md-4">';
                echo $this->Html->image(substr($image['projImg']['path'],45), array('alt' => $image['projImg']['name']));
                echo '<div class = "cover"> <p>'.$image['proj']['name'].'</p> </div>'; 
                echo '</div>';
            }
        ?>      
        
    </div>
</div>
<script>
$('.thumbnail').on('click', function(e){
    $(this).addClass('selected').siblings().removeClass('selected');
    $('#selected-project-image').attr('src', $(this).children()[0].src);
    
});
$('#print-button').on('click', function(){
    window.print();
})
</script>