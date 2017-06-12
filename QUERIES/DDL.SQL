create table book
(
	ID int not null,
	CODE varchar(20) not null,
	TITLE varchar(200) not null,
	DSCP varchar(2000) null,
	STOCK int not null,
	IS_DEL varchar(1) default 'N' not null,
	DT_CREATE timestamp default CURRENT_TIMESTAMP not null,
	CREATE_BY varchar(50) not null,
	DT_UPDATE timestamp null,
	UPDATE_BY varchar(50) null,
	PRICE float null,
	IMAGE varchar(200) null
)
;

create index CREATE_BY
	on book (CREATE_BY)
;

create unique index `Index 2`
	on book (CODE)
;

create index UPDATE_BY
	on book (UPDATE_BY)
;

create table transaction
(
	ID int not null auto_increment,
	USERNAME varchar(50) not null,
	BOOK_CODE varchar(50) not null,
	QUANTITY int not null,
	STATUS varchar(20) not null,
	DT_CREATE timestamp default CURRENT_TIMESTAMP not null,
	RANDOM_ID varchar(200) null
)
;

create index BOOK_CODE
	on transaction (BOOK_CODE)
;

create index USERNAME
	on transaction (USERNAME)
;

create table user
(
	ID int not null auto_increment,
	USERNAME varchar(50) not null,
	PASSWORD varchar(50) not null,
	EMAIL varchar(50) not null,
	USER_TYPE varchar(20) not null,
	DT_CREATE timestamp default CURRENT_TIMESTAMP not null,
	CREATE_BY varchar(50) not null,
	DT_UPDATE timestamp null,
	UPDATE_BY varchar(50) null,
	IS_DEL varchar(1) default 'N' not null
)
;

create unique index USER_EMAIL
	on user (EMAIL)
;

create unique index USER_USERNAME
	on user (USERNAME)
;

