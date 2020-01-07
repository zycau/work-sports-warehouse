-- 需要在数据库里执行这些语句，而不是直接导入！！！

CREATE TABLE sportswarehouse_zyc.`user`(	
	`username`     varchar(50)  NOT NULL,
	password     varchar(255) NOT NULL,
	PRIMARY KEY (`username`)
);