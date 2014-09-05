<?php
    $routing = array(
        '/admin\/(.*?)\/(.*?)\/(.*)/' => 'admin/\1_\2/\3',
        '/(ছড়া)\/(.*)/'=>'articles/view/\1/\2',
        '/(গল্প)\/(.*)/'=>'articles/view/\1/\2',
        '/(নাটক)\/(.*)/'=>'articles/view/\1/\2',
        '/(জীবনী)\/(.*)/'=>'articles/view/\1/\2',
        '/(জীবজন্তু)\/(.*)/'=>'articles/view/\1/\2',
        '/(বিবিধ)\/(.*)/'=>'articles/view/\1/\2',
        '/(ইংরেজী-তর্জমা)\/(.*)/'=>'articles/view/\1/\2',
        '/(ছড়া)/'=>'categories/view/\1',
        '/(গল্প)/'=>'categories/view/\1',
        '/(নাটক)/'=>'categories/view/\1',
        '/(জীবনী)/'=>'categories/view/\1',
        '/(জীবজন্তু)/'=>'categories/view/\1',
        '/(বিবিধ)/'=>'categories/view/\1',
        '/(ইংরেজী-তর্জমা)/'=>'categories/view/\1',
        '/মন্তব্য\/(.+)/'=>'comments/view/\1',
        '/মন্তব্য\//'=>'comments/view/১',
        '/মন্তব্য/'=>'comments/view/১'
    );

    $default['controller'] = 'categories';
    $default['action'] = 'index';