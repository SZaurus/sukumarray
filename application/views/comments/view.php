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