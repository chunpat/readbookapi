# 书趣app后端 

## 关联app 源码

https://ext.dcloud.net.cn/plugin?id=4424

https://gitee.com/jameson512/novelappofuniapp



## 首先安装app 插件

[在uniapp市场安装](https://ext.dcloud.net.cn/plugin?id=4424)



## 安装使用方法 

1. 创建站点，并将网站根目录指向 public目录

2. 在伪静态配置文件中添加 

``` 
location / {
	if (!-e $request_filename){
		rewrite  ^(.*)$  /index.php?s=$1  last;   break;
	}
}

```

3. 创建数据库，并导入 sql/bappdemmo.sql

4. 修改 .env 文件，填写上一步创建的数据库信息

5. 修改 public/wonyesadmin/config/pear.config.json 最底部的 api:baseurl,为你的域名

6. 在hbuildx中发行h5版，并将编译后的h5文件夹上传到 public/h5 下

7. 后端访问地址  你的域名/wonyesadmin  默认管理员admin，密码 123456

![](https://img-cdn-aliyun.dcloud.net.cn/stream/plugin_screens/8486d930-8583-11eb-9d18-53054d3876a9_4.png?image_process=quality,q_70/format,webp&v=1645716102)