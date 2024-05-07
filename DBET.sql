CREATE TABLE User (
	user_id INTEGER NOT NULL,
	first_name CHARACTER VARYING(50) NOT NULL,
	last_name CHARACTER VARYING(50),
	height NUMERIC(2, 0),
	weight NUMERIC(2, 0),
	dob DATE,
	gender CHARACTER(1),

	PRIMARY KEY (user_id)
);

CREATE TABLE Workout (
	workout_id INTEGER NOT NULL,
	user_id INTEGER NOT NULL,
	date DATE NOT NULL,
	start_time TIME WITHOUT TIME ZONE,
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

CREATE TABLE Set (
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
	time_elapsed TIME WITHOUT TIME ZONE NOT NULL,

	PRIMARY KEY (run_id),

	FOREIGN KEY (workout_id) REFERENCES Workout (workout_id)
		ON UPDATE CASCADE ON DELETE RESTRICT
);

CREATE TABLE Swim (
	swim_id INTEGER NOT NULL,
	workout_id INTEGER NOT NULL,
	meters INTEGER NOT NULL,
	reps INTEGER NOT NULL,
	time_elapsed TIME WITHOUT TIME ZONE NOT NULL,

	PRIMARY KEY (swim_id),

	FOREIGN KEY (workout_id) REFERENCES Workout (workout_id)
		ON UPDATE CASCADE ON DELETE RESTRICT
);


INSERT INTO User (user_id, first_name, last_name)
	VALUES (1, 'Caleb', 'Shea');
INSERT INTO User (user_id, first_name, last_name)
	VALUES (2, 'Miles', 'Kirk');

INSERT INTO Workout (workout_id, user_id, date, start_time)
	VALUES (11, 1, '2024-02-21', '12:00:00');
INSERT INTO Workout (workout_id, user_id, date, start_time)
	VALUES (12, 2, '2024-02-20', '13:00:00');
INSERT INTO Workout (workout_id, user_id, date, start_time)
	VALUES (13, 2, '20024-02-21', '14:00:00');

INSERT INTO Swim (swim_id, workout_id, meters, reps, time_elapsed)
	VALUES (111, 11, 10000, 1, '03:00:00');
INSERT INTO Swim (swim_id, workout_id, meters, reps, time_elapsed)
	VALUES (112, 12, 500, 6, '01:00:00');

INSERT INTO Run (run_id, workout_id, miles, type, time_elapsed)
	VALUES (121, 12, 5, 'LSD', '00:40:00');
INSERT INTO Run (run_id, workout_id, miles, type, time_elapsed)
	VALUES (121, 11, 2, 'Sprints', '00:30:00');

INSERT INTO Lift (lift_id, workout_id, exercise)
	VALUES (131, 13, 'Barbell Rows');
INSERT INTO Lift (lift_id, workout_id, exercise)
	VALUES (132, 13, 'DB Curls');
INSERT INTO Lift (lift_id, workout_id, exercise)
	VALUES (133, 13, 'Pull-ups');

INSERT INTO Set (set_id, lift_id, weight, reps, in_lbs)
	VALUES (1111, 131, 135, 5, True);
INSERT INTO Set (set_id, lift_id, weight, reps, in_lbs)
	VALUES (1112, 131, 225, 4, True);
INSERT INTO Set (set_id, lift_id, weight, reps, in_lbs)
	VALUES (1113, 131, 275, 3, True);
INSERT INTO Set (set_id, lift_id, weight, reps, in_lbs)
	VALUES (1114, 132, 30, 8, True);
INSERT INTO Set (set_id, lift_id, weight, reps, in_lbs)
	VALUES (1115, 132, 35, 8, True);
INSERT INTO Set (set_id, lift_id, weight, reps, in_lbs)
	VALUES (1116, 132, 40, 6, True);
INSERT INTO Set (set_id, lift_id, weight, reps, in_lbs)
	VALUES (1117, 133, 0, 15, True);
INSERT INTO Set (set_id, lift_id, weight, reps, in_lbs)
	VALUES (1118, 133, 0, 15, True);
INSERT INTO Set (set_id, lift_id, weight, reps, in_lbs)
	VALUES (1119, 133, 25, 10, True);
