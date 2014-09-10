<?php
    class CommentsController extends VanillaController{
        function beforeAction () {

        }

        function view($page) {
            $page = intval(convertBanglaNumber($page));
            $this->Comment->setPage($page);
            $this->Comment->orderBy('timestamp','DESC');
            $comments = $this->Comment->search();
            $total_pages = $this->Comment->totalPages();
            $this->set('comments',$comments);
            $this->set('total_pages',$total_pages);
            $this->set('total_records',$this->Comment->totalRecordsPaginated());
            $this->set('current_page',intval($page));
        }

        function afterAction() {

        }
    }