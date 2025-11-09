<?php
 
$grades = ["Asha" => 85,"Rahul" => 95, "Meera" => 78, "Tom" => 88];
foreach($grades as $stud => $marks){
    if($marks >90){
        echo "$stud got above 90 marks! &#x1F393;<br> ";
    }
    else{
        echo "$stud  scored  $marks marks <br> ";
    }
}

?>