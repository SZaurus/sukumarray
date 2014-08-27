<?php
    class Category extends VanillaModel {
        var $hasMany = array('Article' => 'Article');
        var $childOrderBy = array('Article' => array('title','ASC'));
        
        function getArticlesList($cat_slug){
            return $this->custom("select categories.cat_desc, categories.cat_slug, articles.article_slug, articles.title,articles.first_line, articles.audio from categories, articles where categories.cat_slug='$cat_slug' and categories.id=articles.category_id");
        }
    }