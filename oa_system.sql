
DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pgroup` varchar(30) DEFAULT NULL COMMENT '模块(分组)',
  `name` varchar(50) DEFAULT NULL COMMENT '权限名称',
  `pkey` varchar(50) DEFAULT NULL COMMENT '权限标识',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pkey` (`pkey`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='后台管理员角色';
delete from admin_permissions where id>0;
INSERT INTO `admin_permissions` VALUES (1,'system','管理员列表','/admin/manage/index',now(),now()),
(2,'system','管理员添加','/admin/manage/add',now(),now()),
(3,'system','管理员编辑','/admin/manage/edit',now(),now()),
(4,'system','管理员删除','/admin/manage/delete',now(),now()),
(9,'system','(禁用|启用)员工','/admin/manage/enable',now(),now()),
(11,'system','添加角色','/admin/role/add',now(),now()),
(12,'system','修改角色','/admin/role/edit',now(),now()),
(13,'system','删除角色','/admin/role/delete',now(),now()),
(15,'system','权限列表','/admin/permission/index',now(),now()),
(16,'system','编辑权限','/admin/permission/edit',now(),now()),
(17,'system','删除权限','/admin/permission/delete',now(),now()),
(18,'system','添加权限','/admin/permission/add',now(),now()),
(19,'system','菜单列表','/admin/menu/index',now(),now()),
(20,'system','添加菜单','/admin/menu/add',now(),now()),
(21,'system','修改菜单','/admin/menu/edit',now(),now()),
(22,'system','删除菜单','/admin/menu/delete',now(),now()),
(36,'leave','假期类型列表','/leave/leave/index',now(),now()),
(23,'leave','添加假期类型','/leave/leave/add',now(),now()),
(24,'leave','修改假期类型','/leave/leave/edit',now(),now()),
(25,'leave','删除假期类型','/leave/leave/delete',now(),now()),
(5,'leave','申请假期列表','/leave/apply/index',now(),now()),
(26,'leave','申请假期','/leave/apply/add',now(),now()),
(27,'leave','同意假期申请','/leave/audit/agree',now(),now()),
(49,'leave','驳回假期申请','/leave/audit/reject',now(),now()),
(37,'office','办公室列表','/office/office/index',now(),now()),
(28,'office','添加办公室','/office/office/add',now(),now()),
(29,'office','修改办公室','/office/office/edit',now(),now()),
(30,'office','删除办公室','/office/office/delete',now(),now()),
(6,'office','申请办公室列表','/office/apply/index',now(),now()),
(31,'office','申请办公室','/office/apply/add',now(),now()),
(32,'office','取消办公室申请','/office/apply/cancel',now(),now()),
(46,'office','驳回办公室申请','/office/audit/reject',now(),now()),
(33,'goods','物品列表','/goods/goods/index',now(),now()),
(34,'goods','物品添加','/goods/goods/add',now(),now()),
(35,'goods','物品编辑','/goods/goods/edit',now(),now()),
(47,'goods','物品删除','/goods/goods/delete',now(),now()),
(48,'goods','物品申请列表','/goods/apply/index',now(),now()),
(38,'goods','物品申请','/goods/apply/add',now(),now()),
(39,'goods','物品申请确认','/goods/audit/received',now(),now()),
(40,'goods','物品申请关闭','/goods/apply/cancel',now(),now()),
(41,'goods','物品申请驳回','/goods/audit/reject',now(),now()),
(42,'user','登录','/admin/login/sigin',now(),now()),
(43,'user','退出','/admin/login/logout',now(),now()),
(44,'user','修改密码','/admin/manage/modifyPass',now(),now()),
(45,'system','公告发布','/announcement:add',now(),now()),
(10,'user','查看个人信息','/admin/index/index',now(),now());


CREATE TABLE `admin_role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL COMMENT '角色名称',
  `permissions` text COMMENT '角色权限，使用json存储',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  `enable` tinyint(1) unsigned DEFAULT '1' COMMENT '是否可用',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_name` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='后台管理员角色';

INSERT INTO `admin_role` VALUES (1,'超级管理员','{\"\/admin\/index\/index\":1,\"\/admin\/login\/index\":1,\"\/admin\/login\/sigin\":1,\"\/admin\/login\/logout\":1,\"\/admin\/manage\/index\":1}',now(),now(),1),
(2,'行政管理员','{\"\/leave\/apply\/index\":\"1\",\"\/leave\/leave\/add\":1,\"\/leave\/apply\/agree\":1,\"\/leave\/apply\/reject\":1,\"\/office\/apply\/index\":1,\"\/office\/apply\/add\":1,
\"\/office\/apply\/cancel\":1,\"\/office\/apply\/reject\":1,\"\/goods\/apply\/index\":1,\"\/goods\/apply\/add\":1,\"\/goods\/apply\/received\":1,\"\/goods\/apply\/cancel\":1,
\"\/goods\/apply\/reject\":1,\"\/admin\/index\/index\":1,\"\/admin\/login\/index\":1,\"\/admin\/login\/sigin\":1,\"\/admin\/login\/logout\":1
,\"\/admin\/manage\/modifyPass\":1}',now(),now(),1),
(3,'普通员工','{\"\/leave\/apply\/index\":\"1\",\"\/leave\/leave\/add\":\"1\",\"\/office\/apply\/index\":1,\"\/office\/apply\/add\":1,
\"\/office\/apply\/cancel\":1,\"\/goods\/apply\/index\":1,\"\/goods\/apply\/add\":1,\"\/goods\/apply\/cancel\":1,\"\/admin\/index\/index\":1,\"\/admin\/login\/index\":1,\"\/admin\/login\/sigin\":1,\"\/admin\/login\/logout\":1
,\"\/admin\/manage\/modifyPass\":1}',now(),now(),1);

 CREATE TABLE `admin_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL COMMENT '用户名，使用员工编号',
  `name` varchar(32) NOT NULL DEFAULT '' COMMENT '员工姓名',
  `role_ids` varchar(255) DEFAULT NULL COMMENT '角色用户角色ID集合, list json',
  `password` varchar(32) NOT NULL DEFAULT '' COMMENT '密码',
  `salt` varchar(32) DEFAULT NULL COMMENT '密码盐',
  `telephone` varchar(20) NOT NULL DEFAULT '' COMMENT '联系电话',
  `department` varchar(20) NOT NULL DEFAULT '' COMMENT '部门',
  `position` varchar(20) NOT NULL DEFAULT '' COMMENT '职位',
  `leader_id` int(11) NOT NULL DEFAULT 0 COMMENT '上司员工ID',
  `leader_name` varchar(50) NOT NULL DEFAULT '' COMMENT '上司姓名',
  `is_admin` tinyint(1) unsigned DEFAULT '0' COMMENT '是否超级管理员，1：是，0：否',
  `enable` tinyint(1) unsigned DEFAULT '1' COMMENT '是否可用，1：可用，0：冻结',
  `last_login_time` datetime DEFAULT NULL COMMENT '最后登录时间',
  `last_login_ip` varchar(15) DEFAULT NULL COMMENT '最后登录IP',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '员工表';

INSERT INTO `admin_user` VALUES (1,'1001','李白','1','904cc7ce9506efa2dbe800b4fad97928','bvdert182sb135789','18560577144','人事部','经理',0,'',1,1,now(),'127.0.0.1',now(),now()),
(2,'1002','杜甫','1','904cc7ce9506efa2dbe800b4fad97928','bvdert182sb135789','16860577144','研发部','经理',0,'',0,1,now(),'127.0.0.1',now(),now()),
(3,'1003','小明','2','904cc7ce9506efa2dbe800b4fad97928','bvdert182sb135789','15234577144','人事部','行政人员',1,'李白',0,1,now(),'127.0.0.1',now(),now()),
(4,'1004','陈红豆','3','904cc7ce9506efa2dbe800b4fad97928','bvdert182sb135789','16873177144','研发部','php工程师',2,'杜甫',0,1,now(),'127.0.0.1',now(),now());

CREATE TABLE `leave_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '假期类型ID',
  `leave_type` varchar(20) NOT NULL DEFAULT '' COMMENT '假期类型',
  `remark` varchar(200) NOT NULL DEFAULT '' COMMENT '备注说明',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_leave_type` (`leave_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '假期类型表';

 CREATE TABLE `leave_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '假期申请ID',
  `leave_type_id` int(11) NOT NULL COMMENT '假期类型ID',
  `leave_type` varchar(20) NOT NULL DEFAULT '' COMMENT '假期类型',
  `staff_id` int(11) NOT NULL DEFAULT 0 COMMENT '员工ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '员工姓名',
  `time_begin` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '假期开始时间',
  `time_end` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '假期结束时间',
  `duration` decimal(3,1) NOT NULL DEFAULT 0 COMMENT '休假时长',
  `reason` varchar(100) NOT NULL DEFAULT '' COMMENT '理由',
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '申请状态, 0:申请中, 1:同意申请, 2:拒绝申请, 3:取消申请',
  `auditor_id` int(11) COMMENT '审核人员员工ID',
  `auditor` varchar(50) NOT NULL DEFAULT '' COMMENT '审核人员姓名',
  `comment` varchar(200) NOT NULL DEFAULT '' COMMENT '审核反馈',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '假期申请表';

 CREATE TABLE `office` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '办公室ID',
  `office` varchar(50) NOT NULL DEFAULT '' COMMENT '办公室',
  `remark` varchar(100) NOT NULL DEFAULT '' COMMENT '备注',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_office` (`office`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '办公室申请表';

 CREATE TABLE `office_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '办公室申请ID',
  `office_id` int(11) NOT NULL DEFAULT 0 COMMENT '办公室ID',
  `office` varchar(50) NOT NULL DEFAULT '' COMMENT '办公室',
  `staff_id` int(11) NOT NULL COMMENT '员工ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '员工姓名',
  `time_begin` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '开始使用时间',
  `time_end` datetime NOT NULL DEFAULT '1970-01-01 00:00:00' COMMENT '结束使用时间',
  `reason` varchar(100) NOT NULL DEFAULT '' COMMENT '理由',
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '申请状态, 0:已申请, 1:正在使用, 2:申请过期, 3:关闭申请, 4:拒绝申请',
  `auditor_id` int(11) NOT NULL DEFAULT 0 COMMENT '审核人员员工ID',
  `auditor` varchar(50) NOT NULL DEFAULT '' COMMENT '审核人员姓名',
  `comment` varchar(200) NOT NULL DEFAULT '' COMMENT '审核反馈',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '办公室申请表';

CREATE TABLE `goods` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '物品ID',
  `goods` varchar(50) NOT NULL DEFAULT '' COMMENT '物品',
  `remark` varchar(200) NOT NULL DEFAULT '' COMMENT '备注说明',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  PRIMARY KEY (`id`),
  UNIQUE KEY `uk_goods` (`goods`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '物品表';

 CREATE TABLE `goods_apply` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '物品申请ID',
  `goods_id` int(11) NOT NULL DEFAULT 0 COMMENT '物品ID',
  `goods` varchar(50) NOT NULL DEFAULT '' COMMENT '物品',
  `staff_id` int(11) NOT NULL DEFAULT 0 COMMENT '员工ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '员工姓名',
  `reason` varchar(100) NOT NULL DEFAULT '' COMMENT '理由',
  `status` tinyint(1) unsigned NOT NULL DEFAULT 0 COMMENT '申请状态, 0:申请中, 1:已领取, 2:拒绝, 3:取消',
  `auditor_id` int(11) NOT NULL DEFAULT 0 COMMENT '审核人员员工ID',
  `auditor` varchar(50) NOT NULL DEFAULT '' COMMENT '审核人员姓名',
  `comment` varchar(200) NOT NULL DEFAULT '' COMMENT '审核反馈',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '物品申请表';

 CREATE TABLE `announcement` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT '公告ID',
  `staff_id` int(11) NOT NULL DEFAULT 0 COMMENT '员工ID',
  `name` varchar(50) NOT NULL DEFAULT '' COMMENT '员工姓名',
  `content` text COMMENT '公告内容',
  `enable` tinyint(1)unsigned  NOT NULL DEFAULT 0 COMMENT '公告状态, 1:启用, 0：禁用',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT '公告表';

  CREATE TABLE `admin_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned NOT NULL DEFAULT 0 COMMENT '父级菜单ID',
  `name` varchar(50) DEFAULT NULL COMMENT '菜单名称',
  `url` varchar(100) DEFAULT NULL COMMENT '菜单url',
  `permission` varchar(50) DEFAULT NULL COMMENT '菜单权限',
  `addtime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '创建时间',
  `updatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '最新修改时间',
  `sort` tinyint(3) unsigned DEFAULT 0 COMMENT '排序数字,越大越靠后',
  `enable` tinyint(1) unsigned DEFAULT 0 COMMENT '是否可用,0:禁用,1:启用',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='后台管理菜单表';

INSERT INTO `admin_menu` VALUES (2,0,'个人信息','','',now(),now(),1,1),
(4,0,'系统管理员','','',now(),now(),2,1),
(6,0,'假期','','',now(),now(),1,1),
(7,0,'办公室','','',now(),now(),1,1),
(8,0,'物品领取','','',now(),now(),1,1),
(9,4,'管理员列表','/admin/manager/index','/admin/manager/index',now(),now(),1,1),
(10,4,'角色列表','/admin/role/index','/admin/role/index',now(),now(),2,1),
(11,4,'权限列表','/admin/permission/index','/admin/permission/index',now(),now(),3,1),
(13,4,'公告发布','/admin/announcement/index','/admin/announcement/index',now(),now(),5,1),
(14,2,'首页','/admin/index/index','/admin/index/index',now(),now(),1,1),
(15,6,'假期申请','/leave/apply/index','/leave/apply/index',now(),now(),2,1),
(16,7,'办公室申请','/office/apply/index','/office/apply/index',now(),now(),2,1),
(17,8,'物品领取申请','/goods/apply/index','/goods/apply/index',now(),now(),2,1),
(22,8,'物品列表','/goods/goods/index','/goods/goods/index',now(),now(),1,1),
(23,8,'物品领取审核','/goods/audit/index','/goods/audit/index',now(),now(),3,1),
(18,6,'假期类型列表','/leave/leave/index','/leave/leave/index',now(),now(),1,1),
(19,7,'办公室列表','/office/office/index','/office/office/index',now(),now(),1,1),
(20,6,'假期审核','/leave/audit/index','/leave/audit/index',now(),now(),3,1),
(21,7,'办公室审核','/office/audit/index','/office/audit/index',now(),now(),3,1);
