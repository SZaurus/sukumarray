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
        '/(ছড়া)/'=>'categories/list/\1',
        '/(গল্প)/'=>'categories/list/\1',
        '/(নাটক)/'=>'categories/list/\1',
        '/(জীবনী)/'=>'categories/list/\1',
        '/(জীবজন্তু)/'=>'categories/list/\1',
        '/(বিবিধ)/'=>'categories/list/\1',
        '/(ইংরেজী-তর্জমা)/'=>'categories/list/\1'
    );

    $default['controller'] = 'categories';
    $default['action'] = 'index';