CREATE TABLE quicksearchindex (
  id_srch INTEGER PRIMARY KEY AUTOINCREMENT,
  idobj_srch varchar(255) NOT NULL,
  title_srch varchar(255) NULL default '',
  kind_srch varchar(30) NULL default '',
  keywords_srch varchar(255) NULL default NULL,
  summary_srch text,
  content_srch text,
  url_srch varchar(255) NOT NULL default ''
);
