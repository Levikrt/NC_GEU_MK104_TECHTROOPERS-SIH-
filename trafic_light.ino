//7-25-2020
//kmit R&D
int lane[4][3];
int G1=22,Y1=24,R1=26,G2=28,Y2=30,R2=32,G3=34,Y3=36,R3=38,G4=40,Y4=42,R4=44;
String readString;
int T = 1000;

void setup() {
  // put your setup code here, to run once:
  Serial.begin(9600);
  for(int i= 22; i< 46; i+=2)
  {
     pinMode(i,OUTPUT); 
  }
}

void all_LOW()
{
  
  for(int i= 22; i< 46; i+=2)
  {
     digitalWrite(i,LOW);
  }
}
void SIGNAL_1()
{
  all_LOW();
  digitalWrite(G1,HIGH);
  digitalWrite(R2,HIGH);
  digitalWrite(R3,HIGH);
  digitalWrite(R4,HIGH);
  analogWrite(3,255);
  analogWrite(4,255);
  analogWrite(5,255);
  analogWrite(6,255);
  delay(T);
  all_LOW();
  digitalWrite(Y1,HIGH);
  digitalWrite(R2,HIGH);
  digitalWrite(R3,HIGH);
  digitalWrite(R4,HIGH);
  analogWrite(3,125);
  analogWrite(4,125);
  analogWrite(5,125);
  analogWrite(6,125);
  delay(2000);
}
void SIGNAL_2()
{
  all_LOW();
  digitalWrite(R1,HIGH);
  digitalWrite(G2,HIGH);
  digitalWrite(R3,HIGH);
  digitalWrite(R4,HIGH);
  analogWrite(3,0);
  analogWrite(4,0);
  analogWrite(5,0);
  analogWrite(6,0);
  delay(5000);
  all_LOW();
  digitalWrite(R1,HIGH);
  digitalWrite(Y2,HIGH);
  digitalWrite(R3,HIGH);
  digitalWrite(R4,HIGH);
  delay(2000);
}
void SIGNAL_3()
{
  all_LOW();
  digitalWrite(R1,HIGH);
  digitalWrite(R2,HIGH);
  digitalWrite(G3,HIGH);
  digitalWrite(R4,HIGH);
  analogWrite(3,0);
  analogWrite(4,0);
  analogWrite(5,0);
  analogWrite(6,0);
  delay(5000);
  all_LOW();
  digitalWrite(R1,HIGH);
  digitalWrite(R2,HIGH);
  digitalWrite(Y3,HIGH);
  digitalWrite(R4,HIGH);
  delay(2000);
}
void SIGNAL_4()
{
  all_LOW();
  digitalWrite(R1,HIGH);
  digitalWrite(R2,HIGH);
  digitalWrite(R3,HIGH);
  digitalWrite(G4,HIGH);
  analogWrite(3,0);
  analogWrite(4,0);
  analogWrite(5,0);
  analogWrite(6,0);
  delay(5000);
  all_LOW();
  digitalWrite(R1,HIGH);
  digitalWrite(R2,HIGH);
  digitalWrite(R3,HIGH);
  digitalWrite(Y4,HIGH);
  delay(2000);
}

void loop() {
  // put your main code here, to run repeatedly:
  while (Serial.available())
  {
    delay(11);  
    if (Serial.available() >0)
    {
      char c = Serial.read();  //gets one byte from serial buffer
      readString += c; //makes the string readString
    } 
  }

  if (readString.length() >0)
  {
    Serial.println(readString);  //so you can see the captured string 
    int n;
    char carray[6]; //converting string to number
    readString.toCharArray(carray, sizeof(carray));
    n = atoi(carray); 
   // myservo.writeMicroseconds(n); // for microseconds
   T=1000+1000*n;
    Serial.println(n);
    readString="";
  } 
  SIGNAL_1();
  SIGNAL_2();
  SIGNAL_3();
  SIGNAL_4();
}
