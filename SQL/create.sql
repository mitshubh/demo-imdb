USE CS143

#Every constraint has been commented next to its usage. See below

CREATE TABLE Movie (
	id		INT NOT NULL,
	title	VARCHAR(100) NOT NULL,
	year	INT,
	rating	VARCHAR(10),
	company	VARCHAR(50),
	PRIMARY KEY (id)	#Each Movie id must be unique i.e. movies should be uniquely identifiable
);

CREATE TABLE Actor (
	id		INT NOT NULL,
	last 	VARCHAR(20),
	first	VARCHAR(20),
	sex		VARCHAR(6),
	dob 	DATE NOT NULL,
	dod		DATE,
	PRIMARY KEY (id),	#Each Actor id must be unique i.e. actors should be uniquely identifiable
	CHECK(sex='Male' OR sex='Female'),	#Actor's gender can either be male or female
	CHECK (ISNULL(dod)=1 OR dob<dod) #Either the date of death is not mentioned (is null) or the date of birth is less than the date of death
);

CREATE TABLE Director (
	id		INT NOT NULL,
	last 	VARCHAR(20),
	first	VARCHAR(20),
	dob 	DATE NOT NULL,
	dod		DATE,
	PRIMARY KEY (id),	#Each Director id must be unique i.e. directors should be uniquely identifiable
	CHECK (ISNULL(dod)=1 OR  dob<dod)	#Either the date of death is not mentioned (is null) or the date of birth is less than the date of death
);

CREATE TABLE MovieGenre (
	mid		INT NOT NULL,
	genre 	VARCHAR(20),
	FOREIGN KEY (mid) references Movie(id)	#The movie ids (mid) has to be one of the ids present  in the Movie table. Prevents invalid data from being inserted
) ENGINE=INNODB;

CREATE TABLE MovieDirector (
	mid 	INT NOT NULL,
	did 	INT NOT NULL,
	FOREIGN KEY (mid) references Movie(id),	#The movie ids (mid) has to be one of the ids present  in the Movie table. Prevents invalid data from being inserted
	FOREIGN KEY (did) references Director(id)	#The director ids (did) has to be one of the ids present  in the Director table. Prevents invalid data from being inserted
) ENGINE=INNODB;

CREATE TABLE MovieActor (
	mid 	INT NOT NULL,
	aid 	INT NOT NULL,
	role 	VARCHAR(50),
	FOREIGN KEY (mid) references Movie(id),	#The movie ids (mid) has to be one of the ids present  in the Movie table. Prevents invalid data from being inserted
	FOREIGN KEY (aid) references Actor(id)	#The actor ids (aid) has to be one of the ids present  in the Actor table. Prevents invalid data from being inserted
) ENGINE=INNODB;

CREATE TABLE Review (
	name 	VARCHAR(20),
	time 	TIMESTAMP NOT NULL,
	mid 	INT NOT NULL,
	rating 	INT,
	comment VARCHAR(500),
	FOREIGN KEY (mid) references Movie(id),	#The movie ids (mid) has to be one of the ids present  in the Movie table. Prevents invalid data from being inserted
	CHECK (rating<=5 || rating>=0)	#ratings of the movie cannot be negative and has to lie between 0 and 5
) ENGINE=INNODB;

CREATE TABLE MaxPersonID (
	id 		INT NOT NULL
);

CREATE TABLE MaxMovieID (
	id 		INT NOT NULL
);