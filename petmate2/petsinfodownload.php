<?php
session_start();
if(!isset($_SESSION['accid'])){
    header("Location: account.php");
    exit;
}
$acc_id = $_SESSION['accid'];
include("gen_xml.php");
?>
<!DOCTYPE html>
<html>
<head>
    <title>PET MATE</title>
    <meta charset='UTF-8'name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.1/css/bootstrap.min.css" integrity="sha384-VCmXjywReHh4PwowAiWNagnWcLhlEJLA5buUprzK8rxFgeH0kww/aWY76TfkUoSX" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Lemonada:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <?php
        $dom = new DOMDocument();
        $dom->preserveWhiteSpace  = true;
        $dom->formatOutput = true;
        $dom->load('your_pets.xml');
        if($dom->validate()){
            echo "<script type=text/javascript>console.log('valid xml');</script>\n";
            $pets = $dom->getElementsByTagName('pet');
            $xsl  = new DOMDocument();
            $xsl->load("your_pets.xsl");
            $proc = new XSLTProcessor();
            $proc->importStyleSheet($xsl);
            file_put_contents("your_pets_table.html", $proc->transformToXML($dom));
        }else{
            echo "<script type=text/javascript>alert('XML DTD VALIDATION FAILED PLEASE RELOAD OR CLICK DOWNLOAD AGAIN ON HOME PAGE'))</script>";
        }
    ?>
    <style type="text/css">
        html{
            font-size: 20px;
        }
        body{
            font-family: 'Lemonada', cursive;
            width: 100%;
            margin: 0;
        }
        body::-webkit-scrollbar{
            width:12px;
            border-radius: 10px;
        }
        body::-webkit-scrollbar-corner{
            background: rgba(0,0,0,0); 
        }

        body::-webkit-scrollbar-track{
            -webkit-box-shadow:inset 0 0 6px rgba(0,0,0,0.5) ;
        }

        body::-webkit-scrollbar-thumb{
           -webkit-box-shadow:inset 0 0 6px white;
            border-radius: 10px;
        }
        #pets_info img{
            width: 100%;
            height:300px;
            object-fit: cover;
        }
        #pets_info {
            width: 70%;
        }

        #pets_info div.row{
            background-color: rgba(255,255,255,0.5);
            border-radius: 10px;
            box-shadow: 0px 0px 10px white;
        }
        button:hover, button:focus{
            box-shadow: 0px 0px 10px white;
            outline:none;
            border-radius: 10px;
        }
        button{
            border:none;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.4);
        }
    </style>
</head>
<body class="bg-dark">
    <a download="your_pets_table.html" href="your_pets_table.html"><button class="my-3 ml-3 btn btn-light">Download Table Format</button></a>
    <div id=pets_info class="container-fluid flex-row flex-wrap bg-dark">
        <?php foreach ($pets as $pet) { ?>
        <div class = 'row mx-3 mb-3' id='<?php echo "pet".$pet->getElementsByTagName('pet_id')->item(0)->nodeValue; ?>'>
                <div class="col-6 p-2">
                    <img src='<?php echo "{$pet->getElementsByTagName('pet_pic')->item(0)->nodeValue}" ?>'>
                </div>
                <div class="card-body col-6">
                    <h5 class="card-title"><?php echo "petid#".$pet->getElementsByTagName('pet_id')->item(0)->nodeValue; ?></h5>
                    <pre class="card-text"><?php echo "NAME : {$pet->getElementsByTagName('pet_name')->item(0)->nodeValue} TYPE : {$pet->getElementsByTagName('pet_type')->item(0)->nodeValue}\nBREED : {$pet->getElementsByTagName('breed')->item(0)->nodeValue}\nAGE : {$pet->getElementsByTagName('age')->item(0)->nodeValue} years WEIGHT : {$pet->getElementsByTagName('weight')->item(0)->nodeValue}\nGENDER : {$pet->getElementsByTagName('gender')->item(0)->nodeValue}\nPOSTED ON : <span class='pet_date_raw'>{$pet->getElementsByTagName('posted_on')->item(0)->nodeValue}</span>\nUPDATED ON : <span class='pet_date_raw'>{$pet->getElementsByTagName('updated_on')->item(0)->nodeValue}</span> " ?></pre>
                </div>
        </div>
     <?php } ?>  
    </div>
</body>
</html>