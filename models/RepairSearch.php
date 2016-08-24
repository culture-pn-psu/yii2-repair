<?php

namespace culturePnPsu\repair\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * RepairSearch represents the model behind the search form about `culturePnPsu\repair\models\Repair`.
 */
class RepairSearch extends Repair {

    /**
     * @inheritdoc
     */
    public function rules() {
        return [
            [['status', 'created_at', 'inform_at', 'inform_by', 'staff_id', 'admin_id'], 'integer'],
            [['id', 'material_id', 'problem'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios() {
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
    public function search($params) {
        $query = Repair::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        //$where=[];
        //if (Yii::$app->user->can('AllStaff')) {
        //echo Yii::$app->user->id;
        //$where['created_by']=Yii::$app->user->id;
        //}     
//        print_r($where);
//        exit();
        $query->where(['created_by' => Yii::$app->user->id]);
//        if (Yii::$app->user->can('staffMaterial')) {
//            $query->orWhere(['status'=>[1,2,3]]);
//        }

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            //'id' => $this->id,
            'status' => $this->status,
            'inform_at' => $this->inform_at,
            'inform_by' => $this->inform_by,
            'staff_id' => $this->staff_id,
            'admin_id' => $this->admin_id,
        ]);

        $this->created_at = $this->created_at ? Yii::$app->formatter->asTimestamp(date('Y-m-d', $this->created_at)) : '';
        //echo $this->created_at;

        $query->andFilterWhere(['like', 'material_id', $this->material_id])
                ->andFilterWhere(['id', 'problem', $this->id])
                ->andFilterWhere(['like', 'problem', $this->problem])
                ->andFilterWhere(['between', 'created_at', $this->created_at, 'NOW()']);

//        var_dump($query);
//        exit();
        return $dataProvider;
    }

}
