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
            <button class = "btn btn-default" id = "submit" type="button">Create new project</button>
            </form>
            
        </div>
<script>
    var files;
    $('#submit').click(function(){
        
        var fileForm = new FormData();
        $.each(files, function(key,value){
            fileForm.append(key,value);
        });
        
		 $.ajax({
			 url: '/projects/add',
			 method: "POST",
			 json: 'application/json',
			 data: { 
                 Project : {
                    name: $('#project-name').val(),
                    category_id: $('#project-category').val(),
                    scope: CKEDITOR.instances.editor1.getData()  
                 }
                 },
			 success: function (response) {
                 console.dir(response);
                 var project_id = JSON.parse(response).id;
                 console.log(project_id);
                $.ajax({
                    url: '/projects/attachimages?project_id=' + project_id,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: fileForm,
                    success: function(response){
                        console.dir(response);
                    }
                });        
			 }
		 });
        
    });
    $('#project-files').on('change', function(event){
        if( $('#project-files')[0].files.length>4)
        {
             alert('You may only upload up to 4 images.');
             

        }
        else{
            files = event.target.files
        }
    });
    CKEDITOR.replace('editor1');
</script>
</body>
</html>