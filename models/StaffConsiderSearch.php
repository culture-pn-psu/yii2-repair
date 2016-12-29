<?php

namespace culturePnPsu\repair\models;

use yii\data\ActiveDataProvider;

/**
 * RepairStaffSearch represents the model behind the search form about `culturePnPsu\repair\models\Repair`.
 */
class StaffConsiderSearch extends StaffSearch {

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params) {
        $query = Repair::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $query->where(['status' => 2]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
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
            'repair_at' => $this->repair_at,
            'returned_at' => $this->returned_at,
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
