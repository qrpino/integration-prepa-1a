#include "Adafruit_VL53L0X.h"
#include "EspMQTTClient.h"

// address we will assign if dual sensor is present
#define LOX1_ADDRESS 0x31
#define LOX2_ADDRESS 0x30

// set the pins to shutdown
#define SHT_LOX1 14
#define SHT_LOX2 12

// objects for the vl53l0x
Adafruit_VL53L0X lox1 = Adafruit_VL53L0X();
Adafruit_VL53L0X lox2 = Adafruit_VL53L0X();

// this holds the measurement
VL53L0X_RangingMeasurementData_t measure1;
VL53L0X_RangingMeasurementData_t measure2;

EspMQTTClient client(
  "IMERIR Fablab",
  "imerir66",
  "10.7.5.189",  // MQTT Broker server ip
  "",   // Can be omitted if not needed
  "",   // Can be omitted if not needed
  "InOut",     // Client name that uniquely identify your device
  1883              // The MQTT port, default to 1883. this line can be omitted
);

int distance1, distance2;

/*
    Reset all sensors by setting all of their XSHUT pins low for delay(10), then set all XSHUT high to bring out of reset
    Keep sensor #1 awake by keeping XSHUT pin high
    Put all other sensors into shutdown by pulling XSHUT pins low
    Initialize sensor #1 with lox.begin(new_i2c_address) Pick any number but 0x29 and it must be under 0x7F. Going with 0x30 to 0x3F is probably OK.
    Keep sensor #1 awake, and now bring sensor #2 out of reset by setting its XSHUT pin high.
    Initialize sensor #2 with lox.begin(new_i2c_address) Pick any number but 0x29 and whatever you set the first sensor to
 */
void setID() {
  // all reset
  digitalWrite(SHT_LOX1, LOW);    
  digitalWrite(SHT_LOX2, LOW);
  delay(10);
  // all unreset
  digitalWrite(SHT_LOX1, HIGH);
  digitalWrite(SHT_LOX2, HIGH);
  delay(10);

  // activating LOX1 and reseting LOX2
  digitalWrite(SHT_LOX1, HIGH);
  digitalWrite(SHT_LOX2, LOW);

  // initing LOX1
  if(!lox1.begin(LOX1_ADDRESS)) {
    Serial.println(F("Failed to boot first VL53L0X"));
    while(1);
  }
  delay(10);

  // activating LOX2
  digitalWrite(SHT_LOX2, HIGH);
  delay(10);

  //initing LOX2
  if(!lox2.begin(LOX2_ADDRESS)) {
    Serial.println(F("Failed to boot second VL53L0X"));
    while(1);
  }
}

int visitor = 0;
String visiteur;

void read_dual_sensors() {
  
  lox1.rangingTest(&measure1, false); // pass in 'true' to get debug data printout!
  lox2.rangingTest(&measure2, false); // pass in 'true' to get debug data printout!
  
  distance1 = measure1.RangeMilliMeter;
  distance2 = measure2.RangeMilliMeter;
  
  if(distance1 < 800 && distance2 > 800) { // si le capteur 1 reagit en premier
    visitor = visitor + 1; // ALORS on ajoute +1 a la variable visitor
    visiteur = String(visitor);
  }
  if(distance1 > 800 && distance2 < 800) { // si le capteur 2 reagit en second
    visitor = visitor - 1; // ALORS on enleve 1 a la variable visitor
    visiteur = String(visitor);
  }
  Serial.println(visitor); // on s'en sert pour deboguer
}

void setup() {
  Serial.begin(115200);

  // Optionnal functionnalities of EspMQTTClient : 
  client.enableDebuggingMessages(); // Enable debugging messages sent to serial output
  client.enableHTTPWebUpdater(); // Enable the web updater. User and password default to values of MQTTUsername and MQTTPassword. These can be overrited with enableHTTPWebUpdater("user", "password").

  // wait until serial port opens for native USB devices
  while (! Serial) { delay(1); }

  pinMode(SHT_LOX1, OUTPUT);
  pinMode(SHT_LOX2, OUTPUT);

  Serial.println(F("Shutdown pins inited..."));

  digitalWrite(SHT_LOX1, LOW);
  digitalWrite(SHT_LOX2, LOW);

  Serial.println(F("Both in reset mode...(pins are low)"));
  
  
  Serial.println(F("Starting..."));
  setID();
 
}

// This function is called once everything is connected (Wifi and MQTT)
// WARNING : YOU MUST IMPLEMENT IT IF YOU USE EspMQTTClient
void onConnectionEstablished()
{
}


void loop() {
  client.loop();
  upload();
  read_dual_sensors();
  delay(500);
}

void upload() {
  client.publish("fablab/number-person1", String(distance1));
  client.publish("fablab/number-person2", String(distance2));
  client.publish("fablab/number-person2", visiteur);
}
