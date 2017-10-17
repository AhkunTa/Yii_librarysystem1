<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "library_back".
 *
 * @property integer $id
 * @property string $ifback
 */
class Back extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'library_back';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'ifback'], 'required'],
            [['id'], 'integer'],
            [['ifback'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'ifback' => 'Ifback',
        ];
    }
}
