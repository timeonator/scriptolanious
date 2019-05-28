create table  questions (
    quest_id    int not null auto_increment,
    quest       varchar(255),
    primary key(quest_id)
);
create table  answers (
    answer_id   int not null auto_increment,
    answer      varchar(255),
    quest_id    int,
    primary key(quest_id)
);
create table if not exists is_correct(
    question_id     int,
    answer_id       int
);

grant all privileges on quest.* to 'smarty'@'localhost' identified by 'epiq20day';
flush privileges;