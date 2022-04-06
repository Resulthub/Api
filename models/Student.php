<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "student".
 *
 * @property int $ID
 * @property string $Name
 * @property string $Last_Name
 * @property string $Email
 */
class Student extends \yii\db\ActiveRecord
{
    const SCENARIO_CREATE = 'create';
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'student';
    }

    /**
     * {@inheritdoc}
     */
    
    public function rules()
    {
        return [
            [['ID'], 'required'],
            [['ID'], 'integer'],
            [['Name', 'Last_Name'], 'string', 'max' => 40],
            [['Email'], 'string', 'max' => 255],
            [['ID'], 'unique'],
        ];
    }

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios['create'] = ['Name','Last_Name','Email'];
        return $scenarios;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'Name' => 'Name',
            'Last_Name' => 'Last Name',
            'Email' => 'Email',
        ];
    }
}
