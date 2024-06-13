<?php

namespace controllers;

use core\Controller;
use core\RequestMethod;
use core\Core;
use core\Template;
use models\News;
use models\Users;
use core\DB;

class NewsController extends Controller
{
    //News/add
    public function actionAdd(): array
    {
        if ($this->isPost) {
            $requestData = new RequestMethod($_POST);

            $news = new \models\News();
            $news->title = $requestData->title;
            $news->short_text = $requestData->short_text;
            $news->text = $requestData->text;
            $news->date = $requestData->date;

            $news->save(); // Збереження новини в базу даних

            // Після збереження перенаправлення на іншу сторінку чи відображення повідомлення
            $this->redirect('/news/index');
        }

        return $this->render();
    }

//Видалення новини
    public function actionDelete($params): void
    {
        $newsId = $params[0];

        $news = new News();
        $news->delete(['id' => $newsId]);

        // Redirect back to the news index after deletion
        $this->redirect('/news/index');
    }


    public function actionIndex(): array
    {
        // Default sorting and search parameters
        $sortBy = isset($_GET['sort']) ? $_GET['sort'] : 'date'; // Default sort by date
        $sortOrder = isset($_GET['order']) && strtolower($_GET['order']) === 'asc' ? 'ASC' : 'DESC'; // Default sort order DESC
        $searchTerm = isset($_GET['search']) ? $_GET['search'] : '';

        // Get news data based on sort and search criteria
        $data = News::getNews($sortBy, $sortOrder, $searchTerm);

        return $this->render('views/news/view.php', [
            'data' => $data,
            'sortBy' => $sortBy,
            'sortOrder' => $sortOrder,
            'searchTerm' => $searchTerm,
        ]);
    }



    public function actionView($params): array
    {
        $data = [];
        return $this->render('views/news/view.php', ['data' => $data]);
    }
    // News/edit/{id}
    public function actionEdit($params): array
    {
        $newsId = $params[0];
        $newsItem = News::getNewsById($newsId);

        if ($this->isPost) {
            $requestData = new RequestMethod($_POST);

            // Update news item with new data
            $data = [
                'title' => $requestData->title,
                'short_text' => $requestData->short_text,
                'text' => $requestData->text,
                'date' => $requestData->date,
            ];

            News::updateNews($newsId, $data);

            // Redirect back to news index after update
            $this->redirect('/news/index');
        }

        return $this->render('views/news/edit.php', ['newsItem' => $newsItem]);
    }
}