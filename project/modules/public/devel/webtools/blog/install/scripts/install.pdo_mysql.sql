CREATE TABLE blog_ticket (
    id_blog      int not null auto_increment,
    heading_blog varchar (50) NOT NULL,
    title_blog   varchar (50) NOT NULL,
    content_blog text NOT NULL,
    author_blog  varchar (50) NOT NULL,
    date_blog    varchar (14) NOT NULL,
    tags_blog    varchar (255) default '',
    primary key(id_blog)
);

CREATE TABLE blog_heading(
    heading_blog varchar(50),
    description_blog varchar (512),
    PRIMARY KEY (heading_blog)
);