<?php

    function searchDbs($s,$connect){
        $s = trim($s);
        $type = NULL;
        if(str_contains($s,'мыш')){
            $type = 'mouse';
        }
        if(str_contains($s,'клав')){
            $type = 'keyboard';
        }
        if(str_contains($s,'монитор')){
            $type = 'monitor';
        }
        if(str_contains($s,'ковр')){
            $type = 'mat';
        }

        
        $p = mysqli_query($connect, "SELECT * FROM `products` WHERE `title` LIKE '%$s%' OR `id` LIKE '$s' OR `manufacturer` LIKE '%$s%' OR `productType` LIKE '$type'");
        $u = mysqli_query($connect, "SELECT * FROM `users` WHERE `login` LIKE '%$s%' OR `id` LIKE '$s'");
        $result = [];
        for($i=0;$i<$p->num_rows;$i++){
            $curr = mysqli_fetch_assoc($p);
            $curr["item_type"] = 'products';
            $result[] = $curr ;
        }
        for($i=0;$i<$u->num_rows;$i++){
            $curr = mysqli_fetch_assoc($u);
            $curr["item_type"] = 'users';
            $result[] = $curr;
        }
     
        return $result;

    }
?>