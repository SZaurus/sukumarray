<?php
    class CommentsController extends VanillaController{
        function beforeAction () {

        }

        function view($page) {
            $this->Comment->setPage($page);
            $this->Comment->orderBy('timestamp','DESC');
            $comments = $this->Comment->search();
            $this->set('comments',$comments);
        }

        function afterAction() {

        }
    }