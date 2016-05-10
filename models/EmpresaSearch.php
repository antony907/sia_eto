<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Empresa;

/**
 * EmpresaSearch represents the model behind the search form about `app\models\Empresa`.
 */
class EmpresaSearch extends Empresa
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'por_renta', 'por_participa_trab'], 'integer'],
            [['razon_social', 'ruc', 'rubro', 'telefono', 'direccion', 'ciudad', 'email', 'regimen', 'anio_ini_contable'], 'safe'],
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
        $query = Empresa::find();

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
            'por_renta' => $this->por_renta,
            'por_participa_trab' => $this->por_participa_trab,
        ]);

        $query->andFilterWhere(['like', 'razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'ruc', $this->ruc])
            ->andFilterWhere(['like', 'rubro', $this->rubro])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'ciudad', $this->ciudad])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'regimen', $this->regimen])
            ->andFilterWhere(['like', 'anio_ini_contable', $this->anio_ini_contable]);

        return $dataProvider;
    }
}
