
<?php
$this->Html->addCrumb($category, '/projects/show/'.$categoryId);


foreach($projects as $project)
{ 
   echo '<button class="btn btn-default">';
   echo $this->Html->link(
    $project['Project']['name'],
    'show/'.$categoryId.'/'.$project['Project']['id'],
    array('class' => 'button')
   );
   echo '</button>';
}
?>
