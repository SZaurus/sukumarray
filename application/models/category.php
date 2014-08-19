<?php
    class Category extends VanillaModel {
        var $hasMany = array('Article' => 'Article');
    }