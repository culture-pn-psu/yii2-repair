<?php

namespace culturePnPsu\repair\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use culturePnPsu\repair\models\Repair;

/**
 * RepairedSearch represents the model behind the search form about `culturePnPsu\repair\models\Repair`.
 */
class RepairedSearch extends Repair
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'type', 'created_at', 'created_by', 'updated_at', 'updated_by', 'inform_at', 'inform_by', 'staff_id', 'admin_id'], 'integer'],
            [['material_id', 'problem'], 'safe'],
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
        
        //if (Yii::$app->user->can('staffMaterial')) {
            $query->andWhere(['status'=>range(1,7)]);
        //}

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
            'staff_id' => $this->staff_id,
            'admin_id' => $this->admin_id,
        ]);

        $query->andFilterWhere(['like', 'material_id', $this->material_id])
            ->andFilterWhere(['like', 'problem', $this->problem]);

        return $dataProvider;
    }
}
