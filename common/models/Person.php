<?php

namespace common\models;

use backend\controllers\ApiJob;
use Yii;

/**
 * This is the model class for table "person".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 *
 * @property Phone[] $phones
 */
class Person extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'person';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['first_name', 'last_name'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhones()
    {
        return $this->hasMany(Phone::className(), ['person_id' => 'id']);
    }

    public function fields()
    {
        return [
            'firstName' => 'first_name',
            'lastName' => 'last_name',
        ];
    }

    public function beforeSave($insert)
    {
        Yii::$app->queue(new ApiJob([
            'data' => $insert
        ]));

        return false;
    }
}
