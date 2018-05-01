import serial
import time
import sys,ast
message='';
c=' '.join(sys.argv[1:])


num=c.replace("[","").replace("]","").split(",")
message=num.pop()

class TextMessage:
        # def __init__(self):
        #     self.recipient = recipient
        #     self.content = message



        def connectPhone(self):
            self.ser = serial.Serial('COM7', 9600, timeout=5, xonxoff = False, rtscts = False, bytesize = serial.EIGHTBITS, parity = serial.PARITY_NONE, stopbits = serial.STOPBITS_ONE)
            time.sleep(1)

        def sendMessage(self,recipient, message):
            self.ser.write('ATZ\r'.encode())
            time.sleep(0.5)
            self.ser.write('AT+CMGF=1\r'.encode())
            time.sleep(0.5)
            self.ser.write(('''AT+CMGS="''' + recipient + '''"\r''').encode())
            time.sleep(0.5)
            self.ser.write((message + "\r").encode())
            time.sleep(0.5)
            self.ser.write(chr(26).encode())
            time.sleep(0.5)
        def disconnectPhone(self):
            self.ser.close()

sms = TextMessage()
sms.connectPhone()
for numbers in num:
    print(numbers)
    sms.sendMessage(numbers,message)
   #time.sleep(0.5)
sms.disconnectPhone()

print ("1")
