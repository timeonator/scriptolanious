create table subjects(
    sub_id  int not null auto_increment,
    sub_name    varchar(250),
    primary key (sub_id)
);

create table questions (    
    quest_id    int not null,
    content     text,
    iscorrect   varchar(5)
);


create table result(
    user_id int not null,
    question_id  int not null,
    sub_id  int not null,
    is_selected varchar(5),
    is_correct  varchar(5)
);



