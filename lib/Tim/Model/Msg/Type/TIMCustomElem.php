<?php

namespace Tim\Model\Msg\Type;

/**
 * 自定义消息
 * 当接收方为 iOS 系统且应用处在后台时，Desc 作为推送文本， Ext 字段作为 APNS 请求包 Payloads 中的 ext 键值下发， Data 字段不作为 APNs 的 Payloads 字段下发。注意，一条组合消息中只能包含一个 TIMCustomElem 自定义消息元素。
 */
class TIMCustomElem extends \Tim\Model\Base
{
    public $Data = NULL; //String 自定义消息数据。 不作为 APNs 的 payload 字段下发，故从 payload 中无法获取 Data 字段。
    //当消息中只有一个 TIMCustomElem 自定义消息元素时，如果 Desc 字段和 OfflinePushInfo.Desc 字段都不填写，将收不到该条消息的离线推送，需要填写 OfflinePushInfo.Desc 字段才能收到该消息的离线推送。
    public $Desc = NULL; //String 自定义消息描述信息。当接收方为 iOS 或 Android 后台在线时，做离线推送文本展示。若发送自定义消息的同时设置了 OfflinePushInfo.Desc 字段，此字段会被覆盖，请优先填 OfflinePushInfo.Desc 字段。
    public $Ext = NULL; //String 扩展字段。当接收方为 iOS 系统且应用处在后台时，此字段作为 APNs 请求包 Payloads 中的 Ext 键值下发，Ext 的协议格式由业务方确定，APNs 只做透传。
    public $Sound = NULL; //String 自定义 APNs 推送铃音。

    public function getParams()
    {
        $params = array();
        $params['MsgType'] = 'TIMCustomElem';
        if ($this->isNotNull($this->Data)) {
            $params['MsgContent']['Data'] = $this->Data;
        }
        if ($this->isNotNull($this->Desc)) {
            $params['MsgContent']['Desc'] = $this->Desc;
        }
        if ($this->isNotNull($this->Ext)) {
            $params['MsgContent']['Ext'] = $this->Ext;
        }
        if ($this->isNotNull($this->Sound)) {
            $params['MsgContent']['Sound'] = $this->Sound;
        }

        return $params;
    }
}
