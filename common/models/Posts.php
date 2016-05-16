<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use yii\db\Expression;
use yii\behaviors\TimestampBehavior;
use yii\web\BadRequestHttpException;

/**
 * This is the model class for table "posts".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $abstract
 * @property string $content
 * @property integer $hits
 * @property integer $active
 * @property integer $create_time
 * @property integer $update_time
 * @property string $tags
 *
 * @property Comments[] $comments
 * @property PostCategory[] $postCategories
 * @property Users $user
 */
class Posts extends \yii\db\ActiveRecord
{
    public $selectCategory;
    public $selectTags;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'updatedAtAttribute' => 'update_time',
                'createdAtAttribute' => 'create_time',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
             ['selectTags', 'validCama'],
            [['user_id','title', 'abstract', 'active', 'selectCategory','selectTags'], 'required'],

            ['active','default' , 'value'=>0 ],
            ['hits','default' , 'value'=>0 ],

            [['user_id', 'hits', 'active', 'create_time', 'update_time'], 'integer'],
            [['content', 'selectTags','tags'], 'string'],
            [['title', 'abstract'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }



    public function validCama($attribute,$params)
    {
        if(strstr($this->selectTags,',')==false)
            $this->addError($attribute,'not found, in tags');
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_name' => 'نویسنده',
            'title' => 'عنوان',
            'abstract' => 'چکیده',
            'content' => 'محتوا',
            'hits' => 'بازدید شده',
            'active' =>'وضعیت',
            'create_time' => Yii::t('app', 'Create Time'),
            'update_time' => Yii::t('app', 'Update Time'),
            'tags' => Yii::t('app', 'Tags'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['post_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostCategories()
    {
        return $this->hasMany(PostCategory::className(), ['post_id' => 'id']);
    }


    public function getAllCategory()
    {
        $all=Categories::findAll(['type'=>0]);
        return ArrayHelper::map($all,'id','title');
        
    }
    public function getAllTag()
    {
        $all=Categories::findAll(['type'=> 1]);
        return ArrayHelper::map($all,'id','title');
    }


    public function getSelectTag()
    {
        $all=PostCategory::findAll(['post_id'=>$this->id]);
        $selected= ArrayHelper::getColumn($all,'category_id');
        $i=0;
        $tag_title=[];
        foreach ($selected as $id){
            $tag_id=Categories::findOne(['id'=>$id]);
            $tg_title[$i]=ArrayHelper::getValue($tag_id,'title');
            $i=$i+1;
        }
        $implode= implode(',',$tag_title);
        return $implode;
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes);
        $selectCategory=$this->selectCategory;

        $all=Categories::findAll(['type'=>0]);
        $tag_id=ArrayHelper::getColumn($all,'id');
        foreach ($tag_id as $id){
            PostCategory::deleteAll(['post_id'=>$this->id,'category_id'=>$id]);
        }

        $insert_data=[];
        foreach($selectCategory as $value)
        {
            $insert_data[]=[$this->id,$value];
        }
       
        Yii::$app->db->createCommand()->batchInsert('post_category',['post_id','category_id'],$insert_data)->execute();

        /*  Tags   */


        $selectTag=$this->selectTags;
        $this->updateAttributes([
            'tags' => $selectTag,
            'active' => 0,
             'hits'=>0,
        ]);

        $arr=explode(",",$selectTag);

        $allTag=Categories::findAll(['type'=>1]);
        $tag_id=ArrayHelper::getColumn($allTag,'id');
        foreach ($tag_id as $id){
            PostCategory::deleteAll(['post_id'=>$this->id,'category_id'=>$id]);
        }

        foreach ($arr as $value){
            $tag=Categories::findOne(['title'=>$value,'type'=>1]);

        if ($tag != null){

            $v=ArrayHelper::getValue($tag,'id');
            $model=new PostCategory();
            $model->post_id=$this->id;
            $model->category_id=$v;
            $model->save();

        }else{

            $model=new Categories();
            $model->title=$value;
            $model->type=1 ;
            $model->active=0 ;
            $model->save();
            $all=Categories::findOne(['title'=>$value,'type'=>1]);
            $v=ArrayHelper::getValue($all,'id');
            $model=new PostCategory();
            $model->post_id=$this->id;
            $model->category_id=$v;
            $model->save();
            }
        }//end foreach

       /* $all=PostCategory::findAll(['post_id'=>$this->id]);
        $selected= ArrayHelper::getColumn($all,'category_id');

        $i=0;

        foreach ($selected as $id){
            $tag_id=Categories::findOne(['id'=>$id,'type'=>1]);
            $tg_title[$i]=ArrayHelper::getValue($tag_id,'title');
            $i=$i+1;var_dump($tag_id);exit();
        }
        $implode= implode("+",$selected);*/




    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public function getCategories()
    {
        return $this->hasMany(Categories::className(),['id'=>'category_id'])->viaTable('post_category',['post_id'=>'id'])->andWhere(['{{%categories}}.type' => 0]);
    }

    public function getTags()
    {
        return $this->hasMany(Categories::className(),['id'=>'category_id'])->viaTable('post_category',['post_id'=>'id'])->andWhere(['{{%categories}}.type' => 1]);
    }
}
