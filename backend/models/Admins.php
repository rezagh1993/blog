<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "admins".
 *
 * @property integer $id
 * @property string $fullname
 * @property string $user
 * @property string $pass
 * @property integer $confirmed
 */
class Admins extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'admins';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname', 'user', 'pass', 'confirmed'], 'required'],
            [['confirmed'], 'integer'],
            [['fullname', 'user', 'pass'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'fullname' => 'Full Name',
            'user' => 'User Name',
            'pass' => 'Passworde',
            'confirmed' => 'Confirmed',
        ];
    }
}
