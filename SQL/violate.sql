#Table Movie
#PRIMARY KEY (id)
INSERT INTO Movie VALUES (2, "Test Movie Insertion", "2016", "PG", "Shub Co.");
#Violates the id uniqueness consraint set by PRIMARY KEY on id
#Output -- Duplicate entry '2' for key 'PRIMARY' 

#Table Actor
#PRIMARY KEY (id)
INSERT INTO Actor VALUES (1, "Mittal", "Shubham", "Male", "2016-07-07", null);
#Violates the id uniqueness consraint set by PRIMARY KEY on id
# Duplicate entry '1' for key 'PRIMARY'

#CHECK(sex='Male' OR sex='Female')
UPDATE Actor SET sex = "M" WHERE id=1;
#Violates the CHECK constratint which enforces the sex to be either "Male" or "Female"
# Output -- NO OUTPUT ! CHECK() statement are not enfored by MySql

#CHECK (ISNULL(dod)=1 OR dob<dod)
INSERT INTO Actor VALUES (11, "Mittal", "Shubham", "Male", "2016-07-07", "2014-07-07");
#Violates the check statement which enforces that the date of birth must be less than the date of birth
# Output -- NO OUTPUT ! CHECK() statement are not enfored by MySql

#Table Director
#PRIMARY KEY (id)
INSERT INTO Director VALUES (16, "last", "Shubham", "2016-07-07", null);
#Violates the id uniqueness consraint set by PRIMARY KEY on id
# Output -- Duplicate entry '16' for key 'PRIMARY' 

#CHECK (ISNULL(dod)=1 OR  dob<dod)
INSERT INTO Director VALUES (11, "Mittal", "Shubham", "2016-07-07", "2014-07-07");
#Violates the check statement which enforces that the date of birth must be less than the date of birth
# Output -- NO OUTPUT ! CHECK() statement are not enfored by MySql

#Table MovieGenre
#FOREIGN KEY (mid) references Movie(id)
#Instead of this --- INSERT INTO MovieGenre Values (4735, "Drame"); -- can also use
Delete from Movie where id = 2
# Leads to failure because of the foreign key constraint. We cannot delete an id being used in the MovieGenre from the Movie table as if that Movie is deleted from the parent table, then the corresponding entry in MovieGenre should be deleted. Use CASCADE to enfore this. 
# Output -- Cannot delete or update a parent row: a foreign key constraint fails (`CS143`.`MovieGenre`, CONSTRAINT `MovieGenre_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`)) 

#Table MovieDirector
#FOREIGN KEY (mid) references Movie(id)
INSERT INTO MovieDirector Values (4735, 12672424);
#Cannot add or update a child row as the foreign key enforces that the mid or the movie ids are dependent on the values in the Movie table
# and cannot be arbitrarily changed/added in the MovieGenre table. The id to be added/updated must be present in the corresponding referenced column
# Output -- Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`))

#FOREIGN KEY (aid) references Actor(aid)
UPDATE MovieDirector SET did = 1627123 where mid = 4345;
#Cannot add or update a child row as the foreign key enforces that the aid or the actor ids are dependent on the values in the Actor table
# and cannot be arbitrarily changed/added in the MovieDirector table. The id to be added/updated must be present in the corresponding referenced column
# Output -- Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieDirector`, CONSTRAINT `MovieDirector_ibfk_2` FOREIGN KEY (`did`) REFERENCES `Director` (`id`))

#MovieActor Table
#FOREIGN KEY (mid) references Movie(id)
INSERT INTO MovieActor Values (4735, 126713213, "Hero");
#Cannot add or update a child row as the foreign key enforces that the mid or the movie ids are dependent on the values in the Movie table
# and cannot be arbitrarily changed/added in the MovieGenre table. The id to be added/updated must be present in the corresponding referenced column
#Output -- Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`)) 

#FOREIGN KEY (aid) references Actor(aid)
UPDATE MovieActor SET aid = 162713 where mid = 5;
#Cannot add or update a child row as the foreign key enforces that the aid or the actor ids are dependent on the values in the Actor table
# and cannot be arbitrarily changed/added in the MovieDirector table. The id to be added/updated must be present in the corresponding referenced column
#Output -- Cannot add or update a child row: a foreign key constraint fails (`CS143`.`MovieActor`, CONSTRAINT `MovieActor_ibfk_2` FOREIGN KEY (`aid`) REFERENCES `Actor` (`id`))

#Table Review
#FOREIGN KEY (mid) references Movie(id)
Insert INTO Review Values (name = "rev1", time = "1000-01-01 00:00:00", mid = 12312312, rating = 1, comment = "Test comment")
#Cannot add or update a child row as the foreign key enforces that the mid or the movie ids are dependent on the values in the Movie table
# and cannot be arbitrarily changed/added in the Review table. The id to be added/updated must be present in the corresponding referenced column
#Output -- Cannot add or update a child row: a foreign key constraint fails (`CS143`.`Review`, CONSTRAINT `Review_ibfk_1` FOREIGN KEY (`mid`) REFERENCES `Movie` (`id`)) 

#CHECK (rating<=5 || rating>=0)
Insert INTO Review Values (name = "rev1", time = "1000-01-01 00:00:00", mid = 1, rating = 10, comment = "Test comment")
#ratings of the movie cannot be negative and has to lie between 0 and 5 as per the CHECK constraint used
# Output -- NO OUTPUT ! CHECK() statement are not enfored by MySql