create table feeds(
	feed_id int auto_increment not null,
	feed_title varchar(255) not null,
	feed_desc text not null,
	feed_content text not null,
    feed_pubdate varchar(40) not null,
	feed_link varchar(255) not null,
	feed_category varchar(255) not null,
	feed_author varchar(55) default null,
	PRIMARY KEY (feed_id)
) CHARACTER SET utf8;