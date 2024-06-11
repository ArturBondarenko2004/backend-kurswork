<?php

namespace controllers;

use core\Controller;
use core\Core;
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
        $db = Core::get()->db;
        $rows = $db->select("news", ["title", "text","date"], [
            'id' => 2
        ]);
//        $db ->insert('news', [
//            'title' => 'Заголовок',
//            'text' => 'text',
//            'short_text' => 'st',
//            'date' => '2024-04-21 19:00:00'
//        ]);
//        $db->delete('news', [
//            'id' => 4
//        ]);
        $db ->update('news', [
            'title' => '!!!!',
        ],
        [
            'id' => 1
        ]);
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