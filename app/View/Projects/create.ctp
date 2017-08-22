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
            <textarea name="editor1" id="editor1" cols="30" rows="10"></textarea>  
            <input type="file" id="project-files" multiple accept="image/x-png,image/gif,image/jpeg">
            <div class="preview">

            </div>
            <button class = "btn btn-default" id = "submit" type="button">Create new project</button>
            </form>
            
        </div>
<script>
    var filteredFiles = {};
    $('#submit').click(function(){
        
        var fileForm = new FormData();
        $.each(filteredFiles, function(key,value){
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
                 var project_id = JSON.parse(response).id;
                $.ajax({
                    url: '/projects/attachimages?project_id=' + project_id,
                    method: "POST",
                    processData: false,
                    contentType: false,
                    cache: false,
                    data: fileForm,
                    success: function(response){
                        console.dir(response);
                        $.ajax({
                            url: '/projects/setdefault',
                            method: "POST",
                            data: {
                                selection: $('.thumbnail.selected').length > 0 ? $($('.thumbnail.selected').children()[0]).attr('img-name')  : null,
                                projectId: project_id
                            },
                            success: function(response){

                            }
                        })
                    }
                });        
			 }
		 });
        
    });
    $('#project-files').on('change', function(event){
        
        var $files = $('#project-files')[0].files;
        if ($('#project-files')[0].files) {
            
        }
        if( $files.length>4)
        {
             alert('You may only upload up to 4 images.');
        }
        else{
            var filesAmount = $files.length;
            var defaultset = false;
            $("div.preview").empty();
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                var filesize = (($files[i].size/1024)/1024).toFixed(4); // MB
                //Skip adding file to the one we will use for the rest of the event
                if(filesize >= 4)
                {
                    continue;
                }
                else{
                    reader.onload = function(event) {
                        let name = this.fileName;
                        var $a = $("<a>").addClass('thumbnail upload-image');
                        if(defaultset === false)
                        {
                            $a.addClass('selected');
                            defaultset = true;
                        }
                        $($.parseHTML("<img img-name = '"+name+"'>")).attr('src', event.target.result).appendTo($a);
                        $a.appendTo("div.preview");
                    }
                    filteredFiles[i] = $files[i];
                    reader.fileName = $files[i].name;
                    reader.readAsDataURL($files[i]);
                }
            }
        }
    });
    $('div.preview').on('click', 'a',  function(e){
        $(this).addClass('selected').siblings().removeClass('selected');
    });
    CKEDITOR.replace('editor1');
</script>
</body>
</html>