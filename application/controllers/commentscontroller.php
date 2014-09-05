<?php
    class CommentsController extends VanillaController{
        function beforeAction () {

        }

        function view($page) {
            //echo $page . "...";
            $page = intval(convertBanglaNumber($page));
            //echo $page;
            //exit;
            $this->Comment->setPage($page);
            $this->Comment->orderBy('timestamp','DESC');
            $comments = $this->Comment->search();
            $this->set('comments',$comments);
        }

        function afterAction() {

        }
    }