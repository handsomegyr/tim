<?php

namespace Tim\Model\Account;

/**
 * 单聊消息
 */
class DeleteItem extends \Tim\Model\Base
{
    public $UserID = NULL; // String 请求删除的帐号的 UserID

    public function getParams()
    {
        $params = array();

        if ($this->isNotNull($this->SyncOtherMachine)) {
            $params['SyncOtherMachine'] = $this->SyncOtherMachine;
        }
        return $params;
    } 
}
