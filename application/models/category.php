<?php
    class Category extends VanillaModel {
        var $hasMany = array('Article' => 'Article');
        var $childOrder = array('Article' => array('title','ASC'));
    }