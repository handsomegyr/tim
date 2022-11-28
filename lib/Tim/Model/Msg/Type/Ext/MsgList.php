<?php

namespace Tim\Model\Msg\Type\Ext;

/**
 * 消息列表
 */
class MsgList extends \Tim\Model\Base
{
    public $From_Account = NULL; //String 消息发送方 UserID。被转发的消息为单聊或群聊时都有此字段。
    public $To_Account = NULL; //String 消息接收方 UserID。被转发的消息为单聊才有此字段。
    public $GroupId = NULL; //String 群ID。被转发的消息为群聊才有此字段。
    public $MsgSeq = NULL; //Integer 消息序列号（32位无符号整数）。
    public $MsgRandom = NULL; //Integer 消息随机数（32位无符号整数）。
    public $MsgTimeStamp = NULL; //Integer 消息的秒级时间戳。
    public $MsgBody = NULL; //Array 消息内容，具体格式请参考 消息格式描述（注意，一条消息可包括多种消息元素，MsgBody 为 Array 类型）。
    public $CloudCustomData = NULL; //String 消息自定义数据（云端保存，会发送到对端，程序卸载重装后还能拉取到）。

    public function getParams()
    {
        $params = array();
        if ($this->isNotNull($this->From_Account)) {
            $params['From_Account'] = $this->From_Account;
        }
        if ($this->isNotNull($this->To_Account)) {
            $params['To_Account'] = $this->To_Account;
        }
        if ($this->isNotNull($this->GroupId)) {
            $params['GroupId'] = $this->GroupId;
        }
        if ($this->isNotNull($this->MsgSeq)) {
            $params['MsgSeq'] = $this->MsgSeq;
        }
        if ($this->isNotNull($this->MsgRandom)) {
            $params['MsgRandom'] = $this->MsgRandom;
        }
        if ($this->isNotNull($this->MsgTimeStamp)) {
            $params['MsgTimeStamp'] = $this->MsgTimeStamp;
        }
        if ($this->isNotNull($this->MsgBody)) {
            foreach ($this->MsgBody as $value) {
                $params['MsgBody'][] = $value->getParams();
            }
        }
        if ($this->isNotNull($this->CloudCustomData)) {
            $params['CloudCustomData'] = $this->CloudCustomData;
        }

        return $params;
    }
}
