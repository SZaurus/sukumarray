<?php
    class Ajaxcall extends VanillaModel {
        function getnumberofcomments(){
            return $this->custom("select count(id) cnt from comments");
        }
        
        function getarticlereadcount($cat_slug, $article_slug){
            return $this->custom("select articles.views from articles, categories where articles.category_id=categories.id and articles.article_slug='$article_slug' and categories.cat_slug='$cat_slug'");
        }
    }