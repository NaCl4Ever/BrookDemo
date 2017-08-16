<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create A Project</title>
</head>

<body>
        <h1>Create a Project</h1>
        <?php foreach($categories as $category) 
            $options[] = array(
                'value' => $category['Category']['id'],
                'name' => $category['Category']['description']

            );
            echo $this->Form->input('Category', array('options'=> $options));
        ?>
        
        <button class = "btn" id = "test" type="button">Click for fun</button>
        
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
</script>
</body>
</html>