<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_comment".
 *
 * @property integer $id
 * @property string $content
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $author
 * @property string $email
 * @property string $url
 * @property integer $post_id
 *
 * @property TblPost $id0
 */
class Comment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tbl_comment';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'created_at', 'updated_at', 'author', 'email', 'url', 'post_id'], 'required'],
            [['content'], 'string'],
            [['status', 'created_at', 'updated_at', 'post_id'], 'integer'],
            [['author', 'email', 'url'], 'string', 'max' => 255],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Comment::className(), 'targetAttribute' => ['id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'content' => 'Content',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'author' => 'Author',
            'email' => 'Email',
            'url' => 'Url',
            'post_id' => 'Post ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Post::className(), ['id' => 'id']);
    }
}
