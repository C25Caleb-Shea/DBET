DROP TABLE IF EXISTS  Swim;
DROP TABLE IF EXISTS  Run;
DROP TABLE IF EXISTS  LSet;
DROP TABLE IF EXISTS  Lift;
DROP TABLE IF EXISTS Workout;
DROP TABLE IF EXISTS  User;

CREATE TABLE User (
	user_id INTEGER NOT NULL,
	pw_h CHARACTER VARYING(100) NOT NULL,
	first_name CHARACTER VARYING(50) NOT NULL,
	last_name CHARACTER VARYING(50),
	height NUMERIC(4, 0),
	weight NUMERIC(4, 0),
	dob DATE,
	gender CHARACTER(1),

	PRIMARY KEY (user_id)
);

CREATE TABLE Workout (
	workout_id INTEGER NOT NULL,
	user_id INTEGER NOT NULL,
	ts TIMESTAMP,
	weather CHARACTER VARYING(100),
	temp_f INTEGER,

	PRIMARY KEY (workout_id),

	FOREIGN KEY (user_id) REFERENCES User (user_id)
		ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Lift (
	lift_id INTEGER NOT NULL,
	workout_id INTEGER NOT NULL,
	exercise CHARACTER VARYING(50) NOT NULL,

	PRIMARY KEY (lift_id),

	FOREIGN KEY (workout_id) REFERENCES Workout (workout_id)
		ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE LSet (
	set_id INTEGER NOT NULL,
	lift_id INTEGER NOT NULL,
	weight INTEGER NOT NULL,
	reps INTEGER NOT NULL,
	in_lbs BOOLEAN NOT NULL,

	PRIMARY KEY (set_id),

	FOREIGN KEY (lift_id) REFERENCES Lift (lift_id)
		ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Run (
	run_id INTEGER NOT NULL,
	workout_id INTEGER NOT NULL,
	miles DOUBLE PRECISION NOT NULL,
	type CHARACTER VARYING(50) NOT NULL,
	time_elapsed TIME NOT NULL,

	PRIMARY KEY (run_id),

	FOREIGN KEY (workout_id) REFERENCES Workout (workout_id)
		ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Swim (
	swim_id INTEGER NOT NULL,
	workout_id INTEGER NOT NULL,
	meters INTEGER NOT NULL,
	reps INTEGER NOT NULL,
	time_elapsed TIME NOT NULL,

	PRIMARY KEY (swim_id),

	FOREIGN KEY (workout_id) REFERENCES Workout (workout_id)
		ON UPDATE CASCADE ON DELETE RESTRICT
);


INSERT INTO User (user_id, pw_h, first_name, last_name, height, weight, dob, gender)
	VALUES
		(1, '$2y$10$AlYlxC8b.9JZK8ZunXaXmO3kGnWLxu6Ce7pXjtFyOnqWExZidVTxa', 'Caleb', 'Shea', '75', '200', '2003-01-13', 'M'),
		(2, '$2y$10$AlYlxC8b.9JZK8ZunXaXmO3kGnWLxu6Ce7pXjtFyOnqWExZidVTxa', 'Miles', 'Kirk', '75', '200', '2003-01-13', 'M');

INSERT INTO Workout (workout_id, user_id, ts)
	VALUES
		(11, 1, '2024-02-21 12:00:00'),
		(12, 2, '2024-02-20 13:00:00'),
		(13, 1, '2024-02-21 14:00:00');

INSERT INTO Swim (swim_id, workout_id, meters, reps, time_elapsed)
	VALUES
		(111, 11, 10000, 1, '03:00:00'),
		(112, 12, 500, 6, '01:00:00');

INSERT INTO Run (run_id, workout_id, miles, type, time_elapsed)
	VALUES
		(121, 11, 5, 'LSD', '00:40:00'),
		(122, 12, 2, 'Sprints', '00:30:00');

INSERT INTO Lift (lift_id, workout_id, exercise)
	VALUES
		(131, 13, 'Barbell Rows'),
		(132, 13, 'DB Curls'),
		(133, 13, 'Pull-ups');

INSERT INTO LSet (set_id, lift_id, weight, reps, in_lbs)
	VALUES
		(1111, 131, 135, 5, True),
		(1112, 131, 225, 4, True),
		(1113, 131, 275, 3, True),
		(1114, 132, 30, 8, True),
		(1115, 132, 35, 8, True),
		(1116, 132, 40, 6, True),
		(1117, 133, 0, 15, True),
		(1118, 133, 0, 15, True),
		(1119, 133, 25, 10, True);
	

