import os
top = r'C:\Users\C25Caleb.Shea\OneDrive - afacademy.af.edu\Desktop\Spring 2deg\CS 364\Project\Lifting data'

workout_id = 0

for f in os.listdir(top):
    fname = os.path.join(top, f)

    with open(fname, 'r') as src:
        c = [x.strip() for x in src.readlines()[2:]]
        print(c)

        date = ''
        exercise = ''
        sets = []

        while len(c) > 0:
            # check for start of a new workout
            if c[0][0] in [str(i) for i in range(10)]:
                date = c.pop(0)
                workout_id += 1

            # otherwise we have a new exercise
            else:
                # check for the start of an exercise
                exercise = c.pop(0)

                # add all sets
                while c[0] != '':
                    sets.append(c.pop(0))

        if '@' in date:
            date, time = date.split('@')
        else:
            time = '00:00:00'

        # write each
        with open(os.path.join(top, 'cmds.txt'), 'w') as new:
            line = f"""INSERT INTO Workout (workout_id, user_id, date, start_time)
	VALUES ({workout_id}, 1, '{date}', '{time}');\n"""
            new.write(line)
        
        break
