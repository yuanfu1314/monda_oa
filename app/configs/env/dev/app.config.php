<?php
/*---------------------------------------------------------------------
 * 当前访问application配置信息.
 * 注意：此处的配置将会覆盖同名键值的系统配置
 * ---------------------------------------------------------------------
 * Copyright (c) 2013-now http://blog518.com All rights reserved.
 * ---------------------------------------------------------------------
 * Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
 * ---------------------------------------------------------------------
 * Author: <yangjian102621@gmail.com>
 *-----------------------------------------------------------------------*/
defined('RES_SERVER_URL') || define('RES_SERVER_URL', 'http://www.r9it.com/');
$config = array(

    'template' => 'default',    //默认模板
    /**
     * 模板编译缓存配置
     * 0 : 不启用缓存，每次请求都重新编译(建议开发阶段启用)
     * 1 : 开启部分缓存， 如果模板文件有修改的话则放弃缓存，重新编译(建议测试阶段启用)
     * -1 : 不管模板有没有修改都不重新编译，节省模板修改时间判断，性能较高(建议正式部署阶段开启)
     */
    'temp_cache' => 0,

    /**
     * 用户自定义模板标签编译规则
     * array( 'search_pattern' => 'replace_pattern'  );
     */
    'temp_rules' => array(
        //权限
        '/{permission\s+\$(.*?)\s+\$([0-9a-z_]{1,})\s*}/i' => '<?php if ($isAdmin || in_array(strtolower(\$${1}),\$${2}) ) {?>',
        '/{\/permission}/i' => '<?php } ?>',
    ),

    'host' => $_SERVER['HTTP_HOST'],     //网站主机名
    //默认访问的页面
    'default_url' => array(
        'module' => 'admin',
        'action' => 'login',
        'method' => 'index'),

    'template' => 'default',    //默认模板
    'temp_cache' => 0,      //模板引擎缓存

    //短链接映射
    'url_mapping_rules' => array(
        '^\/newsdetail-(\d+)\/?$' => '/news/article/detail/?id=${1}',
        '^\/admin\/?$' => '/admin/index/login',
        '^\/app\/index.php$' => '/admin/login/index',
    ),

    //以上都框架内置的配置变量，请不要删除，下面是用户自定义的变量可以添加或者删除
    'site_name' => '简易自动化办公系统',
    'site_desc' => '简易自动化办公系统',
    'site_author' => 'yangjian102621@gmail.com',
    'site_copyright' => '2016 &copy; HerosPHP by BlackFox',

    'rsa_private_key' => __DIR__ . '/keys/rsa_private_key.pem',
    'rsa_public_key' => __DIR__ . '/keys/rsa_public_key.pem',

    // 后台权限分组
    'permission_group' => array(
        'system' => '系统管理',
        'user' => '个人信息',
        'leave' => '假期',
        'office' => '办公室',
        'goods' => '物品'
    ),

    // 七牛文件空间配置
    'qiniu_upload_configs' => [
        "ACCESS_KEY" => "_-BMslq1mPL_zY0KN2iLD1-ym4TcHhQUi0_dDFPB",
        "SECRET_KEY" => "J_As9ApfpyCpk31l3hOAZe3QQTc8iYlEfdd6-5an",
        "BUCKET" => "herosphp",
        "BUCKET_DOMAIN" => "http://oxy1ihdnt.bkt.clouddn.com/",
    ],

);

return $config;