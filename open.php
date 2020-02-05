<?php
    
    echo '<pre>'; print_r($_GET); echo '</pre>'; 
    
    $file = $_GET['path']."/".$_GET['filename'];     
    show_source($file);
?>