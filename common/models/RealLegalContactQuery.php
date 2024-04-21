<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[LegalContactFile]].
 *
 * @see LegalContactFile
 */
class RealLegalContactQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this;
    }

    /**
     * {@inheritdoc}
     * @return LegalContactFile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return LegalContactFile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
