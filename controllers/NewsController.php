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

  return $this ->render('views/news/view.php');
    }

    public function actionView($params)
    {

        return $this ->render();
    }
}