<?php
$file = $_GET['path'] . '/' . $_GET['filename'];
if (isset($_POST['submit'])) {
    // echo '<pre>';
    // print_r($_POST);
    // echo '</pre>'; die;
    if (isset($_POST['subject'])) {
        $subject = $_POST['subject'];
        
        $handle = fopen($file, 'a');
        fwrite($handle, $subject);
        $fclose = fclose($handle);
        header('location: http://localhost/filehandling/edit.php?path='.$_GET['path'].'&filename='.$_GET['filename']);
        exit();
        
    }    
}
 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <title>EditDataHere</title>
</head>

<body>
    <div class='container'>
        <form action="" method='POST' class="row">
            <div class="form-group ">
                <label for="subject" class="">Enter your data</label>
                <textarea class="form-control" name="subject" id="subject" cols="150" rows="10">
                    <?php show_source($file);
                ?></textarea>
                <button type="submit" name="submit" class="btn btn-info"> Submit </button>
            </div>
        </form>
    </div>
</body>

</html>