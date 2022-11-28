<?php

namespace Tim\Model\Msg\Type;

/**
 * 语音消息元素
 * 通过服务端集成的 Rest API 接口发送语音消息时，必须填入语音的 Url、UUID、Download_Flag 字段。需保证通过 Url 能下载到对应语音。UUID 字段需填写全局唯一的 String 值，一般填入语音文件的 MD5 值。消息接收者可以通过 V2TIMSoundElem.getUUID() 拿到设置的 UUID 字段，业务 App 可以用这个字段做语音的区分。Download_Flag 字段必须填2。
 */
class TIMSoundElem extends \Tim\Model\Base
{
    public $Url = NULL; // String 语音下载地址，可通过该 URL 地址直接下载相应语音。
    public $UUID = NULL; // String 语音的唯一标识，客户端用于索引语音的键值。
    public $Size = NULL; // Number 语音数据大小，单位：字节。
    public $Second = NULL; // Number 语音时长，单位：秒。
    public $Download_Flag = NULL; // Number 语音下载方式标记。目前 Download_Flag 取值只能为2，表示可通过Url字段值的 URL 地址直接下载语音。

    public function getParams()
    {
        $params = array();
        $params['MsgType'] = 'TIMSoundElem';
        if ($this->isNotNull($this->Url)) {
            $params['MsgContent']['Url'] = $this->Url;
        }
        if ($this->isNotNull($this->UUID)) {
            $params['MsgContent']['UUID'] = $this->UUID;
        }
        if ($this->isNotNull($this->Size)) {
            $params['MsgContent']['Size'] = $this->Size;
        }
        if ($this->isNotNull($this->Second)) {
            $params['MsgContent']['Second'] = $this->Second;
        }
        if ($this->isNotNull($this->Download_Flag)) {
            $params['MsgContent']['Download_Flag'] = $this->Download_Flag;
        }
        return $params;
    }
}
