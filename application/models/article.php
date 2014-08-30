<?php
    class Article extends VanillaModel {
        function getArticlesContent($cat_slug, $article_slug){
            return $this->custom("select categories.cat_desc, categories.cat_slug, articles.title, articles.top_image, articles.body, articles.views, articles.audio, articles.sc_track_id from articles, categories where cat_slug='$cat_slug' and article_slug='$article_slug'");
        }
    }