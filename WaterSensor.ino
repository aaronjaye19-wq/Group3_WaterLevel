int sensorPin = A0;
int greenLED = 2;
int yellowLED = 6;
int redLED = 11;

int value;
unsigned long greenOnTime = 0;
bool yellowTurnedOn = false;

void setup() {
  Serial.begin(9600);
  pinMode(greenLED, OUTPUT);
  pinMode(yellowLED, OUTPUT);
  pinMode(redLED, OUTPUT);
}

void loop() {
value = analogRead(sensorPin);

  // Reset LEDs
  digitalWrite(greenLED, LOW);
  digitalWrite(yellowLED, LOW);
  digitalWrite(redLED, LOW);
  yellowTurnedOn = false;

  int green = 0;
  int yellow = 0;
  int red = 0;

  // Green LED logic
  if (value >= 100) {           // just touching water
    digitalWrite(greenLED, HIGH);
    green = 1;

    if (greenOnTime == 0) {
      greenOnTime = millis();
    }
  } else {
    greenOnTime = 0; // reset timer if sensor goes dry
  }

  // Yellow LED logic: 2 sec after green if mid-level water
  if (value >= 250 && greenOnTime > 0) {
    if (millis() - greenOnTime >= 2000) {
      digitalWrite(yellowLED, HIGH);
      yellow = 1;
      yellowTurnedOn = true;
    }
  }

  // Red LED logic: fully submerged
  if (value >= 330) {
    digitalWrite(redLED, HIGH);
    red = 1;

    // Make sure yellow turns on if fully submerged
    if (!yellowTurnedOn) {
      digitalWrite(yellowLED, HIGH);
      yellow = 1;
    }
  }

  // Send Serial data in Laravel-friendly format
  Serial.print("SENSOR:");
  Serial.print(value);
  Serial.print(",GREEN:");
  Serial.print(green);
  Serial.print(",YELLOW:");
  Serial.print(yellow);
  Serial.print(",RED:");
  Serial.println(red);

  Serial.flush();  // ensure data is sent immediately
  delay(1000);      // adjust update speed (500ms = 0.5s)
}