<?php

/**
 * 服务端 API
 * 腾讯是国内最早也是最大的即时通信开发商，QQ 和微信已经成为每个互联网用户必不可少的应用。顺应行业数字化转型的趋势，腾讯云将高并发、高可靠的即时通信能力以 SDK 和 REST API的形式进行开放，推出即时通信 IM 产品。您可以通过简易的方式将腾讯云提供的 IM SDK 集成进自有应用中，配合服务端 REST API 调用，即可轻松拥有微信和 QQ 一样强大的即时通信能力
 * https://cloud.tencent.com/document/product/269/32688
 */

namespace Tim;

use Tim\Manager\Account;
use Tim\Manager\Msg;

class Client
{
    private $_sdkappid = ""; //创建应用时即时通信 IM 控制台分配的 SDKAppID
    private $_identifier = ""; //必须为 App 管理员帐号
    private $_usersig = ""; //App 管理员帐号生成的签名
    private $_random = null; //随机的32位无符号整数，取值范围0 - 4294967295
    private $_contenttype = 'json'; //请求格式固定值为json
    public function __construct($sdkappid, $identifier, $usersig, $contenttype = 'json', $random = 0)
    {
        $this->_sdkappid = $sdkappid;
        $this->_identifier = $identifier;
        $this->_usersig = $usersig;
        $this->_contenttype = $contenttype;
        if (empty($random)) {
            $this->_random = random_int(0, 4294967295);
        }
    }

    /**
     * 获取应用的SDKAppID
     *
     * @throws Exception
     */
    public function getSdkappid()
    {
        if (empty($this->_sdkappid)) {
            throw new \Exception("请设定sdkappid");
        }
        return $this->_sdkappid;
    }

    /**
     * 设定应用的SDKAppID
     *
     * @param string $sdkappid        	
     */
    public function setSdkappid($sdkappid)
    {
        $this->_sdkappid = $sdkappid;
        return $this;
    }

    /**
     * 获取App管理员帐号
     *
     * @throws Exception
     */
    public function getIdentifier()
    {
        if (empty($this->_identifier)) {
            throw new \Exception("请设定identifier");
        }
        return $this->_identifier;
    }

    /**
     * 设定App管理员帐号
     *
     * @param string $identifier        	
     */
    public function setIdentifier($identifier)
    {
        $this->_identifier = $identifier;
        return $this;
    }

    /**
     * 获取App管理员帐号生成的签名
     *
     * @throws Exception
     */
    public function getUsersig()
    {
        if (empty($this->_usersig)) {
            throw new \Exception("请设定usersig");
        }
        return $this->_usersig;
    }

    /**
     * 设定App管理员帐号生成的签名
     *
     * @param string $usersig        	
     */
    public function setUsersig($usersig)
    {
        $this->_usersig = $usersig;
        return $this;
    }

    /**
     * 请求格式固定值为json
     *
     * @throws Exception
     */
    public function getContenttype()
    {
        if (empty($this->_contenttype)) {
            throw new \Exception("请设定contenttype");
        }
        return $this->_contenttype;
    }

    /**
     * 请求格式固定值为json
     *
     * @param string $contenttype        	
     */
    public function setContenttype($contenttype)
    {
        $this->_contenttype = $contenttype;
        return $this;
    }

    /**
     * 获取随机的32位无符号整数，取值范围0 - 4294967295
     *
     * @throws Exception
     */
    public function getRandom()
    {
        if (!isset($this->_random)) {
            $this->_random = random_int(0, 4294967295);
        }
        return $this->_random;
    }

    /**
     * 设定随机的32位无符号整数，取值范围0 - 4294967295
     *
     * @param string $random        	
     */
    public function setRandom($random)
    {
        $this->_random = $random;
        return $this;
    }

    /**
     * 初始化认证的http请求对象
     */
    private function initRequest()
    {
        $this->_request = new \Tim\Http\Request($this->_sdkappid, $this->_identifier, $this->_usersig, $this->_random, $this->_contenttype);
    }

    /**
     * 获取请求对象
     *
     * @return \Bytedance\Http\Request
     */
    public function getRequest()
    {
        if (empty($this->_request)) {
            $this->initRequest();
        }
        return $this->_request;
    }

    /**
     * 标准化处理服务端API的返回结果
     */
    public function rst($rst)
    {
        return $rst;
    }

    /**
     * 账号管理
     *
     * @return \Tim\Manager\Account
     */
    public function getAccountManager()
    {
        return new Account($this);
    }

    /**
     * 单聊消息
     *
     * @return \Tim\Manager\Msg
     */
    public function getMsgManager()
    {
        return new Msg($this);
    }
}
