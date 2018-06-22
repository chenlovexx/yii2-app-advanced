<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use \yii\db\ActiveRecord;
/**
 * This is the model class for table "auth_rule".
 *
 * @property string $name
 * @property resource $data
 * @property int $created_at
 * @property int $updated_at
 *
 * @property AuthItem[] $authItems
 */
class AuthRule extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                       ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                       ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];

    }
    
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'auth_rule';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['data'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 64],
            [['name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Name',
            'data' => 'Data',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthItems()
    {
        return $this->hasMany(AuthItem::className(), ['rule_name' => 'name']);
    }
    
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            $rule_path = 'common\rbac\\'. substr($this->name, 2). 'Rule';
            //$current_time = time();
            $this->data = 'O:'.strlen($rule_path).':"'. $rule_path . '":3:{s:4:"name";s:'.strlen($this->name).':"'.$this->name.'";s:9:"createdAt";i:'.$this->created_at.';s:9:"updatedAt";i:'.$this->updated_at.';}';
           // $this->created_at = $current_time;
           // $this->updated_at = $current_time;
            return true;
        } else {
            return false;
        }
    }
}
