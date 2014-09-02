<main role="main">
    <section id="navsection">
        <nav role="navigation">
            <?php
                echo "<ul id='breadcrumbs3'>";
                echo "<li>" . $html->link("<img src='/img/home.png' id='homeicon' alt='বিষয় সূচী'>","") . "</li>";
                echo "<li>" . $categories[0]['Category']['cat_desc'] . "</li></ul><br>";
            ?>
        </nav>
    </section>
    <section id="maincontent">
        <div id='cat_header_div'><h1><?php echo $categories[0]['Category']['cat_desc'] ?></h1><div id='toolbar1'></div></div>
        <ol class='multicolumn' id='five'>
<?php
    
    foreach($categories as $row){
        $audio_class = $row['Article']['audio'] == '' ? '' : "with_audio";
        //echo "<li title=''><a id='article_title_" . $row['Category']['cat_slug'] . "' href='view.php?cat_id=$cat_id&article_id=" . $row['article_id'] . "' class='$audio_class'>" . $row['title'] . "</a></li>";
        echo "<li title=''>" . $html->link($row['Article']['title'],$row['Category']['cat_slug'] . "/" . $row['Article']['article_slug'],null,'','article_title_'.$row['Article']['id'],$audio_class) . "</li>";
    }
    for($i = 1; $i <= (5 - (count($categories) % 5)) ; $i++)
        echo "<li title=''>&nbsp;</li>";
?>
        </ol>
    </section>
</main>