#即时通信 IM SDK

[![MIT](https://img.shields.io/packagist/l/doctrine/orm.svg)](https://github.com/handsomegyr/tim/blob/master/LICENSE)
[![Build Status](https://travis-ci.org/handsomegyr/tim.svg?branch=master)](https://travis-ci.org/handsomegyr/tim)
[![Coverage](https://img.shields.io/codecov/c/github/handsomegyr/tim/master.svg)](https://codecov.io/gh/handsomegyr/tim)
[![Packagist](https://img.shields.io/packagist/v/handsomegyr/tim.svg)](https://packagist.org/packages/handsomegyr/tim)

## Requirement

1. PHP >= 5.5
2. **[Composer](https://getcomposer.org/)**

## functions

- [x] 小程序登录
- [x] 授权信息解密
- [x] 发送模板消息
- [x] 获取小程序二维码
- [x] 设置数据缓存
- [x] 删除数据缓存
- [x] 内容安全检查
- [x] 服务端数据签名

## Installation

```shell
$ composer require "handsomegyr/tim" -vvv
```

## Usage

基本使用（以服务端为例）:

```php
<?php

// 创建客户端对象
$client = new \Tim\Client();
$client->setAccessToken($access_token);
```

## Documentation



## License

MIT
