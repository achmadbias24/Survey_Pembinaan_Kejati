/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     28/06/2021 23:01:43                          */
/*==============================================================*/



/*==============================================================*/
/* Table: DIVISI                                                */
/*==============================================================*/
create table divisi
(
   ID_DIVISI            int not null auto_increment comment '',
   NAMA_DIVISI          varchar(255)  comment '',
   primary key (ID_DIVISI)
);

/*==============================================================*/
/* Table: SURVEY                                                */
/*==============================================================*/
create table survey
(
   ID_SURVEY            int not null auto_increment comment '',
   ID_DIVISI            int not null  comment '',
   TANGGAL_SURVEY       date  comment '',
   TANGGAPAN            varchar(11)  comment '',
   KOMENTAR		         text,
   primary key (ID_SURVEY)
);

/*==============================================================*/
/* Table: ADMIN                                                */
/*==============================================================*/
create table admin
(
   USERNAME            varchar(16) not null comment '',
   NAMA_ADMIN          varchar(255) not null comment '',
   PASSWORD            varchar(16) not null comment '',
   primary key (USERNAME)
);

alter table survey add constraint FK_survey_RELATIONS_divisi foreign key (ID_DIVISI)
      references divisi (ID_DIVISI) on delete restrict on update restrict;

