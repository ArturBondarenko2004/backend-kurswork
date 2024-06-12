<?php

namespace controllers;

use core\Controller;
use core\Core;
use core\Template;
use models\News;
use models\Users;

class NewsController extends Controller
{
    //News/add
    public function actionAdd()
    {
        return $this ->render();

    }

    //News/index
    public function actionIndex()
    {

//        $row = Users::findById(1);
//        var_dump(
//            $row
//        );
//        die;
  return $this ->render('views/news/view.php');
    }

    public function actionView($params)
    {

        return $this ->render();
    }
}