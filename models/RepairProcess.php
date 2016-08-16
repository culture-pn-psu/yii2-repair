<?php

namespace backend\modules\repair\models;

use Yii;

/**
 * This is the model class for table "repair_process".
 *
 * @property integer $repair_id
 * @property integer $action_at
 * @property integer $status
 * @property string $comment
 * @property integer $user_id
 *
 * @property Repair $repair
 */
class RepairProcess extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'repair_process';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['repair_id', 'action_at', 'status', 'user_id'], 'required'],
            [['repair_id', 'action_at', 'status', 'user_id'], 'integer'],
            [['comment'], 'string']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'repair_id' => Yii::t('person', 'รหัสแจ้งซ่อม'),
            'action_at' => Yii::t('person', 'เมื่อ'),
            'status' => Yii::t('person', 'สถานะ'),
            'comment' => Yii::t('person', 'หมายเหตุ'),
            'user_id' => Yii::t('person', 'โดย'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepair()
    {
        return $this->hasOne(Repair::className(), ['id' => 'repair_id']);
    }
}
