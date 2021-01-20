<?php

namespace app\models;

use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contacts".
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $birthday
 *
 * @property ContactNumbers[] $contactNumbers
 */
class Contacts extends ActiveRecord {

    public $minAge = 18;

    public static function tableName() {
        return 'contacts';
    }

    public function rules() {
        return [
            [['first_name'], 'required'],
            [['birthday'], 'safe'],
            [['first_name', 'last_name'], 'string', 'max' => 256],
            [['email'], 'email'],
            [['email'], 'string', 'max' => 512],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'E-Mail',
            'birthday' => 'Birthday',
        ];
    }

    /**
     * Gets query for [[ContactNumbers]].
     *
     * @return ActiveQuery
     */
    public function getContactNumbers() {
        return $this->hasMany(ContactNumbers::className(), ['contact_id' => 'id']);
    }
}