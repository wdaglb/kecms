<?php
/**
 * Name: config.php
 * User: King east
 * Site: http://cms.iydou.cn/
 */

return [
    // 是否开启域名根
    'url_domain_root'=>true,

    // 是否开启简洁路由
    'is_simple_url'=>false,

    // 是否自动分配模板目录
    'is_tpl_module'=>true,
    // 是否自动分配控制器目录
    'is_tpl_controller'=>true,

    'cache'=>[
        'type'=>'file',
    ],

    // 模板引擎
    'template'=>[
        // 默认支持twig
        'type'=>'twig',
        'compile'=>'./compile',
        // 模板后缀
        'suffix'=>'.html'
    ],

    // 数据库配置
    'database'=>[
        'host'=>'127.0.0.1',
        'name'=>'test',
        'user'=>'root',
        'pass'=>'root',
        'charset'=>'utf-8',
        'prefix'=>'ke_',
        'port'=>3306
    ],
];