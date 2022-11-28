<?php

namespace Tim\Model\Msg\Type;

/**
 * 文本消息
 * 当接收方为 iOS 或 Android，且应用处在后台时，JSON 请求包体中的 Text 字段作为离线推送的文本展示。
 */
class TIMTextElem extends \Tim\Model\Base
{
    public $Text = NULL; //String 消息内容。当接收方为 iOS 或 Android 后台在线时，作为离线推送的文本展示。

    public function getParams()
    {
        $params = array();
        $params['MsgType'] = 'TIMTextElem';
        if ($this->isNotNull($this->Text)) {
            $params['MsgContent']['Text'] = $this->Text;
        }

        return $params;
    }
}
