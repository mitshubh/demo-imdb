USE CS143

#Return names of all the actors in the movie 'Die Another Day'

SELECT CONCAT(first, " ", last) As ActorName FROM Movie M, Actor A, MovieActor MA 
WHERE M.id = MA.mid AND A.id = MA.aid AND M.title = 'Die Another Day';

#Count of all actors who acted in multiple movies
SELECT Count(*) AS ActorCountActingInMultipleMovies
FROM (SELECT MA.aid FROM MovieActor MA 
	GROUP BY MA.aid HAVING COUNT(*)>1) Result;

#Return Names of all Female Directors
SELECT CONCAT(A.first, " ", A.last) As ActorName
FROM Actor A, Director D 
WHERE A.id = D.id AND A.sex = 'Female'