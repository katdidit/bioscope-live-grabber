<?php
include 'array.php';
?>
<!DOCTYPE html>
<html>
    <head>
       <meta charset="utf-8">
        <!--Import Google Icon Font-->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <!--Import materialize.css-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
        <!--Let browser know website is optimized for mobile-->
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <title>Homepage</title>
    </head>
    <body>
        <div class="row">
            <?php
            foreach($data as $k=>$v){
				$name = strtolower($k);
				$name = str_ireplace(' ','_',$k);
                echo '
            <div class="col m2 l1">
                <div class="card">
                    <a href="/'.$k.'.m3u8?redirect=1">
                        <div class="card-image"><img src="'.$v[2].'" height="auto" width="100%" alt="'.$k.'" /></div>
                        <div class="truncate center">'.$k.'</div>
                    </a>
                </div>
            </div>';
            }
            ?>
        </div>
        <!--JavaScript at end of body for optimized loading-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>  
    </body>
</html>