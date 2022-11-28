<?php

namespace Tim\Model\Msg\Type;

/**
 * 图像消息元素
 */
class TIMImageElem extends \Tim\Model\Base
{
    public $UUID = NULL; // String 图片的唯一标识，客户端用于索引图片的键值。
    public $ImageFormat = NULL; // Number 图片格式。JPG = 1，GIF = 2，PNG = 3，BMP = 4，其他 = 255。

    public $ImageInfoArray = NULL; // Array 原图、缩略图或者大图下载信息。

    public function getParams()
    {
        $params = array();
        $params['MsgType'] = 'TIMImageElem';
        if ($this->isNotNull($this->UUID)) {
            $params['MsgContent']['UUID'] = $this->UUID;
        }
        if ($this->isNotNull($this->ImageFormat)) {
            $params['MsgContent']['ImageFormat'] = $this->ImageFormat;
        }
        
        if ($this->isNotNull($this->ImageInfoArray)) {
            foreach ($this->ImageInfoArray as $value) {
                $params['ImageInfoArray'][] = $value->getParams();
            }
        }

        return $params;
    }
}
