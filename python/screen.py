import logging
import threading
import time
import schedule
import os
import mosquittosub

def mosqui():
	mosquittosub.run()

def rune():
	while True:
		os.system('sudo python /home/pi/Mosquitto/hydrograph.py')
		print("Run Hydro Graph")
		os.system('sudo python /home/pi/Mosquitto/pressiongraph.py')
		print("Run Pression Graph")
		time.sleep(60)

threading.Thread(target=rune).start()
mosqui()
