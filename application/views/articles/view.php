<main role="main">
    <section id="navsection">
        <nav role="navigation">
            <?php
                echo "<ul id='breadcrumbs3'>";
                echo "<li>" . $html->link("<img src='/img/home.png' id='homeicon' alt='বিষয় সূচী'>","") . "</li>";
                echo "<li>" . $html->link($article[0]['Category']['cat_desc'],$article[0]['Category']['cat_slug']) . "</li>";
                echo "<li>" . $article[0]['Article']['title'] . "</li></ul><br>";
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
        </div>
    </section>
</main>