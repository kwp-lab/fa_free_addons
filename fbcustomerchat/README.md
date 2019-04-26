# Facebook Messenger顾客聊天插件

![Preview of Addon Thumb](https://github.com/KelvinPoon/fa_free_addons/blob/master/fbcustomerchat/imgs/%E6%88%AA%E5%9B%BE6.png)

### 功能介绍
>该顾客聊天插件会自动加载客户与公司最近的聊天记录，无论是在 messenger.com 上，还是在 Messenger 应用中，又或是在您网站的顾客聊天插件中，只要是该客户最近与您公司之间的互动，都会显示出来。这有助于为客户打造不间断沟通的体验，同时确保即使在客户离开您的网页之后，您也能继续与他们之间的对话。集成这一插件后，您无需再为了跟进而四处捕捉客户的信息，只需在 Messenger 中打开与对方的对话即可。
  
### 功能特性
1. 支持多国语言，插件预设了简体中文，繁体中文和英文。如需扩展其他语言，请自行修改config.php;
2. 此插件基于Facebook官方Customer Chat SDK进行封装开发，支持可视化配置大部分参数；（参数说明见下文）
  

### 使用方式
启用：在目标html模板文件中，以钩子的方式即可。
```
{:hook('fbchat_init')}
```
  
停用：在后台将插件状态切换至“关闭”即可。

### 注意事项
1. 该插件在国内可能无法正常加载，需要“科学上网”。
2. 请先注册Facebook帐号，并开通主页（page）。
3. 在Messenger的设置页面中，将您网站的域名添加至白名单。
Facebook服务器会验证请求源的域名，如果不在白名单中，则无法显示messenger对话组件。同时，你的域名必须是HTTPS的。
![白名单设置](https://cdn.fastadmin.net/uploads/20190423/73423f5db8791bc2328bae3569c26b24.png)


> 在开发调试阶段，可使用代理隧道软件，推荐Ngrok。一款可以让你在本地开发调试此插件的免费工具。
4. 如果你使用Firefox浏览器，并且安装了Facebook Container附加组件，该组件会阻止系统显示此插件。如要显示该插件，请移除此附加程序。
5. Firefox 桌面浏览器（版本 63 及以上）和 Firefox 移动浏览器会默认拦截内容追踪，由此阻止系统显示此插件。只需关闭内容拦截（在搜索栏中点击灰色盾牌图标），此插件便会出现。（此为官方说法，笔者的浏览器默认情况下没遇到此情况）
