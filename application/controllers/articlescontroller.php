<?php
    class ArticlesController extends VanillaController {
        function beforeAction () {

        }

        function view($cat_slug, $article_slug) {
            $article = $this->Article->getArticlesContent($cat_slug,$article_slug);
            $this->set('article',$article);
        }

        function afterAction() {

        }
    }