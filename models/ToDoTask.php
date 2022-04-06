<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "to_do_task".
 *
 * @property int $id
 * @property string $task
 * @property string|null $date
 * @property string|null $status
 */
class ToDoTask extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'to_do_task';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['task'], 'required'],
            [['task'], 'string', 'max' => 255],
            [['date', 'status'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'task' => 'Task',
            'date' => 'Date',
            'status' => 'Status',
        ];
    }
}
