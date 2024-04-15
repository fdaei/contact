<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[RealContactFile]].
 *
 * @see RealContactFile
 */
class RealContactFileQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->onCondition(['<>', 'status',  RealContactFile::STATUS_DELETED]);
    }

    /**
     * {@inheritdoc}
     * @return RealContactFile[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return RealContactFile|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
