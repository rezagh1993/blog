<?php

namespace frontend\models;

use Yii;
use yii\base\Model;

class EntryForm extends Models
{
    public $name;
    public $email;

    public function rules()
    {
        return [
            [['name','email'],'required'],
            ['email','email']
        ];

    }

}