<?php
    class CategoriesController extends VanillaController {
	
        function beforeAction () {

        }

        function view($cat_slug = null) {
            $categories = $this->Category->getArticlesList($cat_slug);
            $this->set('categories',$categories);
        }


        function index() {
            //$this->Category->showHasMany();
            $categories = $this->Category->search();
            $this->set('categories',$categories);
        }

        function afterAction() {

        }
    }