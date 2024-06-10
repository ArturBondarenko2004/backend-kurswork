<?php

namespace controllers;

use core\Template;

class NewsController
{
    //News/add
    public function actionAdd()
    {
        $template = new Template('views/news/add.php');
        return [
            'Content' => $template ->getHTML(),
            'Title' => 'Додавання новини'
        ];
    }

    //News/index
    public function actionIndex()
    {
        $template = new Template('views/news/index.php');
//        echo "NewsController == index";
        return [
            'Content' => $template ->getHTML(),
            'Title' => 'Список новин'
        ];
    }

    public function actionView($params)
    {
//        echo "NewsController == view";
        return [
            'Content' => 'News View',
            'Title' => 'Перегляд новин'
        ];
    }
}