<?php

namespace controllers;

use core\Controller;
use core\RequestMethod;
use models\News;
use models\Users;

class NewsController extends Controller
{
    //News/add
    public function actionAdd(): array
    {
        if (!Users::isAdmin()) {
            return $this->redirect('/news/index');
        }
        if ($this->isPost) {
            $requestData = new RequestMethod($_POST);
            $news = new \models\News();
            $news->title = $requestData->title;
            $news->text = $requestData->text;
            $news->date = $requestData->date;

            $news->save(); // Збереження новини в базу даних
            $this->redirect('/news/index');
        }
        return $this->render();
    }
    public function actionDelete($params): void
    {
        $newsId = $params[0];
        $news = new News();
        $news->delete(['id' => $newsId]);
        $this->redirect('/news/index');
    }
    public function actionIndex(): array
    {
        $data = \models\News::getNews();
        return $this->render('views/news/view.php', ['data' => $data]);
    }
    public function actionView($params): array
    {
        $data = [];
        return $this->render('views/news/view.php', ['data' => $data]);
    }
    // News/edit/{id}
    public function actionEdit($params): array
    {
        if (!Users::isAdmin()) {
            return $this->redirect('/news/index');
        }
        $newsId = $params[0];
        $newsItem = News::getNewsById($newsId);
        if ($this->isPost) {
            $requestData = new RequestMethod($_POST);
            $data = [
                'title' => $requestData->title,
                'text' => $requestData->text,
                'date' => $requestData->date,
            ];
            News::updateNews($newsId, $data);
            $this->redirect('/news/index');
        }
        return $this->render('views/news/edit.php', ['newsItem' => $newsItem]);
    }


}