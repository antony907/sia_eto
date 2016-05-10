<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Persona;

/**
 * PersonaSearch represents the model behind the search form about `app\models\Persona`.
 */
class PersonaSearch extends Persona
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'id_tip_doc_iden', 'id_genero', 'id_est_civil'], 'integer'],
            [['num_doc', 'razon_social', 'direccion', 'nombres', 'paterno', 'materno', 'fecha_nac', 'telefono', 'celular', 'correo', 'fecha_inscripcion', 'tipo_contrib', 'estado_contrib', 'condicion_contrib'], 'safe'],
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
        $query = Persona::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'id_tip_doc_iden' => $this->id_tip_doc_iden,
            'id_genero' => $this->id_genero,
            'id_est_civil' => $this->id_est_civil,
            'fecha_nac' => $this->fecha_nac,
            'fecha_inscripcion' => $this->fecha_inscripcion,
        ]);

        $query->andFilterWhere(['like', 'num_doc', $this->num_doc])
            ->andFilterWhere(['like', 'razon_social', $this->razon_social])
            ->andFilterWhere(['like', 'direccion', $this->direccion])
            ->andFilterWhere(['like', 'nombres', $this->nombres])
            ->andFilterWhere(['like', 'paterno', $this->paterno])
            ->andFilterWhere(['like', 'materno', $this->materno])
            ->andFilterWhere(['like', 'telefono', $this->telefono])
            ->andFilterWhere(['like', 'celular', $this->celular])
            ->andFilterWhere(['like', 'correo', $this->correo])
            ->andFilterWhere(['like', 'tipo_contrib', $this->tipo_contrib])
            ->andFilterWhere(['like', 'estado_contrib', $this->estado_contrib])
            ->andFilterWhere(['like', 'condicion_contrib', $this->condicion_contrib]);

        return $dataProvider;
    }
}
