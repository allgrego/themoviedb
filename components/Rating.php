<?php 
function rating($vote_average){
    echo '<div id="rating">';
        echo '<span><strong>Rating: '.($vote_average/2).' / 5 </strong></span>';
        for($i=0;$i<5;$i++){
            echo ($i<((int)$vote_average/2))?'<span class="fa fa-star checked"></span>':'<span class="fa fa-star"></span>';

        }
    echo '</div>';
}
