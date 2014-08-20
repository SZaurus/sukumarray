<?php
    class Category extends VanillaModel {
        var $hasMany = array('Article' => 'Article');
        var $childOrderBy = array('Article' => array('title','ASC'));
    }