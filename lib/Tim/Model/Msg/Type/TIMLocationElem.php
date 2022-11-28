<?php

namespace Tim\Model\Msg\Type;

/**
 * 地理位置消息
 * 当接收方为 iOS 或 Android，且应用处在后台时，中文版离线推送文本为“[位置]”，英文版离线推送文本为“[Location]”。
 */
class TIMLocationElem extends \Tim\Model\Base
{
    public $Desc = NULL; //String 地理位置描述信息。
    public $Latitude = NULL; //Number 纬度
    public $Longitude = NULL; //Number 经度

    public function getParams()
    {
        $params = array();
        $params['MsgType'] = 'TIMLocationElem';
        if ($this->isNotNull($this->text)) {
            $params['MsgContent']['Text'] = $this->text;
        }
        if ($this->isNotNull($this->Latitude)) {
            $params['MsgContent']['Latitude'] = $this->Latitude;
        }
        if ($this->isNotNull($this->Longitude)) {
            $params['MsgContent']['Longitude'] = $this->Longitude;
        }

        return $params;
    }
}
