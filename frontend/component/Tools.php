<?php

namespace frontend\component;

use Yii;
use yii\base\Component;

class Tools extends Component
{
    public function safe($text)
    {
        return strip_tags($text, '<p><img><a><br><i><u><strong><em><div><span>');
    }
}