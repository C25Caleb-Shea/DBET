var setNum = 1;

function addStyleSheet(properties) {
  var head = document.getElementsByTagName('head')[0];

  var link = document.createElement('link');
  for (key in properties) {
    link[key] = properties[key];
  }

  head.appendChild(link);
}

// add Font Awesome stylesheet for toggle button
addStyleSheet({
    'rel': 'stylesheet',
    'href': 'https://use.fontawesome.com/releases/v5.7.2/css/all.css',
    'crossorigin': 'anonymous'
});

/*<label for="exercise">Exercise:</label>
<input type="text" id="exercise" name="exercise" pattern="[A-Za-z -]{1,50}" maxlength="50" required><br><br>

<label for="weight">Weight:</label>
<input type="number" id="weight" name="weight" required><br><br>

<label for="kgs">Is the weight above in kgs?</label>
<input type="checkbox" id="kgs" name="kgs"><br><br>

<label for="reps">Reps:</label>
<input type="number" id="reps" name="reps" required><br><br>*/
function addSet() {
  var div = document.createElement('div');
  div.className = 'liftSet'
  div.style.textAlign = 'center';
  div.style.marginTop = '10px';

  // Set number
  var setMarker = document.createElement('h3');
  setMarker.innerHTML = 'Set ' + setNum;

  // Exercise name
  var exercise = document.createElement('input');
  exercise.type = 'text';
  exercise.id = 'exercise';
  exercise.name = 'exercise';
  exercise.pattern = '[A-Za-z -]{1,50}';
  exercise.maxLength = '50';
  exercise.required = true;
  var eLabel = document.createElement('label');
  eLabel.innerHTML = 'Exercise: ';
  eLabel.for = 'exercise'
  exercise.style.marginRight = '10px'

  // Weight
  var weight = document.createElement('input');
  weight.type = 'number';
  weight.id = 'weight';
  weight.name = 'weight';
  weight.required = true;
  var wLabel = document.createElement('label');
  wLabel.innerHTML = 'Weight: ';
  wLabel.for = 'weight'
  weight.style.marginRight = '10px'

  // Reps
  var reps = document.createElement('input');
  reps.type = 'number';
  reps.id = 'reps';
  reps.name = 'reps';
  reps.required = true;
  var rLabel = document.createElement('label');
  rLabel.innerHTML = 'Reps: ';
  rLabel.for = 'reps'
  reps.style.marginRight = '10px'

  // In kgs
  var kgs = document.createElement('input');
  kgs.type = 'checkbox'
  kgs.id = 'kgs'
  kgs.name = 'kgs'
  var kLabel = document.createElement('label');
  kLabel.innerHTML = 'In kgs? ';
  kLabel.for = 'kgs'

  // Add to div
  div.appendChild(setMarker);
  div.appendChild(eLabel);
  div.appendChild(exercise);
  div.appendChild(wLabel);
  div.appendChild(weight);
  div.appendChild(rLabel);
  div.appendChild(reps);
  div.appendChild(kLabel);
  div.appendChild(kgs);

  // Add div to page
  var tempField = document.getElementsByClassName('submit')[0];
  tempField.before(div);

  // Increment set counter
  setNum++;
}

var div = document.createElement('div');
div.style.position = 'relative';
div.style.textAlign = 'center';
var b = document.createElement('button');
b.className = 'addSetButton'
b.type = 'button'
b.onclick = addSet;

var label = document.createTextNode('Add Set');

var span = document.createElement('span');
span.className = 'addSetButton';
span.id = 'addSetButton';

b.appendChild(label);
b.appendChild(span);

div.appendChild(b);

var body = document.getElementsByTagName('body')[0];
var submitButton = document.getElementsByClassName('submit')[0];
submitButton.before(div)
