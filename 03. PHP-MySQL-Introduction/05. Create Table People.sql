CREATE TABLE people (
 id INT AUTO_INCREMENT,
 name varchar (200) not null,
 picture mediumblob,
 height float(6, 2),
 weight float (6,2),
 gender enum ('m','f' ) not null,
 birthdate date not null,
 biography text,
 constraint pk_people2 PRIMARY key (id)
);

insert into people (name, picture, height, weight, gender, birthdate, biography)
values ('Ivan ', null, 175.35, 70.50, 'm', '1980-12-05', '' ),
         ('Petyr ', null, 175.35, 70.50, 'm', '1980-12-05', '' ),
         ('Pavel ', null, 175.35, 70.50, 'm', '1980-12-05', '' ),
         ('Mariya ', null, 175.35, 70.50, 'f', '1980-12-05', '' ),
         ('Stoyan ', null, 175.35, 70.50, 'm', '1980-12-05', '' );    
         
     