/* Creating database */
create databse blog;


/* Creating table*/
create table(

	id int auto_increment,

	title varchar(256) default null,

	content varchar(10000) default null,

	image varchar(256) default null,

	pirmary key(id)

);