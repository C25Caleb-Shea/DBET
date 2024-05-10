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
	ts DATE,
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
		(11, 1, '2024-04-30 10:00:00'),
		(12, 2, '2024-02-20 13:00:00'),
		(13, 1, '2024-02-21 14:00:00'),
		(14, 1, '2024-04-23 14:00:00'),
		(15, 1, '2024-04-25 08:30:00');

INSERT INTO Swim (swim_id, workout_id, meters, reps, time_elapsed)
	VALUES
		(111, 13, 10000, 1, '03:00:00'),
		(112, 12, 500, 6, '01:00:00');

INSERT INTO Run (run_id, workout_id, miles, type, time_elapsed)
	VALUES
		(121, 12, 5, 'LSD', '00:40:00'),
		(122, 12, 2, 'Sprints', '00:35:00'),
		(123, 12, 2, 'Recovery', '00:35:00');

INSERT INTO Lift (lift_id, workout_id, exercise)
	VALUES
		(131, 11, 'Power Cleans'),
		(132, 11, 'BB Rows'),
		(133, 11, 'Lat Pulldowns'),
		(134, 11, 'Cable Reverse Curls'),
		
		(135, 14, 'Back Squat'),
		(136, 14, 'DB RDLs'),
		(137, 14, 'BB Split Squat');

INSERT INTO LSet (set_id, lift_id, weight, reps, in_lbs)
	VALUES
		(1111, 131, 154, 7, True),
		(1112, 131, 154, 5, True),
		(1113, 131, 176, 5, True),
		(1114, 131, 187, 4, True),
		(1115, 131, 198, 4, True),
		(1116, 131, 209, 2, True),
		
		(1117, 132, 132, 12, True),
		(1118, 132, 154, 10, True),
		(1119, 132, 176, 7, True),
		(1120, 132, 198, 5, True),
		(1121, 132, 132, 15, True),
		
		(1122, 133, 120, 12, True),
		(1123, 133, 140, 10, True),
		(1124, 133, 160, 8, True),
		(1125, 133, 170, 6, True),
		(1126, 133, 130, 12, True),
		
		(1127, 134, 30, 12, True),
		(1128, 134, 40, 10, True),
		(1129, 134, 45, 8, True),
		(1130, 134, 50, 6, True),
		(1131, 134, 55, 7, True),
		(1132, 134, 60, 4, True),
		
		(1133, 135, 132, 8, True),
		(1134, 135, 176, 6, True),
		(1135, 135, 198, 8, True),
		(1136, 135, 220, 7, True),
		(1137, 135, 265, 5, True),
		(1138, 135, 287, 3, True),
		(1139, 135, 315, 1, True),
		
		(1140, 136, 75, 10, True),
		(1141, 136, 85, 10, True),
		(1142, 136, 95, 10, True),
		(1143, 136, 105, 8, True),
		(1144, 136, 115, 8, True),
		(1145, 136, 125, 8, True),
		
		(1146, 137, 110, 10, True),
		(1147, 137, 132, 10, True),
		(1148, 137, 154, 10, True),
		(1149, 137, 176, 7, True),
		(1150, 137, 198, 6, True);
	



