<?php

namespace app\models;

use Yii;

use yii\base\Model;

use yii\data\Pagination;

class SearchForm extends Model

{

    public $text;

    public function rules()

    {

        return [

            [['text'], 'required']

        ];

    }

    public function SearchAtricle($pageSize = 3){

        $query = Article::find()->andWhere(['like', 'tag','%' . $this->text . '%', false]);

        $count = $query->count();

        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => $pageSize]);

        $articles = $query->offset($pagination->offset)

            ->limit($pagination->limit)

            ->all();

        $data['articles'] = $articles;

        $data['pagination'] = $pagination;

        return $data;

    }

}