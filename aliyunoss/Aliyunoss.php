<?php

namespace addons\aliyunoss;

use app\common\library\Menu;
use think\Addons;
use addons\aliyunoss\library\upload;
use think\Log;

/**
 * 插件
 */
class Aliyunoss extends Addons {

    /**
     * 插件安装方法
     * @return bool
     */
    public function install() {

        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall() {

        return true;
    }

    /**
     * 插件启用方法
     * @return bool
     */
    public function enable() {

        return true;
    }

    /**
     * 插件禁用方法
     * @return bool
     */
    public function disable() {

        return true;
    }

    /**
     * 钩子-本地上传完毕后触发
     * 标签位位置1： index/ajax/upload
     * 标签位位置2： api/common/upload
     * 标签位位置3： admin/ajax/upload
     * @param $attachment modelObject 附件本地上传完毕后的数据模型实例
     */
    public function uploadAfter($attachment){
        $addonCfg = $this->getConfig();
        $ossupload = new upload($addonCfg);
        
        $objectPath = ltrim($attachment->url, '/');
        $filePath = ROOT_PATH . '/public' . $attachment->url;
        $ossResult = $ossupload->uploadFile($objectPath, $filePath);
        if($ossResult['error']){
            Log::record($ossResult['msg'], 'error ');
        }else{
            $attachment->storage = 'aliyun_oss';
            $attachment->isUpdate(true)->save();
        }

        return true;
    }

}
