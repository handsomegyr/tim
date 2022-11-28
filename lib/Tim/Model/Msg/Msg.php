<?php

namespace Tim\Model\Msg;

/**
 * 单聊消息
 */
class Msg extends \Tim\Model\Base
{
    /**
     * SyncOtherMachine Integer 选填 1：把消息同步到 From_Account 在线终端和漫游上；2：消息不同步至 From_Account；若不填写默认情况下会将消息存 From_Account 漫游
     */
    public $SyncOtherMachine = NULL;
    /**
     * From_Account String 选填 消息发送方 UserID（用于指定发送消息方帐号）
     */
    public $From_Account = NULL;
    /**
     * To_Account String 必填 消息接收方 UserID
     */
    public $To_Account = NULL;
    /**
     * MsgLifeTime Integer 选填 消息离线保存时长（单位：秒），最长为7天（604800秒）若设置该字段为0，则消息只发在线用户，不保存离线若设置该字段超过7天（604800秒），仍只保存7天若不设置该字段，则默认保存7天
     */
    public $MsgLifeTime = NULL;
    /**
     * MsgSeq Integer 选填 消息序列号（32位无符号整数），后台会根据该字段去重及进行同秒内消息的排序，详细规则请看本接口的功能说明。若不填该字段，则由后台填入随机数
     */
    public $MsgSeq = NULL;
    /**
     * MsgRandom Integer 必填 消息随机数（32位无符号整数），后台用于同一秒内的消息去重。请确保该字段填的是随机
     */
    public $MsgRandom = NULL;
    /**
     * ForbidCallbackControl Array 选填 消息回调禁止开关，只对本条消息有效，ForbidBeforeSendMsgCallback 表示禁止发消息前回调，ForbidAfterSendMsgCallback 表示禁止发消息后回调
     */
    public $ForbidCallbackControl = NULL;
    /**
     * SendMsgControl Array 选填 消息发送控制选项，是一个 String 数组，只对本条消息有效。"NoUnread"表示该条消息不计入未读数。"NoLastMsg"表示该条消息不更新会话列表。"WithMuteNotifications"表示该条消息的接收方对发送方设置的免打扰选项生效（默认不生效）。示例："SendMsgControl": ["NoUnread","NoLastMsg","WithMuteNotifications"]
     */
    public $SendMsgControl = NULL;
    /**
     * MsgBody Array 必填 消息内容，具体格式请参考 消息格式描述（注意，一条消息可包括多种消息元素，MsgBody 为 Array 类型）
     * @var \Tim\Model\Msg\Type\TIMTextElem
     */
    public $MsgBody = NULL;
    /**
     * MsgType String 必填 TIM 消息对象类型，目前支持的消息对象包括：TIMTextElem（文本消息）TIMLocationElem（位置消息）TIMFaceElem（表情消息）TIMCustomElem（自定义消息）TIMSoundElem（语音消息）TIMImageElem（图像消息）TIMFileElem（文件消息）TIMVideoFileElem（视频消息）
     */
    public $MsgType = NULL;
    /**
     * MsgContent Object 必填 对于每种 MsgType 用不同的 MsgContent 格式，具体可参考 消息格式描述
     */
    public $MsgContent = NULL;
    /**
     * CloudCustomData String 选填 消息自定义数据（云端保存，会发送到对端，程序卸载重装后还能拉取到）
     */
    public $CloudCustomData = NULL;
    /**
     * SupportMessageExtension Integer 选填 该条消息是否支持消息扩展，0为不支持，1为支持。
     */
    public $SupportMessageExtension = NULL;
    /**
     * OfflinePushInfo Object 选填 离线推送信息配置，具体可参考 消息格式描述
     */
    public $OfflinePushInfo = NULL;
    /**
     * IsNeedReadReceipt Integer 选填 该条消息是否需要已读回执，0为不需要，1为需要，默认为0
     */
    public $IsNeedReadReceipt = NULL;

    public function getParams()
    {
        $params = array();

        if ($this->isNotNull($this->SyncOtherMachine)) {
            $params['SyncOtherMachine'] = $this->SyncOtherMachine;
        }
        if ($this->isNotNull($this->From_Account)) {
            $params['From_Account'] = $this->From_Account;
        }
        if ($this->isNotNull($this->To_Account)) {
            $params['To_Account'] = $this->To_Account;
        }
        if ($this->isNotNull($this->MsgLifeTime)) {
            $params['MsgLifeTime'] = $this->MsgLifeTime;
        }
        if ($this->isNotNull($this->MsgSeq)) {
            $params['MsgSeq'] = $this->MsgSeq;
        }
        if ($this->isNotNull($this->MsgRandom)) {
            $params['MsgRandom'] = $this->MsgRandom;
        }
        if ($this->isNotNull($this->ForbidCallbackControl)) {
            $params['ForbidCallbackControl'] = $this->ForbidCallbackControl;
        }
        if ($this->isNotNull($this->SendMsgControl)) {
            $params['SendMsgControl'] = $this->SendMsgControl;
        }
        if ($this->isNotNull($this->MsgBody)) {
            $params['MsgBody'] = $this->MsgBody->getParams();;
        }
        if ($this->isNotNull($this->MsgType)) {
            $params['MsgType'] = $this->MsgType;
        }
        if ($this->isNotNull($this->MsgContent)) {
            $params['MsgContent'] = $this->MsgContent;
        }
        if ($this->isNotNull($this->CloudCustomData)) {
            $params['CloudCustomData'] = $this->CloudCustomData;
        }
        if ($this->isNotNull($this->SupportMessageExtension)) {
            $params['SupportMessageExtension'] = $this->SupportMessageExtension;
        }
        if ($this->isNotNull($this->OfflinePushInfo)) {
            $params['OfflinePushInfo'] = $this->OfflinePushInfo;
        }
        if ($this->isNotNull($this->IsNeedReadReceipt)) {
            $params['IsNeedReadReceipt'] = $this->IsNeedReadReceipt;
        }
        return $params;
    } 
}
