<?php

namespace backend\modules\repair\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\modules\repair\models\Repair;

/**
 * ComSearch represents the model behind the search form about `backend\modules\repair\models\Repair`.
 */
class ComSearch extends Repair
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'type', 'created_at', 'created_by', 'updated_at', 'updated_by', 'inform_at', 'inform_by', 'staffMaterial_id', 'staffMaterial_at', 'staff_id', 'staff_status', 'staff_at', 'boss_id', 'boss_status', 'boss_at', 'admin_id', 'admin_status', 'admin_at'], 'integer'],
            [['material_id', 'problem', 'solving', 'staff_comment', 'boss_comment', 'admin_comment'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Repair::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->andWhere(['type'=>2,'status'=>2]);
        $query->andWhere(['staff_status'=>null]);
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'type' => $this->type,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'inform_at' => $this->inform_at,
            'inform_by' => $this->inform_by,
            'staffMaterial_id' => $this->staffMaterial_id,
            'staffMaterial_at' => $this->staffMaterial_at,
            'staff_id' => $this->staff_id,
            'staff_status' => $this->staff_status,
            'staff_at' => $this->staff_at,
            'boss_id' => $this->boss_id,
            'boss_status' => $this->boss_status,
            'boss_at' => $this->boss_at,
            'admin_id' => $this->admin_id,
            'admin_status' => $this->admin_status,
            'admin_at' => $this->admin_at,
        ]);

        $query->andFilterWhere(['like', 'material_id', $this->material_id])
            ->andFilterWhere(['like', 'problem', $this->problem])
            ->andFilterWhere(['like', 'solving', $this->solving])
            ->andFilterWhere(['like', 'staff_comment', $this->staff_comment])
            ->andFilterWhere(['like', 'boss_comment', $this->boss_comment])
            ->andFilterWhere(['like', 'admin_comment', $this->admin_comment]);

        return $dataProvider;
    }
}
