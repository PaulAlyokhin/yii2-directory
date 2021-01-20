<?php

namespace app\models;

use borales\extensions\phoneInput\PhoneInputValidator;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "contact_numbers".
 *
 * @property int $id
 * @property int $contact_id
 * @property string $number
 *
 * @property Contacts $contact
 */
class ContactNumbers extends ActiveRecord {

    public static function tableName() {
        return 'contact_numbers';
    }

    public function rules() {
        return [
            [['contact_id', 'number'], 'required'],
            [['contact_id'], 'integer'],
            [['number'], 'string', 'max' => 24],
            [['number'], PhoneInputValidator::className(), 'region' => 'UA'],
            [['contact_id'], 'exist', 'skipOnError' => true, 'targetClass' => Contacts::className(), 'targetAttribute' => ['contact_id' => 'id']],
        ];
    }

    public function attributeLabels() {
        return [
            'id' => 'ID',
            'contact_id' => 'Contact ID',
            'number' => 'Number',
        ];
    }

    /**
     * Gets query for [[Contact]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getContact() {
        return $this->hasOne(Contacts::className(), ['id' => 'contact_id']);
    }
}