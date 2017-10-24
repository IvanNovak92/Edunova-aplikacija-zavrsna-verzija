drop database if exists skladiste;
create database skladiste default character set utf8;
use skladiste;

create table komora(
sifra int not null primary key auto_increment,
naziv varchar(30) not null,
polje varchar(50),
kapacitet_boxeva int,
komad_box int

);

create table stavke(
sifra int not null primary key auto_increment,
naziv varchar (50) not null,
komora int not null,
roba int not null,
kolicina decimal(18,2) not null,
dovoz int not null
);

create table roba(
sifra int not null primary key auto_increment,
vrsta_robe varchar(50) not null,
naziv varchar (50),
jedinica_mjere char(10)


);

create table dovoz(
sifra int not null primary key auto_increment,
datum_berbe datetime not null,
datum_dovoza datetime not null,
kooperant int not null,
klasa_robe varchar(50)
);

create table kooperant(
sifra int not null primary key auto_increment,
ime varchar(50) not null,
ziro_racun char(11) not null

);


create table operater(
sifra 		int not null primary key auto_increment,
ime 		varchar(50) not null,
prezime 	varchar(50) not null,
email 		varchar(50) not null,
lozinka		char(32) not null,
uloga		varchar(50) not null,
rezultata_po_stranici int not null default 5

);


alter table dovoz add foreign key (kooperant) references kooperant(sifra);

alter table stavke add foreign key (komora) references komora(sifra);
alter table stavke add foreign key (roba) references roba(sifra);
alter table stavke add foreign key (dovoz) references dovoz(sifra);


#1
insert into operater(ime,prezime,email,lozinka,uloga,rezultata_po_stranici)
values	('Ivan','Novak','ivannovak92@yahoo.com',md5('p'),'admin',5),
		('Korisnik','','korisnik@korisnik.com',md5('p'),'korisnik',5);
		
#2
insert into kooperant(ime,ziro_racun)
values	('Belje','11111111111'),
		('Tomislav Tomić','22222222222');
#3		
insert into dovoz(datum_berbe,datum_dovoza,kooperant,klasa_robe)
values	('2017.07.03.','2017.07.03.',1,'1 klasa'),
		('2017.09.14.','2017.09.15.',2,'3 klasa');

		
#4
insert into roba(vrsta_robe,naziv,jedinica_mjere)
values	('Jabuka','Jonagold','Kg'),
		('Breskva','Pink','Kg');


		
#5
insert into komora(naziv,polje,kapacitet_boxeva,komad_box)
values	('Komora1','A10','100','1'),
		('Komora5','B1','300','2');

#6		
insert into stavke(naziv,komora,roba,kolicina,dovoz)
values	('Prva stavka',1,1,'500',1),
		('Prva stavka',2,2,'700',2);
		


		

		


