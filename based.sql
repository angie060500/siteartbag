drop database if exists store;
create database store CHARACTER SET utf8 COLLATE utf8_general_ci;;
use store;
create table user(
    idu int(4) auto_increment primary key,
    pseudo varchar(50) unique,
    pass varchar(50) ,
    mail varchar(50) unique ,
    code int(4) unique
)ENGINE=InnoDB;
create table article(
    idarticle int(4) auto_increment primary key,   
    nom varchar(50) unique,
    descr varchar(200),
    img varchar(255) unique ,
    qtestock int,
    prix int ,
    rating int ,
    sale int 
) ENGINE=InnoDB;
create table commande (
idcom int(4) auto_increment primary key,
ord int(4) ,
idart int(4),
idcc int(4),
qte  int(4) ,
total float
)ENGINE=InnoDB; 
create table fact (
idord int(4) auto_increment primary key,
idc int(4) ,
fulln varchar(50) , 
phone int(8),
addres varchar(50) , 
city varchar(50) , 
cardn varchar(16), 
dat varchar(50) , 
cvcode varchar(50) , 
qte int(4) ,
somme int(4) , 
statut varchar(25) 
)ENGINE=InnoDB; 

create table contact (
idm int(4) auto_increment primary key,
mail varchar(50)  ,
nom varchar(50) ,
txt varchar(50) ,
msg varchar(300) ,
dat varchar(50) ,
rating int , 
statut varchar(25)
)ENGINE=InnoDB; 
alter table commande add foreign key(idart) references article(idarticle) ;  
alter table commande add foreign key(idcc) references user(idu) ;  
alter table commande add foreign key(ord) references fact(idord) ; 
alter table contact add foreign key(mail) references user(mail) ;

insert into user Values(1,"admin",md5('admin'),"admin@admin.com",3259) ; 
insert into user Values(2,"client",md5('client'),"client@client.com",3278) ; 
INSERT INTO contact VALUES (1,'client@client.com','yosra',"message","hey promotion quand s'il vous plait ? ",'2020-05-02',5,'not done') ;
INSERT INTO article VALUES
(1, 'simply me', '"the simply me " bag : made out a beige colored  fabric with a black embroidery .', 'Images/products/prod2.jpg', 4, 22, 5, 15),
(2, 'pink floral bag', '" the pink floral bag" : simple beige  bag with cute pink delicate flower details .', 'Images/products/prod3.jpg', 4, 22, 5, 15),
(3, 'kaki bag', '"the kaki" bag : a simple basic bag in  a unique green color .', 'Images/products/prod5.jpg', 4, 22, 4, 7),
(4, 'sweet like roses', '"sweet like roses " bag : a simple basic bag in  a unique lavender color.', 'Images/products/prod6.jpg', 4, 22, 3, 9),
(5, 'green bag', '"the kaki" bag : a simple basic bag in  a unique green color .', 'Images/products/prod7.jpg', 4, 22, 2, 6),
(6, 'peach bag', '"the peach "bag : a simple basic bag in  a unique blush  color .', 'Images/products/prod8.jpg', 4, 22, 1, 4),
(7, 'mama love bag', '"the mama love" bag : made out a beige colored  fabric with a black embroidery .', 'Images/products/prod13.jpg', 4, 22, 4, 7),
(8, 'Abstract Tote bag', '\"the Abstract Tote\" bag : a simple basic bag in  a unique green color .', 'Images/products/printed/flower.jpg', 4, 25, 5, 0),
(9, 'Abstract shapes', '\"the Abstract Shapes \"bag : a simple basic bag in  a unique blush  color .', 'Images/products/printed/shapes.jpg', 4, 25, 5, 0),
(10, 'sunflower', '\"sunflower \" bag : a simple basic bag in  a unique sunflower hand print.', 'Images/products/printed/sunflower.jpg', 4, 25, 5, 0),
(11, 'rainbow', '\"the rainbow \"bag : a simple basic bag in  a unique rainbow  print .', 'Images/products/printed/rainbow.jpg', 4, 25, 4, 0),
(12, 'Super Mom', '\"the Super MOM bag\" : simple bag made out a thick soft velvety fabric in the color beige with super mom print .', 'Images/products/printed/supermom.jpg', 4, 25, 4, 0),
(13, 'trees', 'The \"trees Bag\" : aGeometrical, Abstract, Minimal, Modern, Pastel Tote Bag ', 'Images/products/printed/trees.jpg', 4, 25, 5, 0),
(14, 'shakespear quote', 'shakespear quote bag : simple bag made out a thick soft velvety fabric in the color beige with  shakespear quote.', 'Images/products/quotes/quotes/shakespear.jpg', 4, 25, 4, 0),
(15, 'flower face', 'the flower face tote :  made out a beige colored  fabric with embroidery in the shape of a flower face .', 'Images/products/embroided/flower_face.jpg', 4, 25, 5, 0),
(16, 'camille TOTE BAG', '\"Madame camille\" tote bag : a simple bag made out a thick soft velvety fabric in the color beige with beautiful blue flower crown .', 'Images/products/camille.jpg', 4, 25, 5, 0),
(17, 'callme', 'The \"call me\" bag is a simple beige colored tote bag with a \"call me\" quote', 'Images/products/quotes/quotes/callme.png', 4, 25, 5, 0),
(18, 'floral bag', '\" the pink floral bag\" : simple beige  bag with cute colored delicate flower details .', 'Images/products/embroided/flowers.jpg', 4, 25, 4, 0),
(19, 'Turtle Tote', 'the \"turtle embroided\" bag simple bag made out a thick soft velvety fabric in the color beige with a cute turtle print .', 'Images/products/embroided/TURTLE.jpg', 4, 25, 5, 0),
(20, 'Monstera embroided Tote', 'the \"Monstera Tote\" bag simple bag made out a thick soft velvety fabric in the color beige with a beautiful hand painted Monstera plant in the green color.', 'Images/products/embroided/MONSTERA.jpg', 4, 25, 4, 0),
(21, 'la vie est un voyage', '\"la vie est un voyage\" TOTE bag : simple bag made out a thick soft velvety fabric in the color light gray with a meaningful quote  .', 'Images/products/quotes/quotes/voyage.jpg', 4, 25, 5, 4),
(22, 'je m\'en bas les cils', '\"je m\'en bas les cils\" TOTE bag : made out a beige colored  fabric with a black embroidery in the shape of eyelashes.', 'Images/products/embroided/cils.jpg', 4, 25, 5, 2),
(23, 'homme parfait', 'the \"l\'homme parfait\" TOTE bag : simple bag made out a thick soft velvety fabric in the color beige with a funny quote .', 'Images/products/quotes/quotes/hommeparfait.jpg', 4, 25, 5, 3),
(24, 'Dog life', 'the \"vie de chien\" Tote bag : simple bag made out a thick soft velvety fabric in the color beige with a funny meaningful quote.', 'Images/products/quotes/quotes/chien.png', 4, 25, 5, 2),
(25, 'je le ferais demain', 'the \"je le ferais demain \" TOTE bag : simple bag made out a thick soft velvety fabric in the color beige with a quote and a beautiful drawing.', 'Images/products/quotes/quotes/demain.jpg', 4, 25, 4, 4),
(26, 'shapes&shapes', 'the \"shapes & shapes \" TOTE bag :  a simple basic bag in a unique blush colors with beautiful shapes and black embroidery .', 'Images/offer.png', 4, 25, 5, 5);






