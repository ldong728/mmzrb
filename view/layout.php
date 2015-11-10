<?php
function layout($id,$name,$made_in,$price,$url){

    echo '<div class = "good_layout"><a href="?detel=1&g_id='.$id.'">
        <img class ="title" src="' .$url.'"/></br>
        <p class = "g_name">'.$name.'</p>
        <p class = "g_price">'.$price.'</p>
        <p class = "g_made_in">'.$made_in.'</p></a>
        </div>';

}


?>