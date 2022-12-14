<?php

namespace common\components;

use Exception;
use lubosdz\captchaExtended\CaptchaExtendedAction;
use stdClass;
use Yii;

class CaptchaHelper extends CaptchaExtendedAction
{
    private $code;


    /**
     * CaptchaHelper constructor.
     * @throws \yii\base\InvalidConfigException
     */
    public function __construct()
    {
        $this->init();
        $this->mode = self::MODE_MATH;

    }

    /**
     * @return string
     * @throws \yii\base\InvalidConfigException
     */
    public function generateImage()
    {
        $cacheKey = microtime(true);
        $base64 = "data:image/png;base64," . base64_encode($this->renderImage($this->generateCode()));
        Yii::$app->cache->set($this->generateSessionKey($this->generateCode(), $cacheKey), $this->generateCode(), 60);
        return [
            'image' => $base64,
            'expireTime' => time() + 60,
            'key' => $cacheKey
        ];
    }

    /**
     * @return string
     */
    public function generateCode(): string
    {
        if ($this->code) {
            return $this->code;
        }

        return $this->code = $this->generateVerifyCode()['code'];
    }

    /**
     * @param string $code
     * @return bool
     * @throws Exception
     */
    public function verify($code, $cacheKey): bool
    {
        $verify = Yii::$app->cache->get($this->generateSessionKey($code, (float)$cacheKey));

        Yii::$app->cache->delete($this->generateSessionKey($code, (float)$cacheKey));

        if ($verify === $code) {
            return true;
        }

        return false;
    }

    /**
     * @return string
     */
    private function generateSessionKey(string $code): string
    {
        return base64_encode(Yii::$app->request->getRemoteIP() . Yii::$app->request->getUserAgent() . $code);
    }
}