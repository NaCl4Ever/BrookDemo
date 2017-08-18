<div id="breadcrumb">
<?php
if(isset($category)){ $this->Html->addCrumb($category, '/projects/show/'.$category);}
if(isset($projectId)) {$this->Html->addCrumb($projectName, '/projects/show/'.$category.'/'.$projectId);}
echo $this->Html->getCrumbs(' > ', 'Project Portfolio');
?>
</div>