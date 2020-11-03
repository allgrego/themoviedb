<?php
function pagination($filename,$current_page,$lastpage){
    echo '<div class="pagination">';
    if($current_page>1){
        echo '<a href="'.$filename.'?page='.($current_page-1).'">&laquo;</a>';
        echo '<a href="'.$filename.'?page=1">1 ...</a>';
        echo '<a href="'.$filename.'?page='.($current_page-1).'">'.($current_page-1).'</a>';
    }	
        echo '<a href="'.$filename.'?page='.($current_page).'" class="active">'.($current_page).'</a>';
    if($current_page<$lastpage){
        echo '<a href="'.$filename.'?page='.($current_page+1).'">'.($current_page+1).'</a>';
        echo '<a href="'.$filename.'?page='.($lastpage).'">... '.$lastpage.'</a>';
        echo '<a href="'.$filename.'?page='.($current_page+1).'">&raquo;</a>';
    }
    echo '</div>';
}
                        
