<?php

namespace frontend\models;

use Yii;
use \common\models\User; 
/**
 * This is the model class for table "post".
 *
 * @property int $id
 * @property string $title
 * @property string $body
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			[['title', 'body'], 'required'],
            [['body'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'body' => 'Body',
        ];
    }
	
	public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'createdBy']);
    }
}
