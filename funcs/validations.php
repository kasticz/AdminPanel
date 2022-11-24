<?php


function specialsValidation($s){
    if(!strpos($s,"-")){
        return false;
    }
    $arr = explode(',',$s);
    $allowed = 'qwertyuioplkjhgfdsazxcvbnm~`!@#$%"№%^&*()_-+=|\\:,.?*}{[]:;?/>< 1234567890';
        foreach(str_split($s) as $value){
            if(!str_contains($allowed,strtolower($value))){
                return false;
            }
        }
    return $arr;

}
function makeSpecials($s){
    $specials = explode(',',trim($s));
    $specials = json_encode(array_map(function($i){
        $key = substr($i,0,strpos($i,"-"));
        $value = substr($i,strpos($i,"-")+1);
        return [$key,$value];
    },$specials));

    return $specials;
}

function validateLogin($l,$connect,$editMode){
    if(!$l){
        return [false,'Логин не должен быть пустым'];
    }
    if($editMode){
        return [true,$l];
    }
    $l = strtolower($l);
    $logins = mysqli_query($connect,"SELECT `login` FROM `users`");
    $logins = mysqli_fetch_all($logins);
    $logins = array_map(fn($i)=>$i[0],$logins);
    return in_array($l,$logins) ? [false,'Такой логин уже существует'] : [true,$l];
}
function validatePassword($p){
    $pArr = str_split($p);
    $numbers = '1234567890';
    $symbols = '!@$%^&*()_+|{}[]"`~:;/?.><,';
    $alph = 'abcdefghijklmnopqrstuvwxyzабвгдеёжзийклмнопрстуфхчцшщъыьэюя';
    $has1number = false;
    $has1SpecialSymbol = false;
    $has1BigCharacter = false;
    foreach($pArr as $value){
        if(str_contains($numbers,$value)){
            $has1number = true;
            break;
        }
    }
    foreach($pArr as $value){
        if(str_contains($symbols,$value)){
            $has1SpecialSymbol = true;
            break;
        }
    }
    foreach($pArr as $value){
        if(str_contains($alph,strtolower($value)) && strtolower($value) !== $value){
            $has1BigCharacter = true;
            break;
        }
    }


    if(!$has1number){
        return [false,"Пароль должен содержать хотя бы 1 цифру"];
    }
    if(!$has1SpecialSymbol){
        return [false,"Пароль должен содержать хотя бы 1 специальный символ(!@#%^&* и т.д.)"];
    }
    if(!$has1BigCharacter){
        return [false,"Пароль должен содержать хотя бы 1 заглавную букву"];
    }
    return [true,$p];

}

function validateUserID($id,$connect){
    $userID = mysqli_query($connect,"SELECT `id` FROM `users` WHERE `id` = '$id'");

    return !$userID->num_rows ? [false,"Пользователя с ID $id  не существует"] : [true,$id];


}

function validateProductsIDs($arr,$connect){
    $orderContent = explode(',',trim($arr));
    $orderContent = array_map(function($i){
        $id = substr($i,0,strpos($i,'-'));
        $number = substr($i,strpos($i,'-') + 1);
        return [$id,$number];
    },$orderContent);
    $ids = array_map(fn($i)=>$i[0],$orderContent);
    $idsValid = [true];

    foreach($ids as $value){
        $id = mysqli_query($connect,"SELECT `id` from `products` WHERE `id` ='$value'");
        if(!$id->num_rows){
            $idsValid = [false,"Товара с ID $value не существует"];
            break;
        }
    }

    return $idsValid[0] ? [true,json_encode($orderContent),JSON_UNESCAPED_UNICODE] : [false,$idsValid[1]];

    
}
?>