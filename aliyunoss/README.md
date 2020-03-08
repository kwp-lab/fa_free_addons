# 阿里云对象存储OSS插件

## 功能介绍
> 让Fastadmin支持上传图片至阿里云OSS。

## 说明
根据Fastadmin预设的行为标签位进行钩子触发，详情见：
[行为事件](https://doc.fastadmin.net/developer/87.html)

> 标签位位置1： index/ajax/upload<br>
> 标签位位置2： api/common/upload<br>
> 标签位位置3： admin/ajax/upload

本插件在后台配置完OSS参数后，使用Fastadmin现有的上传插件，会自动触发上述标签位的事件，从而达到上传图片至OSS的目的