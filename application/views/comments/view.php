<main role="main">
    <section id="navsection">
        <nav role="navigation">
            <?php
                echo "<ul id='breadcrumbs3'>";
                echo "<li>" . $html->link("<img src='/img/home.png' id='homeicon' alt='বিষয় সূচী'>","") . "</li>";
                echo "<li>" . "&nbsp;&nbsp;মন্তব্য&nbsp;&nbsp;". "</li></ul><br>";
            ?>
        </nav>
    </section>
    <section id="maincontent">
       <?php
            $bn = new BanglaDate(strtotime(date("Y-m-d H:i:s")));
            if($total_pages > 0){
                $page_combo = createPagesCombo($total_pages,$current_page);
                $prev = ($current_page == 1) ? "<span id='prev_page'>&#x21e6;</span>" : $html->link("&#x21e6;&nbsp;&nbsp;", "মন্তব্য/" . makeBanglaNumber($current_page-1));
                $next = ($current_page == $total_pages) ? "<span id='next_page'>&#x21e8;</span>" : $html->link("&#x21e8;&nbsp;&nbsp;","মন্তব্য/". makeBanglaNumber($current_page+1));
                
                echo "<div id=\"comments_nav_header\">";
                echo "<div id=\"comments_header\">" . makeBanglaNumber($total_records) . " টি মন্তব্য</div>";
                echo "<div id=\"nav_comments\">";
                echo $page_combo . $next . $prev;
                echo "</div></div>";
            }
            foreach($comments as $comment){
                echo "<div class=\"msg\">";
                echo "<div class=\"msg_header\">";
                echo "<div class=\"avatar\"><img src=\"/img/bubble.png\"></div>";
                echo "<div class=\"comment_title\">" . $comment['Comment']['name'] . "</div>";
                $bn->set_time($comment['Comment']['timestamp']);
                $bangla_date = $bn->get_date();
                echo "<div class=\"comment_date\">" . $bangla_date[0] . " " . $bangla_date[1] . ", " . $bangla_date[2] . "</div>";
                echo "</div>";
                echo "<div class=\"msg_body\">" . nl2br($comment['Comment']['comment']) . "</div>";
                echo "</div>";
            }
        ?>
    </section>
</main>