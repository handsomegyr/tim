<?php

namespace Tim\Model\Msg\Type;

/**
 * 视频消息元素
 * 通过服务端集成的 Rest API 接口发送视频消息时，必须填入 VideoUrl、VideoUUID、ThumbUrl、ThumbUUID、ThumbWidth、ThumbHeight、VideoDownloadFlag 和 ThumbDownloadFlag字段。
 * 需保证通过 VideoUrl 能下载到对应视频，通过 ThumbUrl 能下载到对应的视频缩略图。VideoUUID 和 ThumbUUID 字段需填写全局唯一的 String 值，一般填入对应视频和视频缩略图的 MD5 值。
 * 消息接收者可以通过调用 V2TIMVideoElem.getVideoUUID() 和 V2TIMVideoElem.getSnapshotUUID() 分别拿到设置的 UUID 字段，业务 App 可以用这个字段做视频的区分。
 * VideoDownloadFlag 和 ThumbDownloadFlag 字段必须填2。
 */
class TIMVideoFileElem extends \Tim\Model\Base
{
    public $VideoUrl = NULL; //String 视频下载地址。可通过该 URL 地址直接下载相应视频。
    public $VideoUUID = NULL; //String 视频的唯一标识，客户端用于索引视频的键值。
    public $VideoSize = NULL; //Number 视频数据大小，单位：字节。
    public $VideoSecond = NULL; //Number 视频时长，单位：秒。Web 端不支持获取视频时长，值为0。
    public $VideoFormat = NULL; //String 视频格式，例如 mp4。
    public $VideoDownloadFlag = NULL; //Number 视频下载方式标记。目前 VideoDownloadFlag 取值只能为2，表示可通过VideoUrl字段值的 URL 地址直接下载视频。
    public $ThumbUrl = NULL; //String 视频缩略图下载地址。可通过该 URL 地址直接下载相应视频缩略图。
    public $ThumbUUID = NULL; //String 视频缩略图的唯一标识，客户端用于索引视频缩略图的键值。
    public $ThumbSize = NULL; //Number 缩略图大小，单位：字节。
    public $ThumbWidth = NULL; //Number 缩略图宽度，单位为像素。
    public $ThumbHeight = NULL; //Number 缩略图高度，单位为像素。
    public $ThumbFormat = NULL; //String 缩略图格式，例如 JPG、BMP 等。
    public $ThumbDownloadFlag = NULL; //Number 视频缩略图下载方式标记。目前 ThumbDownloadFlag 取值只能为2，表示可通过ThumbUrl字段值的 URL 地址直接下载视频缩略图。

    public function getParams()
    {
        $params = array();
        $params['MsgType'] = 'TIMVideoFileElem';
        if ($this->isNotNull($this->VideoUrl)) {
            $params['MsgContent']['VideoUrl'] = $this->VideoUrl;
        }
        if ($this->isNotNull($this->VideoUUID)) {
            $params['MsgContent']['VideoUUID'] = $this->VideoUUID;
        }
        if ($this->isNotNull($this->VideoSize)) {
            $params['MsgContent']['VideoSize'] = $this->VideoSize;
        }
        if ($this->isNotNull($this->VideoSecond)) {
            $params['MsgContent']['VideoSecond'] = $this->VideoSecond;
        }
        if ($this->isNotNull($this->VideoFormat)) {
            $params['MsgContent']['VideoFormat'] = $this->VideoFormat;
        }
        if ($this->isNotNull($this->VideoDownloadFlag)) {
            $params['MsgContent']['VideoDownloadFlag'] = $this->VideoDownloadFlag;
        }
        if ($this->isNotNull($this->ThumbUrl)) {
            $params['MsgContent']['ThumbUrl'] = $this->ThumbUrl;
        }
        if ($this->isNotNull($this->ThumbUUID)) {
            $params['MsgContent']['ThumbUUID'] = $this->ThumbUUID;
        }
        if ($this->isNotNull($this->ThumbSize)) {
            $params['MsgContent']['ThumbSize'] = $this->ThumbSize;
        }
        if ($this->isNotNull($this->ThumbWidth)) {
            $params['MsgContent']['ThumbWidth'] = $this->ThumbWidth;
        }
        if ($this->isNotNull($this->ThumbHeight)) {
            $params['MsgContent']['ThumbHeight'] = $this->ThumbHeight;
        }
        if ($this->isNotNull($this->ThumbFormat)) {
            $params['MsgContent']['ThumbFormat'] = $this->ThumbFormat;
        }
        if ($this->isNotNull($this->ThumbDownloadFlag)) {
            $params['MsgContent']['ThumbDownloadFlag'] = $this->ThumbDownloadFlag;
        }

        return $params;
    }
}
