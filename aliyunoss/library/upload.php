<?php
namespace addons\aliyunoss\library;

use OSS\OssClient;
use OSS\Core\OssException;

/**
 * Description of upload
 *
 * @author KelvinP
 */
class upload {

    protected $ossClient = null;
    protected $options = [];

    public function __construct($opts = []) {
        $this->options = empty($opts) ? get_addon_config("aliyunoss") : $opts;

        //判断是否有指定bucket，没有指定则选用默认bucket
        $this->options['bucket'] = isset($this->options['bucket']) ? $this->options['bucket'] : $this->options['defaultBucket'];
    }

    /**
     * 上传文件
     * @param type $object bucket上保存的文件名称（路径）
     * @param type $filepath 待上传的文件路径
     */
    public function uploadFile($object, $filepath) {
        $result = ['error'=>0, 'msg'=>''];
        
        try {
            if(!$this->ossClient){
                $endPoint = (1==$this->options['isInternal']) ? $this->options['endPoint'] : $this->options['externalEndPoint'];
                $this->ossClient = new OssClient($this->options['accessKeyId'], $this->options['accessKeySecret'], $endPoint);   
            }
        
            if($this->options['useSSL']){
                $this->ossClient->setUseSSL(true);
            }
            $this->ossClient->uploadFile($this->options['bucket'], $object, $filepath);
        } catch (OssException $e) {
            $result['error'] = 1;
            $result['msg'] = $e->getMessage();
        }
        
        return $result;
    }

}
