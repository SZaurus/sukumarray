<main role="main">
    <section id="navsection"><nav role="navigation"></nav></section>
    <section id="maincontent">
        <div id="menu_buttons">
           <?php
                foreach ($categories as $category)
                    echo $html->link("<div class='menu_button' id='menu_button_" . $category['Category']['cat_desc_en'] . "'></div>",$category['Category']['cat_slug']);

                echo $html->link("<div class=\"menu_button\" id=\"menu_button_comment\"><span id=\"tot_comments\"></span></div>","মন্তব্য");
            ?>
            <div class="menu_button" id="menu_button_sharethis">
                <p style='text-align:center;'>
                    <span class='st_sharethis_hcount' displaytext='ShareThis'></span><br/>
                    <span class='st_facebook_hcount' displaytext='Facebook'></span>
                    <span class='st_googleplus_hcount' displaytext='G+'></span><br/>
                    <span class='st_twitter_hcount' displaytext='Tweet'></span>
                    <span class='st_email_hcount' displaytext='Email'></span>
                </p>
            </div>
        </div>
    </section>
</main>