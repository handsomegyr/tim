<?php

namespace Tim\Model\Msg\Type;

/**
 * 合并转发消息元素
 * 终端 5.2.210 及以上版本，web & 小程序 & uni-app 2.10.1 及以上版本才支持收发合并转发消息。
 */
class TIMRelayElem extends \Tim\Model\Base
{
    public $Title = NULL; //String 合并转发消息的标题。
    public $MsgNum = NULL; //Integer 被转发的消息条数。
    public $CompatibleText = NULL; //String 兼容文本。当不支持合并转发消息的老版本 SDK 收到此类消息时，IM 后台会将该消息转化成兼容文本再下发。
    public $AbstractList = NULL; //Array 合并消息的摘要列表，是一个 String 数组。
    public $MsgList = NULL; //Array 消息列表。当被转发的消息长度之和小于等于 8K 时才会有此字段，此时不会有 JsonMsgKey 字段。
    public $JsonMsgKey = NULL; //String 合并转发的消息列表 Key。当被转发的消息长度之和大于 8K 时才会有此字段，此时不会有 MsgList 字段。

    public function getParams()
    {
        $params = array();
        $params['MsgType'] = 'TIMRelayElem';
        if ($this->isNotNull($this->Title)) {
            $params['MsgContent']['Title'] = $this->Title;
        }
        if ($this->isNotNull($this->MsgNum)) {
            $params['MsgContent']['MsgNum'] = $this->MsgNum;
        }
        if ($this->isNotNull($this->CompatibleText)) {
            $params['MsgContent']['CompatibleText'] = $this->CompatibleText;
        }
        if ($this->isNotNull($this->AbstractList)) {
            $params['MsgContent']['AbstractList'] = $this->AbstractList;
        }
        if ($this->isNotNull($this->MsgList)) {
            $params['MsgContent']['MsgList'] = $this->MsgList;
        }
        if ($this->isNotNull($this->JsonMsgKey)) {
            $params['MsgContent']['JsonMsgKey'] = $this->JsonMsgKey;
        }

        return $params;
    }
}
