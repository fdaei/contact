<?php

namespace backend\models;

/**
 * This is the ActiveQuery class for [[City]].
 *
 * @see City
 */
class ProvinceQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return City[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return City|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    /**
     * @return ProvinceQuery
     */
    public function active(): ProvinceQuery
    {
        return $this->andWhere(['status' => Province::STATUS_ACTIVE])->orWhere(['status' => Province::STATUS_INACTIVE]);
    }
}