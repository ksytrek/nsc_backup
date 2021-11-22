#Libraries
import RPi.GPIO as GPIO
import time
 
#set GPIO Pins
GPIO_TRIGGER = 18
GPIO_ECHO = 24
GPIO_Buzzer = 23
GPIO_In1 = 25
GPIO_In2 = 16
GPIO_butopen = 17
GPIO_connect = 27 #pin แสดงไฟเชื่อมต่อเน็ต

def setupins():
    #GPIO Mode (BOARD / BCM)
    GPIO.setmode(GPIO.BCM)
    #set GPIO direction (IN / OUT)
    GPIO.setup(GPIO_TRIGGER, GPIO.OUT)
    GPIO.setup(GPIO_ECHO, GPIO.IN)
    
    GPIO.setup(GPIO_Buzzer, GPIO.OUT)
    GPIO.setup(GPIO_In1, GPIO.OUT)
    GPIO.setup(GPIO_In2, GPIO.OUT)
    GPIO.setup(GPIO_butopen, GPIO.IN, pull_up_down=GPIO.PUD_DOWN) # Set pin 10 to be an input pin and set
    GPIO.setup(GPIO_connect, GPIO.OUT)
    print("Setup GPIO")
    
    #not = Active LOW
    alstatus = True

    GPIO.output(GPIO_In2, alstatus)
    GPIO.output(GPIO_In1, alstatus)
    GPIO.output(GPIO_connect, False)
    GPIO.output(GPIO_Buzzer, False)

def cleanpins():
    print("Clean GPIO")
    GPIO.cleanup()

def distanceultra():
    # set Trigger to HIGH
    GPIO.output(GPIO_TRIGGER, True)
 
    # set Trigger after 0.01ms to LOW
    time.sleep(0.00001)
    GPIO.output(GPIO_TRIGGER, False)
 
    StartTime = time.time()
    StopTime = time.time()
 
    # save StartTime
    while GPIO.input(GPIO_ECHO) == 0:
        StartTime = time.time()
 
    # save time of arrival
    while GPIO.input(GPIO_ECHO) == 1:
        StopTime = time.time()
 
    # time difference between start and arrival
    TimeElapsed = StopTime - StartTime
    # multiply with the sonic speed (34300 cm/s)
    # and divide by 2, because there and back
    distance = (TimeElapsed * 34300) / 2
 
    return distance

    

'''
try:
    while True:
        dist = distance()
        print ("Measured Distance = %.1f cm" % dist)
        time.sleep(1)
 
        # Reset by pressing CTRL + C
except KeyboardInterrupt:
        print("Measurement stopped by User")
        GPIO.cleanup()

'''