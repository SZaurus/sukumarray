<main role="main">
    <section id="navsection">
        <nav role="navigation">
            <?php
                echo "<ul id='breadcrumbs3'>";
                echo "<li>" . $html->link("<img src='/img/home.png' id='homeicon' alt='বিষয় সূচী'>","") . "</li>";
                echo "<li>" . $html->link("&nbsp;&nbsp;" . $article[0]['Category']['cat_desc'] . "&nbsp;&nbsp;",$article[0]['Category']['cat_slug']) . "</li>";
                echo "<li>" . "&nbsp;&nbsp;" . $article[0]['Article']['title'] . "&nbsp;&nbsp;". "</li></ul><br>";
            ?>
        </nav>
    </section>
    <section id="maincontent">
       <div id="article_content">
            <div id="header_div">
                <h1><?php echo $article[0]['Article']['title']; ?></h1>
                <div id="toolbar1"></div>
            </div>
            <?php echo $article[0]['Article']['body']; ?>
            <div id="read_count">এই লেখাটি <span class="count" id="view_count"><?php echo makeBanglaNumber($article[0]['Article']['views']); ?></span> বার পড়া হয়েছে</div>
        </div>
    </section>
</main>