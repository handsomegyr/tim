<?php

namespace Tim\Manager;

use Tim\Client;

/**
 * 单聊消息
 */
class Msg
{
  // 接口地址
  private $_url = 'https://console.tim.qq.com/';
  private $_client;
  private $_request;
  private $_params; //url常规参数
  public function __construct(Client $client)
  {
    $this->_client = $client;
    $this->_request = $client->getRequest();
  }

  /**
   * 单发单聊消息
   * 腾讯文档：https://cloud.tencent.com/document/product/269/2282
   * 示例：https://console.tim.qq.com/v4/openim/sendmsg?sdkappid=88888888&identifier=admin&usersig=xxx&random=99999999&contenttype=json
   * 
   * @param Array $msgs 必填 | 聊天消息配置
   */
  public function sendmsg(\Tim\Model\Msg\Msg $Msg)
  {
		$data = $Msg->getParams();
    $rst = $this->_request->post($this->_url . 'v4/openim/sendmsg', $this->_params, [], [], json_encode($data, 320));
    return $this->_client->rst($rst);
  }
}
