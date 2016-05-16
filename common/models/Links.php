<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "links".
 *
 * @property integer $id
 * @property string $title
 * @property string $url
 * @property integer $action
 */
class Links extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'links';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'url', 'action'], 'required'],
            [['action'], 'integer'],
            [['title', 'url'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ردیف',
            'title' => 'عنوان',
            'url' => 'نشانی',
            'action' => 'فعال',
        ];
    }
}
