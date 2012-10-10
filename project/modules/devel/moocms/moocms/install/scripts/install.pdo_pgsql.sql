create table moocms_pages (
    name_moocmspage varchar(255) not null,
    date_moocmspage varchar(14) not null,
    template_moocmspage varchar(80) not null,
    id_moocmsh int default null
);

create table moocms_heading (
   id_moocmsh serial,
   name_moocmsh varchar(255) not null,
   description_moocmsh varchar(1024) default null,
   PRIMARY KEY(id_moocmsh)
);

create table moocms_boxes (
  id_moocmsbox serial,
  params_moocmsbox varchar(1024) default null,
  order_moocmsbox int default 0,
  date_moocmsbox varchar(14) not null,
  name_moocmspage varchar(255) not null,
  PRIMARY KEY(id_moocmsbox)
);
