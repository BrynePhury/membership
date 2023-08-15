<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View CV</title>
    <style>
        .container{padding: 30px;}
    </style>
</head>
<?php $cv = $data['cv_file'];?>
<body>
    <div class="continer">
        <embed src="./uploads/<?php echo $cv; ?>#toolbar=0" type="application/pdf" width="100%" height="600px" />
    </div>
    
</body>
</html> 

