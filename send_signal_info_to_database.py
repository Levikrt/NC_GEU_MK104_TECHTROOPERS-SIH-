import tensorflow as tf
import os
import cv2
import matplotlib.pyplot as plt
import numpy as np
from keras.models import Sequential
from keras.applications.vgg16 import VGG16
from keras.layers import Dense
from keras.layers import GlobalAveragePooling2D
from keras.preprocessing.image import load_img
from keras.layers import Dropout
from tensorflow.keras.preprocessing.image import ImageDataGenerator
import mysql.connector
from datetime import datetime
model =VGG16(input_shape=(224,224,3),include_top=False,
                                               weights='imagenet')


regularizer = tf.keras.regularizers.l2(0.01)
#Adding regularizer to overcome Overfitting of the model
for layer in model.layers:
    for attr in ['kernel_regularizer']:
        if hasattr(layer, attr):
          setattr(layer, attr, regularizer)

Model = Sequential()
for layer in model.layers[:11]:
  layer.trainable=True
  Model.add(layer)
c=0  
for layer in model.layers[11:]:
  Model.add(layer)
  c+=1
  if c%4==0:
    Model.add(Dropout(0.3)) 

Model.add(GlobalAveragePooling2D())
Model.add(Dense(units=4098,activation="relu"))
Model.add(Dense(units=4098,activation="relu"))
Model.add(Dense(units=3, activation="softmax"))
Model.load_weights('C:/Users/arun/Downloads/Traffic_Densen(VGG).h5')
i1='C:/Users/arun/Downloads/frame9984 (1).jpg'
i2='C:/Users/arun/Downloads/frame8976.jpg'
i3='C:/Users/arun/Downloads/frame1632.jpg'
i4='C:/Users/arun/Downloads/frame13728 (1).jpg'
Classes={0:'Heavy Traffic', 1:'Light Traffic', 2:'Moderate Traffic'}
'''
i=[i1,i2,i3,i4]
result=[]
for item in i:
    img_array = cv2.imread(item)
    #plt.imshow(img_array)
    new_array = cv2.resize(img_array, (224, 224),interpolation = cv2.INTER_AREA) 
    new_array=new_array.reshape(-1,224,224,3)
    predictions = Model.predict(new_array)
    test_pred = [np.argmax(probas) for probas in predictions]
    print(Classes[test_pred[0]])
    result.append(predictions)
 
print(result)
'''
z=[i1,i2,i3,i4]
import os
import time
from threading import Thread
class Lane: #this class is used to create lane objects
  def __init__(self,laneno,traffic_mode,ambulance):
    self.laneno=laneno
    self.ambulance=ambulance
    self.traffic_mode=traffic_mode
class Traffic_manager: #this class consists of all the functions needed to control the traffic signal and predict traffic densities
  @staticmethod
  def return_priority(tensor):  #this returns the most prior lane, ex: if ambulance is present, it is the most prior lane 
    for lane in tensor:
      if lane.ambulance:
        return lane
    priority=max(tensor,key=lambda l:l.traffic_mode)
    return priority

  @staticmethod
  def traffic_signal(lane,laneno,emergency=False): #this gives the signal to a given lane wiht specific amount of time alloted
    print('green for lane'+str(laneno))
    if emergency:
      # print(lane,'emergency')
      time.sleep(4)
    else:
      if lane.traffic_mode==0:
        # print(lane,1)
        time.sleep(1)
      if lane.traffic_mode==1:
        # print(lane,2)
        time.sleep(3)
      if lane.traffic_mode==2:
        # print(lane,3)
        time.sleep(5)

  @staticmethod
  def cycle(tensor): #here, we give signal to the most prior lane
    lanes=[i.laneno for i in tensor]
    while tensor:
      prior=Traffic_manager.return_priority(tensor)
      arguments=[prior,prior.laneno,prior.ambulance==True]
      signalthread=Thread(target=Traffic_manager.traffic_signal,args=arguments)
      signalthread.start()
      if(prior.ambulance==False):
        tensor.remove(prior)
        lanes.remove(prior.laneno)
      
      tensor=Traffic_manager.predictions(z)
      tensor=[lane for lane in tensor if lane.laneno in lanes]
      signalthread.join()

  @staticmethod
  def predictions(images): #this takes arrays of images as input and and predicts the traffic density for each image
    p={}
    # images=get_images()
    for i in range(len(images)):
      img=load_img(images[i],target_size=(224,224,3))
      img=np.expand_dims(img,axis=0)
      outcome=list(Model.predict_classes(img))
      p[i]=outcome
      p[i]+=[False] #ex: p would be p={1:[high,false]},boolean represents presence of ambulance
      p[i][0]=2-p[i][0]   ####  i did 2 minus outcome, because i considered 2 as heavy but the model considered 0 as heavy, thats it
    array=[] #this array consists of Lane objects
    c=0
    for i in p:
      array.append(Lane(i,p[i][0],p[i][1]))
    return array

result=Traffic_manager.predictions(z)  #[[1,False],[2,False],[1,False],[0,True]]
# result=Traffic_manager.create_tensor(result,0,1,2,3)
#this adds the data tothe database taking the parameters incident name and desc
def add_to_database(inname,indesc):
  mydb = mysql.connector.connect(
            host='127.0.0.1',
            database='sitms',
            user='root',
            password='',
            use_pure=True     
            )
  nowtime =str(datetime.now().time())
  nowdate = str(datetime.now().date())
  mycursor = mydb.cursor() 
  sql = "INSERT INTO sitms_report_incident (incident_name,incident_desc,incident_date,incident_time,incident_location,incident_user) VALUES (%s, %s,%s,%s,%s,%s)"
  inplace='Signal Junction'
  inuser='Traffic Signal'
  val = inname,indesc,nowdate,nowtime,inplace,inuser
  mycursor.execute(sql, val)
  mydb.commit()
#this checks if all lanes are heavy, then we update our database as a TrafficJam is caused
def check_to_add(predictions):
  for i in predictions:
    if i.traffic_mode != 2:
      return False
  return True
if check_to_add(result):
  add_to_database(inname='Traffic Jam',indesc='')
Traffic_manager.cycle(result)
print(result)

plt.show()