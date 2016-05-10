<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\AsientoDetalle;

/**
 * AsientoDetalleSearch represents the model behind the search form about `app\models\AsientoDetalle`.
 */
class AsientoDetalleSearch extends AsientoDetalle
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'pcge_auxiliar_id', 'tipo_documento_id', 'persona_id', 'asiento_contable_id'], 'integer'],
            [['num_doc', 'fecha', 'glosa'], 'safe'],
            [['debe', 'haber'], 'number'],
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
        $query = AsientoDetalle::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'fecha' => $this->fecha,
            'debe' => $this->debe,
            'haber' => $this->haber,
            'pcge_auxiliar_id' => $this->pcge_auxiliar_id,
            'tipo_documento_id' => $this->tipo_documento_id,
            'persona_id' => $this->persona_id,
            'asiento_contable_id' => $this->asiento_contable_id,
        ]);

        $query->andFilterWhere(['like', 'num_doc', $this->num_doc])
            ->andFilterWhere(['like', 'glosa', $this->glosa]);

        return $dataProvider;
    }
}
