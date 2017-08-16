<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create A Project</title>
</head>

<body>
        <div class="page-header">
            <h1>Create a Project</h1>
        </div>
        
        
        <div class="col-xs-12 col-md-6">
            <form>
                
            
            <input class="form-control" id = "project-name" type="text" >
            <input  class="form-control" id = "project-category" type="search" list="category" placeholder="Pick a category">
            <datalist id = "category">
                <?php foreach($categories as $category) : ?> 
                    <option value=" <?php echo $category['Category']['description'] ?>"></option>
                <?php endforeach; ?>
            </datalist>
            <input type="file" id="project-files" multiple accept="image/x-png,image/gif,image/jpeg">
            <textarea name="editor1" id="editor1" cols="30" rows="10"></textarea>  
            <button class = "btn btn-default" id = "test" type="button">Create new project</button>
            </form>
        </div>
<script>
    $('#test').click(function(){
		 $.ajax({
			 url: '/projects/show',
			 method: "POST",
			 json: 'application/json',
			 data: { name: "John", category_id: 1 ,scope: "Boston" },
			 success: function (response) {
				 console.log(response);
			 }
		 });
		  
    });
    $('#project-files').on('change', function(){
        if( $('#project-files')[0].files.length>4)
        {
             alert('You may only upload up to 4 images.');
        }
    });
    CKEDITOR.replace('editor1');
</script>
</body>
</html>