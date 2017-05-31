<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "tbl_file".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $name
 * @property string $label
 * @property string $expansion
 * @property integer $size
 * @property string $csrf
 * @property string $about_me
 * @property integer $file_type
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class File extends ActiveRecord
{

    public $imageFiles;


    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if($this->isNewRecord)
            {
                $this->user_id = Yii::$app->user->identity->id;
            }
            return true;
        }
        return false;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_file';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'size', 'file_type', 'created_at', 'updated_at'], 'integer'],
            [['name', 'expansion', 'created_at', 'updated_at'], 'required'],
            [['label', 'about_me'], 'string'],
            [['name', 'expansion'], 'string', 'max' => 255],
            [['csrf'], 'string', 'max' => 56],
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => '', 'maxFiles' => 4],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'name' => 'Name',
            'label' => 'Label',
            'expansion' => 'Expansion',
            'size' => 'Size',
            'csrf' => 'Csrf',
            'about_me' => 'About Me',
            'file_type' => 'File Type',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'imageFiles' => 'QWEQWEQWE'
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function upload()
    {
        foreach ($this->imageFiles as $file) {

            $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
        }
        return true;
    }




}
