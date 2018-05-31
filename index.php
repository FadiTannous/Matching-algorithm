<?php
echo "<center><body style='font-family:calibri;'>";
/*
 * Key:
 * Want = 1
 * Neutral = 0
 * Avoid = -1
 * 
 * Floors:
 * Low = Up to second Floors
 * High = Third and higher
 */
function custom_hungarian($matrix)
{
    $h = count($matrix);
    $w = count($matrix[0]);
    // If the input matrix isn't square, make it square
    // and fill the empty values with the INF, here 9999999
    if ($h < $w) {
        for ($i = $h; $i < $w; ++$i) {
            $matrix[$i] = array_fill(0, $w, 999999);
        }
    } elseif ($w < $h) {
        foreach ($matrix as &$row) {
            for ($i = $w; $i < $h; ++$i) {
                $row[$i] = 999999;
            }
        }
    }
    $h = $w = max($h, $w);
    $u   = array_fill(0, $h, 0);
    $v   = array_fill(0, $w, 0);
    $ind = array_fill(0, $w, -1);
    foreach (range(0, $h - 1) as $i) {
        $links   = array_fill(0, $w, -1);
        $mins    = array_fill(0, $w, 999999);
        $visited = array_fill(0, $w, false);
        $markedI = $i;
        $markedJ = -1;
        $j       = 0;
        while (true) {
            $j = -1;
            foreach (range(0, $h - 1) as $j1) {
                if (!$visited[$j1]) {
                    $cur = $matrix[$markedI][$j1] - $u[$markedI] - $v[$j1];
                    if ($cur < $mins[$j1]) {
                        $mins[$j1]  = $cur;
                        $links[$j1] = $markedJ;
                    }
                    if ($j == -1 || $mins[$j1] < $mins[$j]) {
                        $j = $j1;
                    }
                }
            }
            $delta = $mins[$j];
            foreach (range(0, $w - 1) as $j1) {
                if ($visited[$j1]) {
                    $u[$ind[$j1]] += $delta;
                    $v[$j1] -= $delta;
                } else {
                    $mins[$j1] -= $delta;
                }
            }
            $u[$i] += $delta;
            $visited[$j] = true;
            $markedJ = $j;
            $markedI = $ind[$j];
            if ($markedI == -1) {
                break;
            }
        }
        
        while (true) {
            if ($links[$j] != -1) {
                $ind[$j] = $ind[$links[$j]];
                $j       = $links[$j];
            } else {
                break;
            }
        }
        $ind[$j] = $i;
    }
    $result = array();
    foreach (range(0, $w - 1) as $j) {
        $result[$j] = $ind[$j];
    }
    return $result;
}

//Create people
$people = array();

$scott_white = new stdClass();
$scott_white->ID = '201';
$scott_white->Name = 'Scott White';
$scott_white->Rent= '1000';
$scott_white->People = '1';
$scott_white->Bedrooms = '2';
$scott_white->Floors = 'low';
$scott_white->Pets = 'Neutral';
$scott_white->Laundry = 'Yes';
$scott_white->Water= 'Yes';
$scott_white->Heat= 'Yes';
$scott_white->Electricity= 'Yes';
$scott_white->Accessible = 'No';
$scott_white->Unit = 'Apartment';
array_push($people, $scott_white);

$andrea_curtin = new stdClass();
$andrea_curtin->ID = '221';
$andrea_curtin->Name = 'Andrea Curtin';
$andrea_curtin->Rent = '2250';
$andrea_curtin->People = '3';
$andrea_curtin->Bedrooms = '5';
$andrea_curtin->Floors = 'high';
$andrea_curtin->Pets = 'Yes';
$andrea_curtin->Laundry = 'Yes';
$andrea_curtin->Water = 'Yes';
$andrea_curtin->Heat = 'Neutral';
$andrea_curtin->Electricity = 'Yes';
$andrea_curtin->Accessible = 'Yes'; //Sorry
$andrea_curtin->Unit = 'House';
array_push($people, $andrea_curtin);

$batman = new stdClass();
$batman->ID = '272';
$batman->Name = 'Bruce Wayne';
$batman->Rent = '5500';
$batman->People = '1';
$batman->Bedrooms = '1';
$batman->Floors = 'high';
$batman->Pets = 'No';
$batman->Laundry = 'Neutral';
$batman->Water = 'Neutral';
$batman->Heat = 'Neutral';
$batman->Electricity = 'Yes';
$batman->Accessible = 'No'; 
$batman->Unit = 'House';
array_push($people, $batman);

$thatkidwithglasses = new stdClass();
$thatkidwithglasses->ID = '2372';
$thatkidwithglasses->Name = 'John Smith';
$thatkidwithglasses->Rent = '650';
$thatkidwithglasses->People = '1';
$thatkidwithglasses->Bedrooms = '5';
$thatkidwithglasses->Floors = 'low';
$thatkidwithglasses->Pets = 'Yes';
$thatkidwithglasses->Laundry = 'Yes';
$thatkidwithglasses->Water = 'Yes';
$thatkidwithglasses->Heat = 'Yes';
$thatkidwithglasses->Electricity = 'Yes';
$thatkidwithglasses->Accessible = 'No'; 
$thatkidwithglasses->Unit = 'House';
array_push($people, $thatkidwithglasses);




//Create Units
$units = array();

$paramount_unit = new stdClass();
$paramount_unit->ID = '001';
$paramount_unit->Address = '2045 Carling Avenue, 1105, K2A1G5, Ottawa ON';
$paramount_unit->Rent = '1000';
$paramount_unit->Bedrooms = '1';
$paramount_unit->Floors = '11';
$paramount_unit->Pets = 'Yes';
$paramount_unit->Laundry = 'Yes';
$paramount_unit->Water = 'No';
$paramount_unit->Heat = 'Yes';
$paramount_unit->Electricity = 'Yes';
$paramount_unit->Accessible = 'No'; 
$paramount_unit->Unit = 'Apartment';
array_push($units, $paramount_unit);

$slumlord_props = new stdClass();
$slumlord_props->ID = '003';
$slumlord_props->Address = '5346 George Road, K2C2X6, Ottawa ON';
$slumlord_props->Rent = '500';
$slumlord_props->Bedrooms = '3';
$slumlord_props->Floors = '2';
$slumlord_props->Pets = 'No';
$slumlord_props->Laundry = 'Yes';
$slumlord_props->Water = 'Yes';
$slumlord_props->Heat = 'No';
$slumlord_props->Electricity = 'No';
$slumlord_props->Accessible = 'Yes'; 
$slumlord_props->Unit = 'House';
array_push($units, $slumlord_props);

$new_land = new stdClass();
$new_land->ID = '015';
$new_land->Address = '1245 Walkley Road, K1V9S5, Ottawa ON';
$new_land->Rent = '1250';
$new_land->Bedrooms = '2';
$new_land->Floors = '5';
$new_land->Pets = 'Yes';
$new_land->Laundry = 'Yes';
$new_land->Water = 'Yes';
$new_land->Heat = 'Yes';
$new_land->Electricity = 'Yes';
$new_land->Accessible = 'Yes'; 
$new_land->Unit = 'Apartment';
array_push($units, $new_land);

$great_place = new stdClass();
$great_place->ID = '017';
$great_place->Address = '1345 Street Road, K9F 2C1, Ottawa ON';
$great_place->Rent = '2250';
$great_place->Bedrooms = '1';
$great_place->Floors = '2';
$great_place->Pets = 'Yes';
$great_place->Laundry = 'Yes';
$great_place->Water = 'Yes';
$great_place->Heat = 'Yes';
$great_place->Electricity = 'Yes';
$great_place->Accessible = 'No'; 
$great_place->Unit = 'House';
array_push($units, $great_place);




//Create big table to fit all 3 sections
echo "<table style='width:100%; border:1px solid;'>";

//Create people attributes table
$i = 0;
echo "<tr><td style='width:30%; border:1px solid;'><table>";
echo "<h1>People's attributes</h1><br>";
//Print attributes
while ($i < sizeof($people)){
    echo "<tr>";
    foreach($people[$i] as $key => $value) {
        print "<tr><td>$key:</td><td>$value</td></tr>";
    }
    $i++; 
    echo "</tr><tr height = 50px></tr>";
}
//End people table
echo "</table></td>";

//Create matching results table
echo '<td style="width:30%; border:1px solid;"><table>';
echo "<h1>Matching Results</h1><br><br>";
$points_matrix[][] = "";
$p = 0;
while ($p < sizeof($people)){
    $u = 0;
    while ($u < sizeof($units)){
        $score = 0;
        $match = "";
        $mismatch = "";
        $neutral = "";
        echo "<tr>";
        //Validate Bedroom needs
        if ($people[$p]->Bedrooms == $units[$u]->Bedrooms){
            $score -= 2;
            $match .= "Bedrooms. ";
        }
        if ($people[$p]->Bedrooms == (($units[$u]->Bedrooms)+2) ||
            $people[$p]->Bedrooms == (($units[$u]->Bedrooms)-2)||
            $people[$p]->Bedrooms == (($units[$u]->Bedrooms)+3)||
            $people[$p]->Bedrooms == (($units[$u]->Bedrooms)-3)||
            $people[$p]->Bedrooms == (($units[$u]->Bedrooms)+4)||
            $people[$p]->Bedrooms == (($units[$u]->Bedrooms)-4)){
                $score += 2;
                $mismatch .= "Bedrooms. ";
        }
        if ($people[$p]->Pets != "Neutral"){
            if($people[$p]->Pets == $units[$u]->Pets){
                $score -= 2;
                $match .= "Pets. ";
            }else{
                $score += 2;
                $mismatch .= "Pets. ";
            }
        }else {
            $score -= 1;
            $neutral .= "Pets. ";
        }
        if ($people[$p]->Laundry != "Neutral"){
        if ($people[$p]->Laundry == $units[$u]->Laundry){
                $score -= 2;
                $match .= "Laundry. ";
            }else{
                $score += 2;
                $mismatch .= "Laundry. ";
            }
        }else {
            $score -= 1;
            $neutral .= "Laundry. ";
        }
        if ($people[$p]->Water != "Neutral"){
            if ($people[$p]->Water == $units[$u]->Water){
                $score -= 2;
                $match .= "Water. ";
            }
            else{
                $score += 2;
                $mismatch .= "Water. ";
            }
        }else {
            $score -= 1;
            $neutral .= "Water. ";
        }
        if ($people[$p]->Heat != "Neutral"){
            if ($people[$p]->Heat == $units[$u]->Heat){
                $score -= 2;
                $match .= "Heat. ";
            }else{
                $score += 2;    
                $mismatch .= "Heat. ";
            }
        }else {
            $score -= 1;
            $neutral .= "Heat. ";
        }
        if ($people[$p]->Electricity != "Neutral"){
            if ($people[$p]->Electricity == $units[$u]->Electricity){
                $score -= 2;
                $match .= "Electricity. ";
            }else{
                $score += 2;    
                $mismatch .= "Electricity. ";
            }
        }else {
            $score -= 1;
            $neutral .= "Electricity. ";
        }
        if (($people[$p]->Accessible == "Yes") &&
                ($units[$u]->Accessible == "Yes")){
                $score -= 20;
                $match .= "<a style = 'color:green'><b>Accessibility.</b></style> ";
                //If both are Yes, add 10 points
                }
        else{
            if (($people[$p]->Accessible == "Yes" &&
                    $units[$u]->Accessible) == "No"){
                //If one is yes and other is no, score is 0, mismatch.
                $score += 20;#"<a style = 'color:red'>Disqualified for accessibility mismatch. 0</style>";
                $mismatch .= "<a style = 'color:red'><b>Accessibility.</b></style> ";    
                //If both are no, score remains unchanged            
            }
        }  
        
        /* CodeToUncomment
        echo "<tr><td><b>Person:</b> </td><td>".$people[$p]->Name."</td></tr>";
        echo "<tr><td><b>Matching score:</b> </td><td>".($score-$score-$score)." points </td></tr>";    //Doing double minuses to negate negative
        echo "<tr><td><b>With unit:</b> </td><td>".$units[$u]->Address."</td></tr>";
        echo "<tr><td><b>Matched with:</b> </td><td>".$match."</td></tr>";
        echo "<tr><td><b>Neutral with:</b> </td><td>".$neutral."</td></tr>";
        echo "<tr><td><b>Did NOT match with:</b> </td><td>".$mismatch."</td></tr>";
        echo "</tr><tr height=15px></tr>";
        */
        $points_matrix[$p][$u] = $score;
        //$score = $score-$score-$score; 

        $u++;
    }
    $p++;
}       

//Call Hungarian Algorithm to do the work
$result = custom_hungarian($points_matrix);

//print Results
$p_count = 0;
$r_count = 0;
while ($p_count < sizeof($people)){
    echo $people[$p_count]->Name."'s best unit is ".($result[$r_count]+1)."<br/>";
    $p_count++;
    $r_count++;
    }
echo "<br><br><br>";

//Printing the presentable Matrix of scores
echo "<table border=1px solid>";
echo "Matrix of scoring. Rows are people, columns are units.";

    for ($g=0; $g<sizeof($people); $g++){
        echo "<tr>";
        for ($h=0; $h<sizeof($people); $h++){
            echo "<td>".($points_matrix[$g][$h]-$points_matrix[$g][$h]-$points_matrix[$g][$h])."</td>";		//Double minuses to negate negative
        }
        echo "</tr>";
    }
    echo "</table>";

echo "<br><br><br><br>Uncomment section in code to view reasoning. (Ctrl+F: CodeToUncomment)<br>";
//Uncomment above code




//Create units attributes table
$j = 0;
echo "<td style='width:30%; border:1px solid;'><table>";
echo "<h1>Unit's attributes</h1> <br>";
//Print attributes
while ($j < sizeof($units)){
    echo "<tr>";
    foreach($units[$j] as $key => $value) {
        print "<tr><td>$key:</td><td>$value</td></tr>";
    }
    $j++; 
    echo "</tr><tr height = 50px></tr>";
}
//End units table
echo "</table></td></tr>";

//End 3 tables
echo "</table>";


echo "</style></center>";
?>