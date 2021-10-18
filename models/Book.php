<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "book".
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int $publish_year
 * @property int|null $isbn
 * @property int|null $status
 * @property string|null $created_at
 * @property int|null $created_by
 * @property string|null $updated_at
 * @property int|null $updated_by
 *
 * @property BookAuthor[] $bookAuthors
 */
class Book extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'book';
    }


    public function rules()
    {
        return [
            [['name', 'publish_year'], 'required'],
            [['description'], 'string'],
            [['publish_year', 'isbn', 'status', 'created_by', 'updated_by'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['name'], 'string', 'max' => 255],
        ];
    }


    public function getBookAuthors()
    {
        return $this->hasMany(BookAuthor::className(), ['book_id' => 'id']);
    }

    //Возможность создать новую книгу с присвоением автора
    public function addBook($request){
        $this->name = $request['name'];
        $this->description = $request['description'];
        $this->publish_year = $request['publish_year'];
        $this->isbn = $request['isbn'];
        $this->status = 1;
        if($this->save() && !empty($request['authors_id'])){
            foreach ($request['authors_id'] as $author_id) {
                $bookAuthor = new BookAuthor();
                $bookAuthor->author_id = $author_id;
                $bookAuthor->book_id = $this->id;
                $bookAuthor->save();
            }
            return true;
        }else{
            return false;
        }
    }
    //Возможность получить все книги указанного автора
    public function getBooksByAuthor($author_id){
        return Book::find()
            ->leftJoin('book_author', 'book.id=book_author.book_id')
            ->where(['book_author.author_id' => $author_id])
            ->asArray()->all();
    }

    //Возможность удалить книгу.
    public function removeBook($book_id){
        return Book::findOne($book_id)->delete();
    }

    //Возможность сменить одного из авторов книги
    public function changeBookAuthor($book_id, $from_author, $to_author){
        Yii::$app->db
            ->createCommand('UPDATE book_author SET author_id = '.$to_author.' WHERE book_id = '.$book_id.' AND author_id = '.$from_author)->execute();
        return true;
    }
}
