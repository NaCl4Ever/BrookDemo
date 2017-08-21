
<?php
$this->Html->addCrumb($category, '/projects/show/'.$categoryId);
$this->Html->addCrumb($projectName, '/projects/show/'.$category.'/'.$projectId);

echo "<h1>".$project['Project']['name']."</h1>";
?>

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
        <div class="col-xs-6 col-md-3">
           <?php
               
                foreach($images as $image)
                {   
                    echo '<a class="thumbnail">';
                    echo $this->Html->image(substr($image['ProjectImage']['path'],45), array('alt' => $image['ProjectImage']['name']));
                    echo '</a>';
                }
                
            ?>      
        </div>
    </div>
</div>
<div class = "col-xs-12">
<?php
    foreach($relatedImages as $image)
    {   
        echo '<a class="thumbnail">';
        echo $this->Html->image(substr($image['ProjectImage']['path'],45), array('alt' => $image['ProjectImage']['name']));
        echo '</a>';
    }
?>      
</div>
<script>
$('.thumbnail').on('click', function(e){
    $(this).addClass('selected').siblings().removeClass('selected');
    $('#selected-project-image').attr('src', $(this).children()[0].src);
    
});
</script>