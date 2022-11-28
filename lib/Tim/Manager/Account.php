<?php

namespace Tim\Manager;

use Tim\Client;

/**
 * 账号管理
 */
class Account
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
   * 导入单个帐号
   * 腾讯文档：https://cloud.tencent.com/document/product/269/1608
   * 示例：https://console.tim.qq.com/v4/im_open_login_svc/account_import?sdkappid=88888888&identifier=admin&usersig=xxx&random=99999999&contenttype=json
   *
   * @param String UserID    必填 | 用户名，长度不超过32字节
   * @param String Nick      选填 | 用户昵称
   * @param String FaceUrl   选填 | 用户头像 URL
   */
  public function accountImport($UserID = "", $Nick = "", $FaceUrl = "")
  {
    if (empty($UserID)) {
      throw new \Exception("请设定导入账户的用户名");
    }
    $data = [
      'UserID' => strval($UserID),
    ];
    if (!empty($Nick)) {
      $data['Nick'] = $Nick;
    }
    if (!empty($FaceUrl)) {
      $data['FaceUrl'] = $FaceUrl;
    }
    $rst = $this->_request->post($this->_url . 'v4/im_open_login_svc/account_import', $data);
    return $this->_client->rst($rst);
  }

  /**
   * 导入多个帐号
   * 腾讯文档：https://cloud.tencent.com/document/product/269/4919
   * 示例：https://console.tim.qq.com/v4/im_open_login_svc/multiaccount_import?sdkappid=88888888&identifier=admin&usersig=xxx&random=99999999&contenttype=json
   * 
   * @param Array $Accounts  账户信息
   *              {
   *                ["test1","test2","test3","test4","test5"]  必填 | 用户名，单个用户名长度不超过32字节，单次最多导入100个用户名
   *              }
   */
  public function multiaccountImport($accounts = [])
  {
    if (empty($accounts)) {
      throw new \Exception("请设定导入账户信息");
    }
    $data = [
      'Accounts' => $accounts,
    ];
    $rst = $this->_request->post($this->_url . 'v4/im_open_login_svc/multiaccount_import', $data);
    return $this->_client->rst($rst);
  }

  /**
   * 删除帐号
   * 腾讯文档：https://cloud.tencent.com/document/product/269/36443
   * 示例：https://console.tim.qq.com/v4/im_open_login_svc/account_delete?sdkappid=88888888&identifier=admin&usersig=xxx&random=99999999&contenttype=json
   * @param Array $Accounts  账户信息
   *              {
   *                "Accounts":["test1","test2","test3","test4","test5"]  必填 | 用户名，单个用户名长度不超过32字节，单次最多导入100个用户名
   *              }
   */
  public function accountDelete($accounts = [])
  {
    if (empty($accounts)) {
      throw new \Exception("请设定导入账户信息");
    }
    $data = [
      'DeleteItem' => [],
    ];
    foreach ($accounts as $v) {
      $data['DeleteItem'][] = ['UserID' => $v];
    }
    $rst = $this->_request->post($this->_url . 'v4/im_open_login_svc/account_delete', $data);
    return $this->_client->rst($rst);
  }

  /**
   * 查询帐号
   * 腾讯文档：https://cloud.tencent.com/document/product/269/38417
   * 示例：https://console.tim.qq.com/v4/im_open_login_svc/account_check?sdkappid=88888888&identifier=admin&usersig=xxx&random=99999999&contenttype=json
   * @param Array $Accounts  账户信息
   *              {
   *                "Accounts":["test1","test2","test3","test4","test5"]  必填 | 用户名，单个用户名长度不超过32字节，单次最多导入100个用户名
   *              }
   */
  public function accountCheck($accounts = [])
  {
    if (empty($accounts)) {
      throw new \Exception("请设定查询账户信息");
    }
    $data = [
      'CheckItem' => [],
    ];
    foreach ($accounts as $v) {
      $data['CheckItem'][] = ['UserID' => $v];
    }
    $rst = $this->_request->post($this->_url . 'v4/im_open_login_svc/account_check', $data);
    return $this->_client->rst($rst);
  }

  /**
   * 失效帐号登录状态
   * 腾讯文档：https://cloud.tencent.com/document/product/269/3853
   * 示例：https://console.tim.qq.com/v4/im_open_login_svc/kick?sdkappid=88888888&identifier=admin&usersig=xxx&random=99999999&contenttype=json
   * 
   * @param String UserID    必填 | 用户名
   */
  public function kick($UserID)
  {
    if (empty($UserID)) {
      throw new \Exception("请设定账户信息");
    }
    $data = [
      'UserID' => $UserID,
    ];
    $rst = $this->_request->post($this->_url . 'v4/im_open_login_svc/kick', $data);
    return $this->_client->rst($rst);
  }

   /**
   * 查询帐号在线状态
   * 腾讯文档：https://cloud.tencent.com/document/product/269/2566
   * 示例：https://console.tim.qq.com/v4/openim/query_online_status?sdkappid=88888888&identifier=admin&usersig=xxx&random=99999999&contenttype=json
   * 
   * @param Array $To_Account  账户信息
   *              {
   *                "Accounts":["test1","test2","test3","test4","test5"]  必填 | 用户名，单个用户名长度不超过32字节，单次最多导入100个用户名
   *              }
   * @param String UserID    必填 | 用户名
   */
  public function queryOnlineStatus($To_Account, $IsNeedDetail = 0)
  {
    if (empty($To_Account)) {
      throw new \Exception("请设定账户信息");
    }
    $data = [
      'UserID' => $UserID,
    ];
    $rst = $this->_request->post($this->_url . 'v4/openim/query_online_status', $data);
    return $this->_client->rst($rst);
  }
}
