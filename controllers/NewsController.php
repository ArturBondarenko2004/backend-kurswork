<?php

namespace controllers;

use core\Controller;
use core\Template;

class NewsController extends Controller
{
    //News/add
    public function actionAdd()
    {
//        $this->template->setTemplateFilePath('views/news/index.php');
//        return [
//            'Content' => $this->template->getHTML(),
//            'Title' => 'Додавання новини'
//        ];
        return $this ->render();
    }

    //News/index
    public function actionIndex()
    {
//        return [
//            'Content' => $this->template->getHTML(),
//            'Title' => 'Список новин'
//        ];Список
        return $this ->render();
    }

    public function actionView($params)
    {
//        $template = new Template('views/news/view.php');
////        echo "NewsController == index";
//        return [
//            'Content' => $template->getHTML(),
//            'Title' => 'Список новин actionView'
//        ];
        return $this ->render();
    }
}