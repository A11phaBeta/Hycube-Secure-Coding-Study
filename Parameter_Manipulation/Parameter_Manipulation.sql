create database Parameter_Manipulation default charset utf8 collate utf8_general_ci;

use Parameter_Manipulation;

create table board_data(no int auto_increment, title text not null, body text not null, author text not null, timestamp text, primary key(no));