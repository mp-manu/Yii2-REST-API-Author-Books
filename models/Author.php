<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "author".
 *
 * @property int $id
 * @property string|null $fullname
 * @property int|null $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property BookAuthor[] $bookAuthors
 */
class Author extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'author';
    }

    public function rules()
    {
        return [
            [['status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['fullname'], 'string', 'max' => 255],
        ];
    }


    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['author_id' => 'id']);
    }

    //Возможность получить автора/авторов по конкретной книге
    public function getAuthorsByBook($book_id){
        return Author::find()
            ->leftJoin('book_author', 'author.id=book_author.author_id')
            ->where(['book_author.book_id' => $book_id])
            ->asArray()->all();
    }
}
