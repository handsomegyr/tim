<?php

namespace Tim\Model\Msg\Type\Ext;

/**
 * 原图、缩略图或者大图下载信息
 */
class Image extends \Tim\Model\Base
{
    public $Type = NULL; //Number 图片类型： 1-原图，2-大图，3-缩略图。
    public $Size = NULL; //Number 图片数据大小，单位：字节。
    public $Width = NULL; //Number 图片宽度，单位为像素。
    public $Height = NULL; //Number 图片高度，单位为像素。
    public $URL = NULL; //String 图片下载地址。

    public function getParams()
    {
        $params = array();
        if ($this->isNotNull($this->Type)) {
            $params['Type'] = $this->Type;
        }
        if ($this->isNotNull($this->Size)) {
            $params['Size'] = $this->Size;
        }
        if ($this->isNotNull($this->Width)) {
            $params['Width'] = $this->Width;
        }
        if ($this->isNotNull($this->Height)) {
            $params['Height'] = $this->Height;
        }
        if ($this->isNotNull($this->URL)) {
            $params['URL'] = $this->URL;
        }

        return $params;
    }
}
