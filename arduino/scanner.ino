const int scanner = 7;
const int turntable = 5;
int timer = 0;
int degree = 0;

void setup() {
	pinMode(scanner, OUTPUT);
	pinMode(turntable, OUTPUT);
	digitalWrite(scanner, LOW);
	digitalWrite(turntable, LOW);
	Serial.begin(9600);
	Serial.println("Hello world!");
}

void loop() {
	if (Serial.available()) {
		char ch = Serial.read();
		if ( ch == 'f') {
			digitalWrite(scanner, HIGH);
			Serial.println("FIRIN' MAH LAZER!");
			delay(2000);
			
digitalWrite(scanner, LOW);
			Serial.println("turning off...");
		}
		if ( ch == 'n') {
			digitalWrite(turntable, HIGH);
			Serial.print("spin 3 degrees... ");
			delay(360);
			digitalWrite(turntable, LOW);
			Serial.println("done");
			degree += 3;
			Serial.print("total degrees: ");
			Serial.println(degree);
		}
		if ( ch == 'r') {
			Serial.println("resetting degrees...");
			degree = 0;
		}
		if ( ch == 'z') {
			digitalWrite(turntable, HIGH);
			timer = millis();
		}
		if ( ch == 'y') {
			digitalWrite(turntable, LOW);
			Serial.println(millis()-timer);
			timer = 0;
		}
	}
}
