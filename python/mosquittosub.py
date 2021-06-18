# coding: utf-8
""" Souscription au topic "fablab/#" sur le broker Eclipse Mosquitto.
    Utilise une autenthification login/mot-de-passe sur le broker
"""
import paho.mqtt.client as mqtt_client
from datetime import datetime
import time

# Configuration 
MQTT_BROKER = "10.7.5.189"
MQTT_PORT   = 1883
KEEP_ALIVE  = 20 # interval en seconde

def on_log( client, userdata, level, buf ):
    print( "log: ",buf)

def on_connect( client, userdata, flags, rc ):
    print( "Connexion: code retour = %d" % rc )
    print( "Connexion: Statut = %s" % ("OK" if rc==0 else "échec") )


def on_message( client, userdata, message ): 
   print( "Reception message MQTT..." ) 
   print( "Topic : %s" % message.topic ) 
   print( "Data : %s" % message.payload ) 
   now = datetime.now() # current date and time
   ts = time.time()
   date_time = now.strftime("%Y/%m/%d, %H:%M:%S")
   date_time_csv = now.strftime("%Y%m%d%H%M%S")

   file1 = open('/var/www/html/data/data-' + message.topic.replace('/', '-') + '.txt',"a")
   file1.write( 'date: ' + str(ts) + '{ ' + 'topic:  ' + message.topic + ' , ' + 'message:  ' + message.payload + ' } \n' )
   file1.close() 
   
   file2 = open('/var/www/html/data-csv/data-' + message.topic.replace('/', '-') + '.csv', "a")
   file2.write(str(ts) + ',' + message.payload + '\n')
   file2.close()

def run():
  # Client(client_id=””, clean_session=True, userdata=None, protocol=MQTTv311, transport=”tcp”)
  client = mqtt_client.Client( client_id="client007" )

  # Assignation des fonctions de rappel
  client.on_message = on_message
  client.on_connect = on_connect
  #client.on_log = on_log 

  # Connexion broker
  client.connect( host=MQTT_BROKER, port=MQTT_PORT, keepalive=KEEP_ALIVE )
  client.subscribe( "fablab/#" )

  # Envoi des messages
  client.loop_forever()