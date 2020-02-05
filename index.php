<?php $path = (isset($_GET['path']) && $_GET['path']!="")?$_GET['path']:"../filehandling"; ?>
<?php 
    if(isset($_POST['submit'])){ 
        if(isset($_POST['filename'])){                            
            echo $filename = $_POST['filename'];
            $myfile = fopen($path. "/" .$filename, "w") or die("Unable to open file!");
            fclose($myfile);
            header('location: index.php?path='.$path);
            exit;                            
        }
        if(isset($_POST['foldername'])){
            $foldername = $_POST['foldername'];                            
            $myfolder = mkdir($path."/".$foldername, 0777, true); 
            header('location: index.php?path='.$path);
            exit;
        }
        if(isset($_POST['delete'])){
            echo '<pre>'; print_r($_POST); echo '</pre>';
            echo $filename = $_POST['dltfile'];
            echo $aa = unlink($path.'/'.$filename );
        }
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="../portoshop/admin/css/bootstrap.min.css" type="text/css">
    <!-- Our Custom CSS -->
    <!-- <link rel="stylesheet" href="css/admin.css"> -->
    <!-- Data table CSS -->
    <!-- <link rel="stylesheet" href="css/jquery.dataTables.css"> -->
    <!-- Font Awesome JS -->
    <script defer src="../portoshop/admin/js/solid.js"></script>
    <script defer src="../portoshop/admin/js/fontawesome.js"></script>
    <script defer src="../portoshop/admin/js/script.js"></script>
    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="../portoshop/admin/js/jquery.min.js" type="text/javascript"></script>
    <!-- Popper.JS -->
    <script src="../portoshop/admin/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="../portoshop/admin/js/bootstrap.min.js" type="text/javascript"></script>
    <!-- jquery data table -->
    <script src="../portoshop/admin/js/jquery.dataTables.min.js" type="text/javascript"></script>
    <title>Dashboard</title>
    <script>
    $(document).ready(function() {
        $(".option").click(function() {
            $(".folder_option").hide();
            $(this).find(".folder_option").toggle();
        });
    });
    $(document).ready(function() {
        $(".option").click(function() {
            $(".file_option").hide();
            $(this).find(".file_option").toggle();
        });
    });
    </script>
    <style>
    .option:after {
        content: '\2807';
        font-size: 15px;
        margin-left: 10px;
        cursor: pointer;
        padding: 4px;
    }

    .folder_option {
        display: none;
        background: gray;
        border-radius: 10px;
        width: 100%;
        max-width: 125px;
        padding: .5px 2px;
        color: white;
        margin-top: 0px;
        position: absolute;
        z-index: 9;
        cursor: pointer;
    }

    .folder_option li {
        list-style-type: none;
    }

    .file_option {
        display: none;
        background: gray;
        border-radius: 10px;
        width: 100%;
        max-width: 125px;
        padding: .5px 2px;
        color: white;
        margin-top: 0px;
        position: absolute;
        z-index: 9;
        cursor: pointer;
    }

    .file_option li {
        list-style-type: none;
        margin-top: 4px;
        cursor: pointer;
        padding: 4px;
    }
    </style>
</head>

<body>
    <?php
        // $somePath = "admin";
        // $directories = glob($somePath . '/*' , GLOB_ONLYDIR);
        // echo "<pre>"; print_r($directories); echo "</pre>";
        // foreach($directories as $value){}
        $folder = [];
        $file = [];
        foreach (new DirectoryIterator($path) as $fileInfo) {
            if($fileInfo->isDot()) 
                continue;
            $dirname = $fileInfo->getFilename();    
            $ext = pathinfo($dirname);
            // echo '<pre>'; print_r($ext); echo "</pre>";
            if(isset($ext['extension'])){
                $file[] = [
                    'name' => $dirname,
                    'ext' => $ext['extension']
                ];
            }
            else{
                $folder[] = $dirname;
            }
        }
        // echo '<pre>'; print_r($file); die('Endherer');    
    ?>
    <div class="container-fluid">
        <div class="row col-sm-8">
            <?php
                foreach($folder as $_folder){   }
                $_path = (isset($_GET["path"])?$_GET["path"]:'');
                $crumbs = explode("/", $_path);
                $series = "";
                $lastArray = end($crumbs);
                foreach($crumbs as $crumb){
                    //echo '<pre>'; print_r($crumbs); echo '</pre>';
                    // echo $crumb;
                    
                    
                    $a = str_replace(array(".php","_"),array(""," "),$crumb); 
                    $series .= $a."/";
                    ?>
                    <a class="text-decoration-none, text-muted"href="index.php?path=<?= rtrim($series, '/') ?>"><?= ucfirst($a) ?></a> 
                <?php
                    if($lastArray!=$crumb){
                        echo " > ";
                    }
                }
                
            ?>
        </div>
        <div class="row">
            <div class="col-sm-3 my-4">
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Create File</a>
                <!-- Modal -->
                <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form action="" method="POST">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Create New File</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p class="label">Please Enter a file name with Extension </p>
                                    <input type="text" name="filename" id="filename" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#foldermodal">Create Folder</a>
                <div id="foldermodal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form action="" method="POST">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Create New Folder</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p class="label">Please Enter a folder Name</p>
                                    <input type="text" name="foldername" id="foldername" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="submit">Submit</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="" class="btn btn-primary" data-toggle="modal" data-target="#deletemodal">Delete</a>
                <div id="deletemodal" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <form action="" method="POST">
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title">Delte File/Folder</h4>
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                </div>
                                <div class="modal-body">
                                    <p class="label">Please Enter a folder/file Name</p>
                                    <input type="text" name="dltfile" id="dltfile" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-success" name="Delete">Delete</button>
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

            </div>
            <div class="col-sm-8 row">
                <?php foreach ($folder as $_folder) :?>
                <div class="col-sm-3">
                    <a href="index.php?path=<?= $path?>/<?= $_folder ?>"><img
                            src='../portoshop/web/image/icon/folder.png'></a><br>
                    <!-- <?php echo $_folder . "<div class='option'></div><br>"; ?> -->
                    <div class="option">
                        <?= $_folder ?><span class=""></span>
                        <div class="folder_option">
                            <ul>
                                <li><a class="text-decoration-none, text-light" href="index.php?path=<?= $path?>/<?= $_folder ?>">Open</a></li>
                                <li><a class="text-decoration-none, text-light"
                                        href="delete.php?path=<?= $path?>&name=<?= $_folder?>">Delete</a></li>
                            </ul>
                        </div>
                    </div>

                </div>
                <?php  endforeach;  ?>
                <?php foreach ($file as $_file) :?>
                <?php $icon_url = '../portoshop/web/image/icon/'.$_file["ext"].".png"; ?>
                <?php if(!file_exists($icon_url)){
                    $icon_url = '../portoshop/web/image/icon/default.png';
                } ?>
                <div class="col-sm-3">
                    <a href=""><img src='<?= $icon_url ?>'></a><br>
                    <!-- <?php echo $_file['name'] . "<div class='option'><br>\n"; ?> -->
                    <div class="option">
                        <?= $_file['name'] ?><span class=""></span>
                        <div class="file_option">
                            <ul>
                                <li><a href="open.php?path=<?= $path ?>&filename=<?= $_file['name']?>">View</a></li>
                                <li><a href="edit.php?path=<?= $path ?>&filename=<?= $_file['name']?>">Edit</a></li>
                                <li><a href="delete.php?path=<?= $path ?> &filename=<?= $_file['name']?>">Delte</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <?php  endforeach;  ?>
            </div>
        </div>
    </div>
</body>
</html>