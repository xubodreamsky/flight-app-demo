set names utf8;
drop table if exists `user`;
create table `user` (
`id` int unsigned not null auto_increment primary key comment 'ID',
`email` varchar(64) not null default '' unique key comment '邮箱',
`password` char(32) not null default '' comment '密码',
`name` varchar(128) not null default '' comment '姓名'
) engine=myisam default charset=utf8;

-- 测试数据
insert into `user` values(null, 'zs@163.com', md5('123456'), '张三');
insert into `user` values(null, 'ls@163.com', md5('123456'), '李四');

