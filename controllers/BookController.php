<?php

namespace app\controllers;

use app\models\Book;
use app\models\BookAuthor;
use yii\helpers\ArrayHelper;

class BookController extends \yii\rest\ActiveController
{
    public $modelClass = 'app\models\Book';

    private function errorResponse($message)
    {

        // set response code to 400
        \Yii::$app->response->statusCode = 400;

        return $this->asJson(['error' => $message]);
    }

    //1.Список книг автора (идентификатор автора передавать в параметре).
    public function actionAuthorBooks($author_id)
    {
        $author_books = Book::find()
            ->leftJoin('book_author', 'book.id=book_author.book_id')
            ->where(['book_author.author_id' => $author_id])->all();
        return $this->asJson($author_books);
    }


    //2.Удаление книги автора.
    public function actionDeleteBookByAuthor($author_id)
    {

        $author_books = BookAuthor::find()
            ->select('book_id')
            ->where(['author_id' => $author_id])
            ->asArray()->all();

        if (Book::deleteAll(['IN', 'id', array_values($author_books)])) {
            return $this->asJson(['status' => 200, 'message' => 'Success deleted!']);
        } else {
            return $this->asJson(['status' => 400, 'message' => 'Error!']);
        }
    }


    //3.Возможность смены автора книги.

    public function actionChangeBookAuthor($book_id, $from_author_id, $to_author_id)
    {
        $book = Book::findOne($book_id);

        if ($book->changeBookAuthor($book_id, $from_author_id, $to_author_id)) {
            return $this->asJson(['status' => 200, 'message' => 'Success changed!']);
        } else {
            return $this->asJson(['status' => 400, 'message' => 'Error!']);
        }
    }
    //4.Создание новой книги автора
    public function actionCreate()
    {
        $model = new Book();

        if ($model->load(\Yii::$app->request->post()) && $model->save()) {
            return $this->asJson(['status' => 200, 'message' => 'Success changed!']);
        }
        return $this->asJson(['status' => 400, 'message' => 'Error!']);
    }
}
