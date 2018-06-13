herosphp-app
====
基于herosphp开发框架的 demo 应用

使用方法
=====
```bash
git clone https://git.oschina.net/blackfox/herosphp-app.git
cd herosphp-app
composer install
```

演示地址：
=======
### [http://herosphp.r9it.com](http://herosphp.r9it.com)

源码地址
====
码云: [http://git.oschina.net/blackfox/herosphp-app](http://git.oschina.net/blackfox/herosphp-app)

GitHub: [https://github.com/yangjian102621/herosphp-app](https://github.com/yangjian102621/herosphp-app)

herosphp/framework(框架源码地址)：
====
码云: [http://git.oschina.net/blackfox/herosphp](http://git.oschina.net/blackfox/herosphp)

GitHub: [https://github.com/yangjian102621/herosphp](https://github.com/yangjian102621/herosphp)

开发手册
========
http://docs.r9it.com/herosphp/v3.0/

版本更新记录
======

## version 3.0.3
1. 修复 MysqlModel::where 方法中闭包判断的bug， 之前使用的是 is_callable($field), 导致在 $field 是 url 这种函数名的时候会被当做闭包判断。
2. 给 RedisSession 的缓存加上前缀，需要在 app/configs/session.config.php 的 redis session configure 中加上 prefix key，
指定redis session 存储前缀
3. 修改 Filter 类，将一些常用的过滤 API 暴露出去可以作为工具单独使用。
4. 修复 MysqlModel::whereOr 闭包查询bug
5. 新增新的模板标签 {res $url} 输出格式化的静态资源地址。如果设置了cdn地址常量 RES_SERVER_URL 则会自动把相对的 URL 转化为绝对的 URL.
6. 更改缓存工厂(CacheFactory)的实现，采用类似动态工厂的方式，如果再新增缓存实现的时候，不需要再更改工厂类的代码。
7. 修复创建多个项目时造成的监听器加载异常的bug

## version 3.0.2
1. 重构了 MysqlModel， 新增了 getSqlBuilder() 和 setSqlBuilder() 方法
2. 修改 JsonResult 的数据结构
3. 增加Session存Redis带前缀prefix功能

## version 3.0.1
1. 修复了 MysqlQueryBuilder::addWhere 方法的bug, 当第三个参数不传入时查询报错。
2. 修复 JsonResult::output 输出日志乱码的bug。
3. 更新了 StringUtils类的生成分布式唯一ID的算法，把32位改成生成18位的16进制数
4. 重要： 给监听器（Listener）新增了skinUrl()接口，用来过滤不需要监听的请求 URI


## version 3.0.0
1. 优化组织结构目录，将框架代码和应用代码完全隔离，更好的支持多应用开发，更好的保护框架的安全性
2. 支持配置多份配置文档，可以同时配置开发环境(dev), 测试环境(test), 生产环境(prod), 大大减少项目上线工作量，可以很方便的使用git的hooks实现自动部署。
3. 优化数据模型接口，统一使用数组作为查询条件，兼容mongoDB和elasticSearch查询语法；新增了MongoModel(mongoDB数据模型)
4. 新增日志类（Log），捕获异常的时候如果是非调试模式会自动记录日志
5. 集成RSA加密工具类实现，新增了签名类，方便调用远程API
6. 实现了同步锁功能，提供 FileSynLock(文件锁) 和 SemSynLock(信号量锁) 2种实现
7. 新增了一些工具类 （ModelTransformUtils等）
8. 修复了一些已知的bug


## version 2.0.0 (重构)
1. 新增了WebApplication 层来控制整个web请求的生命周期，控制器中的每个功能方法都需要传入HttpRequest对象
2. 更新了模板引擎，新增了局部和全局css引入的标签
3. 更改了php文件的加载，所有的php文件都使用Loader加载器来加载，除了核心框架类使用自动加载，其他的类全部是Loader来按需加载，以减少全部类的自动加载的开销。
4. 在根目录下新增了client.php 和 client 目录， 方便执行php的客户端程序。 使用方法详情见操作手册
5. 新增Beans对象管理工具，可以很方便的配置和管理服务。
6. 修改了ImageThumb 类，新增了图片裁剪方法。
7. 重构了缓存模块，新增了缓存的分类，避免了当缓存文件太多的对文件系统inode节点限制，也可以大大提高文件缓存的读写效率。
8. 修改了数据操作模块，新增了对数据库集群的支持，只需要在herosp.const.php中配置将 DB_ACCESS的值改成B_ACCESS_CLUSTERS
9. 在utils中新增了邮件发送服务类 Smtp.class.php
10. 重写了session， 新增了memcache介质存储

## version 1.0.0
实现了框架的基本功能
1. 项目组织结构
2. URL解析
3. 数据DB层的操作
4. MVC设计模式, 自己实现的模板引擎
5. 基本工具类，如果文件上传，图片裁剪，生成缩略图，文件处理等

联系作者
=====
邮箱：<a href="mailto:yangjian102621@gmail.com">yangjian102621@gmail.com</a>

QQ：906388445

技术交流QQ群：137352247

博客 : <a href="http://www.r9it.com/">小一辈无产阶级码农</a>

<br />

