import cv2
import numpy as np
from joblib import load
import face_recognition
#import imutils

HAAR_MODEL = './model-haar/haarcascade_frontalface_default.xml'

# INPUT/OUTPUT PARAMETERS
SVM_MODEL = './model/cs-faces-encoding.lib'
FACE_SIZE = (256,256)

font = cv2.FONT_HERSHEY_SIMPLEX
color_known = (0,255,0)
color_unknown = (0,0,255)
threshold = 0.80

detector = cv2.CascadeClassifier(HAAR_MODEL)
classifier = load(SVM_MODEL)

capture = cv2.VideoCapture(0)
#cv2.namedWindow("face classifier", cv2.WND_PROP_FULLSCREEN)
#cv2.setWindowProperty("face classifier", cv2.WND_PROP_FULLSCREEN, cv2.WINDOW_FULLSCREEN)
while True:
    ret, frame = capture.read()
    image = frame.copy()
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
    faces = detector.detectMultiScale(gray, 1.3, 5)

    for (x, y, w, h) in faces:
        testset = []
        boxes = [(y, x + w, y + h, x)]
        encodings = face_recognition.face_encodings(rgb,boxes)
        if(len(encodings) > 0):
            testset.append(np.ravel(encodings[0]))
            pred = classifier.predict(testset)
            prob = classifier.predict_proba(testset)
            max_prob = max(prob[0])
            color = color_unknown
            if max_prob >= threshold:
                text = ''.join(pred[0] + ' (' + '{0:.2g}'.format(max_prob * 100) + '%)')
                color = color_known
                cv2.putText(image, text, (x,y-10), font, 0.6, color, thickness=2)
            else:
                color = color_unknown
                text = ''.join('Unknown')
                cv2.putText(image, text, (x, y - 10), font, 0.6, color, thickness=2)

            cv2.rectangle(image, (x,y), (x+w,y+h), color, 2)

    image = cv2.putText(image, "AI Face Recognition", (10, 15), cv2.FONT_HERSHEY_SIMPLEX, 0.4,
                      (0, 0, 255),
                      lineType=cv2.LINE_AA)
    cv2.imshow('face classifier', image)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
capture.release()
cv2.destroyAllWindows()
