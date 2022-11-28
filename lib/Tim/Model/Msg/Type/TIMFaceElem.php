<?php

namespace Tim\Model\Msg\Type;

/**
 * 表情消息
 * 当接收方为 iOS 或 Android，且应用处在后台时，中文版离线推送文本为“[表情]”，英文版离线推送文本为“[Face]”。
 */
class TIMFaceElem extends \Tim\Model\Base
{
    public $Index = NULL; //Number 表情索引，用户自定义。
    public $Data = NULL; //String 额外数据。

    public function getParams()
    {
        $params = array();
        $params['MsgType'] = 'TIMFaceElem';
        if ($this->isNotNull($this->Index)) {
            $params['MsgContent']['Index'] = $this->Index;
        }
        if ($this->isNotNull($this->Data)) {
            $params['MsgContent']['Data'] = $this->Data;
        }

        return $params;
    }
}
