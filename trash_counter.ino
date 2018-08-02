

#define MAX_NUMB                 9       /* High counting range limit        */
 

    void setup()
{ 
 pinMode(7,OUTPUT);
 Serial.begin(9600);
 } 

int counter=0;
int counterpoint=0;

boolean state = true ;
boolean stateponit = true ;
void loop()
{     
   int value=analogRead(A1);
   if(state){
  if(value<500){ 

    increase();
 
   if(counter>3000 || counter<0){
    if(state){

      digitalWrite(7,LOW);
     Serial.println("contaner is full");
     //send notofaction to control
    state = false; 
    }else {
      
    }
     
   }else {
     digitalWrite(7,HIGH);
     if(stateponit){
           counterpoint++;
            stateponit = false; 
     }
   Serial.println(counterpoint);
   
   }
   
   }
   else{
     stateponit = true;
     digitalWrite(7,LOW);
   }
   
    
   }
 

 }

 void increase() {
  counter++;

  }
void reset() {
  if(counter) {
 
  }
}
