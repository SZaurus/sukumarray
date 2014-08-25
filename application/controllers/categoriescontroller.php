<?php
    class CategoriesController extends VanillaController {
	
        function beforeAction () {

        }

        function view($cat_slug = null) {
            $this->Category->where('cat_slug',$cat_slug);
            $this->Category->showHasMany();
            $category = $this->Category->search();
            $this->set('category',$category);
        }


        function index() {
            //$this->Category->showHasMany();
            $categories = $this->Category->search();
            $this->set('categories',$categories);
        }

        function afterAction() {

        }
    }