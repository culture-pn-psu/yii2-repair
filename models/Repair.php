<?php

namespace backend\modules\repair\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\User;
use backend\modules\material\models\Material;

/**
 * This is the model class for table "repair".
 *
 * @property integer $id
 * @property string $material_id
 * @property string $problem
 * @property string $solving
 * @property integer $status
 * @property integer $type
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $inform_at
 * @property integer $inform_by
 * @property integer $staff_id
 * @property integer $staff_status
 * @property string $staff_comment
 * @property integer $staff_at
 * @property integer $boss_id
 * @property integer $boss_status
 * @property string $boss_comment
 * @property integer $boss_at
 * @property integer $admin_id
 * @property integer $admin_status
 * @property string $admin_comment
 * @property integer $admin_at
 *
 * @property Material $material
 * @property User $createdBy
 * @property RepairProcess[] $repairProcesses
 */
class Repair extends \yii\db\ActiveRecord {

    /**
     * @inheritdoc
     */
    public static function tableName() {
        return 'repair';
    }

    public function behaviors() {
        return [
            [
                'class' => 'mdm\autonumber\Behavior',
                'attribute' => 'id', // required
                //'group' => $this->id, // optional
                'value' => 'SV' . (substr((date('Y') + 543), 2)) . '?', // format auto number. '?' will be replaced with generated number
                'digit' => 4 // optional, default to null. 
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            //[['id'], 'autonumber', 'format' => 'SV' . (substr((date('Y') + 543), 2)) . '?','digit'=>4],
            [['material_id'], 'required'],
            [['problem', 'solving', 'staff_comment', 'boss_comment', 'admin_comment'], 'string'],
            [['status', 'type', 'created_at', 'created_by', 'updated_at', 'updated_by', 'inform_at', 'inform_by', 'staffMaterial_id', 'staffMaterial_at', 'staff_id', 'staff_status', 'staff_at', 'boss_id', 'boss_status', 'boss_at', 'admin_id', 'admin_status', 'admin_at'], 'integer'],
            [['material_id'], 'string', 'max' => 30],
            [['id'], 'string', 'max' => 8]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels() {
        return [
            'id' => Yii::t('person', 'เลขที่ใบแจ้งแซ่ม'),
            'material_id' => Yii::t('person', 'เลขครุภัณฑ์'),
            'problem' => Yii::t('person', 'อาการที่ชำรุด'),
            'solving' => Yii::t('person', 'Solving'),
            'status' => Yii::t('person', 'สถานะ'),
            'statusLabel' => Yii::t('app', 'สถานะ'),
            'type' => Yii::t('person', 'ประเภทงานซ่อม'),
            'created_at' => Yii::t('person', 'สร้างเมื่อ'),
            'created_by' => Yii::t('person', 'สร้างโดย'),
            'updated_at' => Yii::t('person', 'แก้ไขเมื่อ'),
            'updated_by' => Yii::t('person', 'แก้ไขโดย'),
            'inform_at' => Yii::t('person', 'แจ้งเมื่อ'),
            'inform_by' => Yii::t('person', 'แจ้งโดย'),
            'staffMaterial_id' => Yii::t('person', 'เจ้าหน้าที่พัสดุ'),
            'staffMaterial_at' => Yii::t('person', 'เมื่อ'),
            'staff_id' => Yii::t('person', 'เจ้าหน้าที่ซ่อม'),
            'staff_status' => Yii::t('person', 'สถานะ'),
            'staff_comment' => Yii::t('person', 'ความคิดเห็นจากเจ้าหน้าที่'),
            'staff_at' => Yii::t('person', 'เจ้าหน้าลงเวลาเมื่อ'),
            'boss_id' => Yii::t('person', 'หัวหน้า'),
            'boss_status' => Yii::t('person', 'สถานะ'),
            'boss_comment' => Yii::t('person', 'ความคิดเห็นจากหัวหน้า'),
            'boss_at' => Yii::t('person', 'หัวหน้าลงเวลาเมื่อ'),
            'admin_id' => Yii::t('person', 'ผู้บริหาร'),
            'admin_status' => Yii::t('person', 'สถานะ'),
            'admin_comment' => Yii::t('person', 'ความคิดเห็นจากผู้บริหาร'),
            'admin_at' => Yii::t('person', 'ผู้บริหารลงเวลาเมื่อ'),
        ];
    }

    //public $material_title;
    //public $material_brand;

    public static function itemsAlias($key) {
        $items = [
            'status' => [
                0 => Yii::t('app', 'ร่าง'),
                1 => Yii::t('app', 'เสนอ'),
                2 => Yii::t('app', 'พิจารณา'),
                3 => Yii::t('app', 'อนุมัติ'),
                4 => Yii::t('app', 'ไม่อนุมัติ'),
                5 => Yii::t('app', 'ดำเนินการซ่อม'),
                6 => Yii::t('app', 'ซ่อมแล้ว'),
                7 => Yii::t('app', 'ยกเลิก'),
                8 => Yii::t('app', 'ส่งคืนแล้ว'),
            ],
            'type' => [
                1 => Yii::t('app', 'ครุภัณฑ์ทั่วไป'),
                2 => Yii::t('app', 'คอมพิวเตอร์'),
            ],
            'staff_status' => [
                1 => Yii::t('app', 'เจ้าหน้าที่คอมพิวเตอร์เป็นคนซ่อม'),
                2 => Yii::t('app', 'ส่งร้าน'),
            ],
            'boss_status' => [
                1 => Yii::t('app', 'อนุมัติ'),
                0 => Yii::t('app', 'ไม่อนุมัติ'),
            ],
            'admin_status' => [
                1 => Yii::t('app', 'อนุมัติ'),
                0 => Yii::t('app', 'ไม่อนุมัติ'),
            ],
        ];
        return ArrayHelper::getValue($items, $key, []);
    }

    public function getStatusLabel() {
        $status = ArrayHelper::getValue($this->getItemStatus(), $this->status);
        $status = ($this->status === NULL) ? ArrayHelper::getValue($this->getItemStatus(), 0) : $status;
        switch ($this->status) {
            case '0' :
            case NULL :
                $str = '<span class="label label-warning">' . $status . '</span>';
                break;

            case '1' :
                $str = '<span class="label label-warning">' . $status . '</span>';
                break;

            case '2' :
                $str = '<span class="label label-primary">' . $status . '</span>';
                break;

            case '3' :
                $str = '<span class="label label-success">' . $status . '</span>';
                break;

            case '4' :
                $str = '<span class="label label-drager">' . $status . '</span>';
                break;

            //case '2' :
            case '5' :
                $str = '<span class="label label-primary">' . $status . '</span>';
                break;

            case '6' :
                $str = '<span class="label label-success">' . $status . '</span>';
                break;
            case '8' :
                $str = '<span class="label label-info">' . $status . '</span>';
                break;
            default :
                $str = $status;
                break;
        }

        return $str;
    }

    public static function getItemStatus() {
        return self::itemsAlias('status');
    }

    public function getTypeLabel() {
        return ArrayHelper::getValue($this->getItemType(), $this->type);
    }

    public static function getItemType() {
        return self::itemsAlias('type');
    }

    public function getStaffStatusLabel() {
        return ArrayHelper::getValue($this->getItemStaffStatus(), $this->staff_status);
    }

    public static function getItemStaffStatus() {
        return self::itemsAlias('staff_status');
    }

    public function getBossStatusLabel() {
        return ArrayHelper::getValue($this->getItemBossStatus(), $this->boss_status);
    }

    public static function getItemBossStatus() {
        return self::itemsAlias('boss_status');
    }

    public function getAdminStatusLabel() {
        return ArrayHelper::getValue($this->getItemAdminStatus(), $this->admin_status);
    }

    public static function getItemAdminStatus() {
        return self::itemsAlias('admin_status');
    }

    ##########################################
    /**
     * @return \yii\db\ActiveQuery
     */

    public function getMaterial() {
        return $this->hasOne(Material::className(), ['id' => 'material_id']);
    }

    public function getInformBy() {
        $model = $this->hasOne(User::className(), ['id' => 'created_by']);
        return isset($model->id) ? $model->id : NULL;
    }

    public function getCreatedBy() {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    public function getRepairProcesses() {
        return $this->hasMany(RepairProcess::className(), ['repair_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaff() {
        return $this->hasOne(User::className(), ['id' => 'staff_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBoss() {
        return $this->hasOne(User::className(), ['id' => 'boss_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAdmin() {
        return $this->hasOne(User::className(), ['id' => 'admin_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStaffMaterial() {
        return $this->hasOne(User::className(), ['id' => 'staffMaterial_id']);
    }

}
