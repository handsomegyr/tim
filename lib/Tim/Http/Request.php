<?php

/**
 * 处理HTTP请求
 * 
 * 使用Guzzle http client库做为请求发起者，以便日后采用异步请求等方式加快代码执行速度
 *
 */

namespace Tim\Http;

class Request
{
    protected $_sdkappid = null;
    protected $_identifier = null;
    protected $_usersig = null;
    protected $_random = null;
    protected $_contenttype = null;

    public function __construct($sdkappid = '', $identifier = '', $usersig = '', $random = 0, $contenttype = 'json')
    {
        $this->setSdkappid($sdkappid);
        $this->setIdentifier($identifier);
        $this->setUsersig($usersig);
        $this->setRandom($random);
        $this->setContenttype($contenttype);
    }

    /**
     * 设定sdkappid
     *
     * @param string $sdkappid        
     */
    public function setSdkappid($sdkappid)
    {
        $this->_sdkappid = $sdkappid;
        return $this;
    }

    /**
     * 设定identifier
     *
     * @param string $identifier            
     */
    public function setIdentifier($identifier)
    {
        $this->_identifier = $identifier;
        return $this;
    }

    /**
     * 设定usersig
     *
     * @param string $usersig            
     */
    public function setUsersig($usersig)
    {
        $this->_usersig = $usersig;
        return $this;
    }

    /**
     * 设定random
     *
     * @param string $random        
     */
    public function setRandom($random)
    {
        $this->_random = $random;
        return $this;
    }

    /**
     * 设定contenttype
     *
     * @param string $contenttype        
     */
    public function setContenttype($contenttype)
    {
        $this->_contenttype = $contenttype;
        return $this;
    }

    /**
     * 获取服务器信息
     *
     * @param string $url            
     * @param array $params            
     * @return mixed
     */
    public function get($url, $params = array(), $options = array())
    {
        $options['headers']['Content-Type'] = "application/json";
        $client = new \GuzzleHttp\Client($options);
        $query = $this->getQueryParam4AccessToken();
        $params = array_merge($params, $query);
        $response = $client->get($url, array(
            'query' => $params
        ));
        if ($this->isSuccessful($response)) {
            return $this->getJson($response); // $response->json();
        } else {
            throw new \Exception("服务器未有效的响应请求");
        }
    }

    /**
     * 推送消息给到服务器
     *
     * @param string $url            
     * @param array $params            
     * @return mixed
     */
    public function post($url, $params = array(), $queryParams = array(), $options = array(), $body = '')
    {
        $options['headers']['Content-Type'] = "application/json";
        $client = new \GuzzleHttp\Client($options);
        $query = $this->getQueryParam4AccessToken();
        if (!empty($queryParams)) {
            $query = array_merge($params, $queryParams);
        }
        $response = $client->post($url, array(
            'query' => $query,
            'body' => empty($body) ? \json_encode($params, JSON_UNESCAPED_UNICODE) : $body
        ));
        if ($this->isSuccessful($response)) {
            return $this->getJson($response); // $response->json();
        } else {
            throw new \Exception("服务器未有效的响应请求");
        }
    }

    /**
     * 上传文件
     *
     * @param string $uri            
     * @param string $media
     *            url或者filepath
     * @param array $options            
     * @param array $otherQuery            
     * @throws Exception
     * @return mixed
     */
    public function uploadFile($url, $media, array $options = array('fieldName' => 'media'), array $otherQuery = array())
    {
        $client = new \GuzzleHttp\Client();
        $query = $this->getQueryParam4AccessToken();
        if (!empty($otherQuery)) {
            $query = array_merge($query, $otherQuery);
        }
        if (filter_var($media, FILTER_VALIDATE_URL) !== false) {
            $fileInfo = $this->getFileByUrl($media);
            $media = $this->saveAsTemp($fileInfo['name'], $fileInfo['bytes']);
            $media = fopen($media, 'r');
        } elseif (is_readable($media)) {
            $media = fopen($media, 'r');
        } else {
            throw new \Exception("无效的上传文件");
        }

        $response = $client->post($url, array(
            'query' => $query,
            'multipart' => array(
                array(
                    'name' => $options['fieldName'],
                    'contents' => $media
                )
            )
        ));

        if ($this->isSuccessful($response)) {
            return $this->getJson($response); // $response->json();
        } else {
            throw new \Exception("服务器未有效的响应请求");
        }
    }

    /**
     * 上传多个文件
     *
     * @param string $uri            
     * @param array $fileParams            
     * @param array $extraParams             
     * @param array $description          
     * @throws Exception
     * @return mixed
     */
    public function uploadFiles($uri, array $fileParams, array $extraParams = array(), array $description = array())
    {
        $client = new \GuzzleHttp\Client();

        $files = array();
        foreach ($fileParams as $fileName => $media) {
            if (filter_var($media, FILTER_VALIDATE_URL) !== false) {
                $fileInfo = $this->getFileByUrl($media);
                $media = $this->saveAsTemp($fileInfo['name'], $fileInfo['bytes']);
                $media = fopen($media, 'r');
            } elseif (is_readable($media)) {
                $media = fopen($media, 'r');
            } else {
                throw new \Exception("无效的上传文件");
            }
            $files[$fileName] = $media;
        }
        $multipart = array();
        if (!empty($files)) {
            foreach ($files as $field => $value) {
                $multipart[] = array(
                    'name' => $field,
                    'contents' => $value
                );
            }
        }
        // 如果需要额外的提交参数的话
        if (!empty($extraParams)) {
            $body = json_encode($extraParams, JSON_UNESCAPED_UNICODE);
        }

        if (!empty($description)) {
            $multipart[] = array(
                'name' => 'description',
                'contents' => json_encode($description, JSON_UNESCAPED_UNICODE)
            );
        }

        $response = $client->post($uri, array(
            'query' => array(
                'access_token' => $this->_accessToken
            ),
            'multipart' => $multipart,
            'body' => $body
        ));

        if ($this->isSuccessful($response)) {
            return $this->getJson($response); // $response->json();
        } else {
            throw new \Exception("服务器未有效的响应请求");
        }
    }

    /**
     * Checks if HTTP Status code is Successful (2xx | 304)
     *
     * @return bool
     */
    public function isSuccessful($response)
    {
        $statusCode = $response->getStatusCode();
        return ($statusCode >= 200 && $statusCode < 300) || $statusCode == 304;
    }

    /**
     * 下载文件
     *
     * @param string $url            
     * @throws Exception
     * @return array
     */
    public function getFileByUrl($url = '', $file_ext = "")
    {
        $opts = array(
            'http' => array(
                'follow_location' => 3,
                'max_redirects' => 3,
                'timeout' => 10,
                'method' => "GET",
                'header' => "Connection: close\r\n",
                'user_agent' => 'R&D'
            )
        );
        $context = stream_context_create($opts);
        $fileBytes = file_get_contents($url, false, $context);

        if (empty($file_ext)) {
            $ext = pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION);
            if (empty($ext)) {
                $ext = "jpg";
            }
        } else {
            $ext = $file_ext;
        }
        $filename = uniqid() . ".{$ext}";
        return array(
            'name' => $filename,
            'bytes' => $fileBytes
        );
    }

    public function postByfileGetContents($url, $params)
    {
        $params = \json_encode($params, JSON_UNESCAPED_UNICODE);
        $opts = array(
            'http' => array(
                'follow_location' => 3,
                'max_redirects' => 3,
                'timeout' => 10,
                'method' => "POST",
                'header' => "Content-Type: application/json;charset=uft-8",
                'content' => $params
            ),
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            )
        );
        $context = stream_context_create($opts);
        return file_get_contents($url, false, $context);
    }
    /**
     * 将指定文件名和内容的数据，保存到临时文件中，在析构函数中删除临时文件
     *
     * @param string $fileName            
     * @param bytes $fileBytes            
     * @return string
     */
    protected function saveAsTemp($fileName, $fileBytes)
    {
        $this->_tmp = sys_get_temp_dir() . '/temp_files_' . $fileName;
        file_put_contents($this->_tmp, $fileBytes);
        return $this->_tmp;
    }

    protected function getJson($response)
    {
        $body = $response->getBody();
        $contents = $response->getBody()->getContents();
        try {
            if ($this->_json) {
                $json = json_decode($body, true);
                if (JSON_ERROR_NONE !== json_last_error()) {
                    throw new \InvalidArgumentException('Unable to parse JSON data: ');
                }
                return $json;
            } else {
                return $contents;
            }
        } catch (\Exception $e) {
            return $contents;
        }
    }

    protected function getQueryParam4AccessToken()
    {
        $params = array();
        if (!empty($this->_sdkappid)) {
            $params['sdkappid'] = $this->_sdkappid;
        }
        if (!empty($this->_identifier)) {
            $params['identifier'] = $this->_identifier;
        }
        if (!empty($this->_usersig)) {
            $params['usersig'] = $this->_usersig;
        }
        if (!empty($this->_random)) {
            $params['random'] = $this->_random;
        }
        if (!empty($this->_contenttype)) {
            $params['contenttype'] = $this->_contenttype;
        }
        return $params;
    }

    public function __destruct()
    {
        if (!empty($this->_tmp)) {
            unlink($this->_tmp);
        }
    }
}
