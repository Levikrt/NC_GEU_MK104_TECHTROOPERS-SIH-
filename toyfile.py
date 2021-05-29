# -*- coding: utf-8 -*-
"""
Created on Thu Jul 30 10:53:45 2020

@author: Syed Zeeshan
"""
import time
import serial
import tensorflow as tf
import numpy as np
import time as time112
import cv2
from numpy import expand_dims
from keras.models import load_model
from keras.preprocessing.image import load_img
from keras.preprocessing.image import img_to_array
from matplotlib import pyplot
from matplotlib.patches import Rectangle
from tensorflow.keras.preprocessing import image

def time_in(x):                         #function to send variable to arduino
    input_val=str(x)
    board.write(input_val.encode())


model = tf.keras.models.load_model('C:/Users/Syed Zeeshan/Downloads/toyCNN.h5',compile=False) #loading pre-trained model

vidcap = cv2.VideoCapture(0)            #taking video input from webcam
success,image1 = vidcap.read()

board = serial.Serial('COM3',9600)      #entering portname 'COM3' along with buadrate 9600
if(board.is_open!=True):                #checking if the arduino port is open
    board.open()

while(0xFF!=ord('q')):
    t1=0
       
    success,image1 = vidcap.read()      #reading frame from live video
      
       
    cv2.imwrite("C:/Users/Syed Zeeshan/Desktop/livefeedtest/frame.jpg", image1) #destination where frames will be saved
    print("saved")
    
    test_dir='C:/Users/Syed Zeeshan/Desktop/livefeedtest/frame.jpg'
    #image processing takes place
    img_array = cv2.imread(test_dir) 
    new_array = cv2.resize(img_array, (224, 224))  
    new_array=new_array.reshape(-1,224,224,3)
    predictions = model.predict(new_array)
    
    test_pred = [np.argmax(probas) for probas in predictions]           #storing the prediction of our model in test_pred
    
    if(test_pred[0]==0):                                                #prediction [0] is the label for heavy traffic
        t1=30
        print("Heavy Traffic, keep the signal green for 30 seconds")    
    elif(test_pred[0]==1):                                              #prediction [1] is the label for light traffic
        t1=10
        print("Light Traffic, keep the signal green for 10 seconds")    
    elif(test_pred[0]==2):                                              #prediction [2] is the label for moderate traffic
        t1=20
        print("Moderate Traffic, keep the signal green for 20 seconds")
    time_in(t1)
    time.sleep(t1+30)                                                   #time.sleep specifies the amount of time taken between each frame
                                                                        #here, 30 seconds is the time taken for other dummy signals to go from red to green


