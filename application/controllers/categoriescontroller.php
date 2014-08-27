<?php
    class CategoriesController extends VanillaController {
	
        function beforeAction () {

        }

        function view($cat_slug = null) {
            //$this->Category->where('cat_slug',$cat_slug);
            //$this->Category->showHasMany();
            //$categories = $this->Category->search();
            $categories = $this->Category->custom("select categories.cat_desc, categories.cat_slug, articles.article_slug, articles.title,articles.first_line, articles.audio from categories, articles where categories.cat_slug='$cat_slug' and categories.id=articles.category_id");
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