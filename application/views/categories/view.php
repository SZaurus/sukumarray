<div id='cat_header_div'><h1><?php $categories[0]['Category']['cat_desc'] ?></h1><div id='toolbar1'></div></div>
<ol class='multicolumn' id='five'>
<?php
    foreach($categories as $row){
        $audio_class = $row['Article']['audio'] == '' ? '' : "with_audio";
        //echo "<li title=''><a id='article_title_" . $row['Category']['cat_slug'] . "' href='view.php?cat_id=$cat_id&article_id=" . $row['article_id'] . "' class='$audio_class'>" . $row['title'] . "</a></li>";
        echo "<li title=''>" . $html->link($row['Article']['title'],$row['Category']['cat_slug'] . "/" . $row['Article']['article_slug']);
    }
?>
</ol>