<?php
function formatOverview($s){
    if(strlen($s) < 50){
        return $s;
    }
    return substr($s,0,strpos($s,".")) . "...";
}

function formatPurchasable($n){
    return $n ? "В продаже" : "Не в продаже";
}

function formatSpecials($sp,$forInputs){
    $sp = json_decode($sp);

    $resultString = '';

    foreach($sp as $value){
        if($forInputs){
            $resultString .= $value[0] . " - " . $value[1] . ",";
        }else{
            $resultString .= getSpecialType($value[0]) . " - " .  getSpecialValue($value[1],$value[0]) . "<br/>";
        }
        
    }
    return substr($resultString,0,-1);
}

 function getSpecialType($s){
    $s = trim($s);
    $types = ["DPI"=>"DPI","wireless"=>"беспроводная","type"=>"тип","diagonal"=>"диагональ","maxHZ"=>"Макс. Гц","matrix"=>"матрица","resolution"=>"разрешение","width"=>"ширина","length"=>"длина"];

    return array_key_exists(strtolower($s),$types) ? $types[$s] : $s;

}

 function getSpecialValue($s,$type){
    $s = trim($s);
    $units = ["diagonal"=>"''","width"=>' мм',"length"=>' мм'];

    
    if(gettype($s) === 'boolean' || !$s){        
        return $s ? "Да" : "Нет";
    }
    if(array_key_exists($type,$units)){
        return $s . $units[$type];
    }
    return $s;

}

function formatDiscount($n){
    return $n > 0 ? $n . " %" : "Нет";
}
function formatType($s){
    $types = ['mouse'=>'мышь','keyboard'=>'клаиватура','monitor'=>'монитор','mat'=>'коврик'];
    return array_key_exists($s,$types) ? $types[$s] : $s;
}

function formatOrderContent($o,$connect,$editMode){
    $o = json_decode($o);

    $formattedOrder = "";
    foreach($o as $value){
        if($editMode){
            $formattedOrder .= "$value[0] - $value[1], ";
        }else{
            $productTitle = mysqli_query($connect,"SELECT title FROM products WHERE id = $value[0]");
            $productTitle = mysqli_fetch_assoc($productTitle)["title"];
            $formattedOrder.= "$productTitle - $value[1] единиц <br/>";
        }

    }
    return $editMode ? substr($formattedOrder,0,-2) : $formattedOrder;

}


?>