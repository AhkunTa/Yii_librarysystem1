<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "library_type".
 *
 * @property integer $typeid
 * @property string $type
 *
 * @property Book[] $libraryBooks
 */
class Type extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'library_type';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'required'],
            [['type'], 'string', 'max' => 20],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'typeid' => 'Typeid',
            'type' => 'Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLibraryBooks()
    {
        return $this->hasMany(Book::className(), ['booktypeid' => 'typeid']);
    }
}
