<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "library_bookstatus".
 *
 * @property integer $id
 * @property string $bookstatus
 */
class Bookstatus extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'library_bookstatus';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'bookstatus'], 'required'],
            [['id'], 'integer'],
            [['bookstatus'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'bookstatus' => 'Bookstatus',
        ];
    }
}
