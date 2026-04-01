import serial
import time
import requests

arduino_port = 'COM4'
arduino_baud = 9600
laravel_url = "http://127.0.0.1:8000/api/sensor"
# ---------------------------

arduino = serial.Serial(arduino_port, arduino_baud, timeout=1)
time.sleep(2)  # allow Arduino to reset

print("Starting Arduino → Laravel communication...")

while True:
    line = arduino.readline().decode().strip()
    if line:
        try:
            # Arduino prints: SENSOR:123,GREEN:1,YELLOW:0,RED:0
            data = {k.lower(): int(v) for k,v in (pair.split(':') for pair in line.split(','))}
            response = requests.post(laravel_url, json=data)
            print(f"Sent: {data} | Response: {response.status_code}")
        except Exception as e:
            print("Error:", e)
    time.sleep(1)