
<?php
    $conn = mysqli_connect("localhost","petmateadmin","rubenNshaivi","petmatedb");
    if(!$conn){
        echo "<script type='text/javascript'>alert('DATABASE CONNECTIVITY ERROR:PLEASE RELOAD')</script>";
    }
    
    $query = "SELECT * FROM pets where acc_id=$acc_id" ;
    $result = mysqli_query($conn,$query);

    $xml = new DOMDocument();
    $xml->formatOutput = true;
    $xml->preserveWhiteSpace  = true;
    $xml->encoding="UTF-8";
    $xml->standalone=false;
    $dtd = (new DOMIMplementation())->createDocumentType('pets', '', 'your_pets.dtd');
    $xml->appendChild($dtd);
    $xslt = $xml->createProcessingInstruction("xml-stylesheet",'type="text/xsl" href="your_pets.xsl"');
    $xml->appendChild($xslt);

    $pets = $xml->createElement('pets');
    $xml->appendChild($pets);

    while($row = $result->fetch_assoc()){
        $pet = $xml->createElement('pet');
        $pets->appendChild($pet);
        $arr=["pet_id","pet_name","pet_type","breed","age"];
        foreach ($arr as $val) {
            $entry =  $xml->createElement($val,$row["$val"]);
            $pet->appendChild($entry);
        }


        $entry = $xml->createElement('weight',$row['weight']." ".$row['units']);
        $pet->appendChild($entry);

        $entry = $xml->createElement('gender',$row['gender']);
        $pet->appendChild($entry);

        $entry = $xml->createElement('pet_pic',"data:{$row['mime_type']};base64,{$row['pet_pic']}");
        $pet->appendChild($entry);

        $extension = ($row['mime_type']=="image/jpeg")?"jpg":"png";
        $entry = $xml->createElement('extension',$extension);
        $pet->appendChild($entry);
        
        $entry = $xml->createElement('posted_on',$row['posted_on']);
        $pet->appendChild($entry);

        $entry = $xml->createElement('updated_on',$row['updated_on']);
        $pet->appendChild($entry);
    }
    $xml->save("your_pets.xml");

?>