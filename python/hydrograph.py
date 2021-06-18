# coding: utf-8
import matplotlib
matplotlib.use('Agg')
import matplotlib.pyplot as plt
from matplotlib.ticker import NullFormatter, FixedLocator, MultipleLocator
import matplotlib.dates as mdates
import numpy as np
import datetime as dt
from datetime import datetime
import csv
import time
from statistics import mean

path = '/var/www/html/'
#path = ''

font1 = {'family':'serif','color':'blue','size':20}
font2 = {'family':'serif','color':'darkred','size':15}

x = []
y = []

with open(path + 'data-csv/data-fablab-weather-hydro.csv','r') as file:
    graph = file.read().replace("\0","")
    contents_split = graph.splitlines()
    for i in range(len(contents_split)):
    	xety = contents_split[i].split(",")
    	x.append(int(float(xety[0])))
    	y.append(int(round(float(xety[1]),1)))
    	
timestamp = time.time()
moyenne = mean(y)
now = datetime.fromtimestamp(timestamp)
then = now + dt.timedelta(seconds=len(x))
hours = mdates.drange(now,then,dt.timedelta(seconds=1))
plt.show(block=True)
plt.gca().xaxis.set_major_formatter(mdates.DateFormatter('%H:%M'))
plt.gca().xaxis.set_major_locator(mdates.SecondLocator(interval=60))
plt.ylim([0, 100])
plt.plot(hours[:len(y)],y)
plt.gcf().autofmt_xdate()
plt.ylabel('Humidite (%)', fontdict = font2)
plt.xlabel('Heure', fontdict = font2)
plt.title('Variation de l\'humidite dans l\'air (%)', fontdict = font1)
plt.text(0.5,0.5,'Moyenne: ' + str(round(moyenne, 1)) + " (%) ",horizontalalignment='center', verticalalignment='center', transform = plt.gca().transAxes)
plt.savefig(path + 'graph/hydro-graph.png')
print("Ok SAVE HYDRO")