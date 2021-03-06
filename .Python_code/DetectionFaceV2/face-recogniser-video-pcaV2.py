import time
import cv2
import numpy as np
from joblib import load
import face_recognition
import connect
import file

HAAR_MODEL = './model-haar/haarcascade_frontalface_default.xml'
server = connect.Server("http://skbright.totddns.com:28006/nsc_backup/raspberrypi_communication/postReceiver.php")

# permission list
id_room = 1
permission_list = file.get_current_permission_list(room=id_room, key="id_mem")


try:
    if server.check_update_model():
        server.update_model()
    if server.check_update_permission():
        server.update_permission()
        # change permission list
        permission_list = file.get_current_permission_list(room=id_room, key="id_mem")
except:
    print("Can't connect server")

# INPUT/OUTPUT PARAMETERS
SVM_MODEL = "model/" + str(file.get_current_model())
FACE_SIZE = (256, 256)

font = cv2.FONT_HERSHEY_SIMPLEX
color_known = (0, 255, 0)
color_unknown = (0, 0, 255)
threshold = 0.80

detector = cv2.CascadeClassifier(HAAR_MODEL)
classifier = load(SVM_MODEL)

capture = cv2.VideoCapture(0)

# cv2.namedWindow("face classifier", cv2.WND_PROP_FULLSCREEN)
# cv2.setWindowProperty("face classifier", cv2.WND_PROP_FULLSCREEN, cv2.WINDOW_FULLSCREEN)

# set log sending timer
time_send_log = time.time()

while True:
    ret, frame = capture.read()
    image = frame.copy()
    gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
    rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
    faces = detector.detectMultiScale(gray, 1.3, 5)

    for (x, y, w, h) in faces:
        testset = []
        boxes = [(y, x + w, y + h, x)]
        encodings = face_recognition.face_encodings(rgb, boxes)
        if (len(encodings) > 0):
            testset.append(np.ravel(encodings[0]))
            pred = classifier.predict(testset)
            prob = classifier.predict_proba(testset)
            max_prob = max(prob[0])
            color = color_unknown
            if max_prob >= threshold:
                color = color_known
                text = ''.join(pred[0] + ' (' + '{0:.2g}'.format(max_prob * 100) + '%)')
                cv2.putText(image, text, (x, y - 10), font, 0.6, color, thickness=2)
                if (pred[0] in permission_list):
                    #check if time has passed for 6 secs before log
                    #preventing sending log every detection
                    if time.time() - time_send_log >= 6:
                        print("unlock")
                        print(server.send_log_to_server(id_mem=pred[0], id_room=id_room))
                        # rest timer
                        time_send_log = time.time()
                else:
                    print("locked")
            else:
                color = color_unknown
                text = ''.join('Unknown')
                cv2.putText(image, text, (x, y - 10), font, 0.6, color, thickness=2)
                print("locked")

            cv2.rectangle(image, (x, y), (x + w, y + h), color, 2)

    image = cv2.putText(image, "AI Face Recognition", (10, 15), cv2.FONT_HERSHEY_SIMPLEX, 0.4, (0, 0, 255),
                        lineType=cv2.LINE_AA)
    cv2.imshow('face classifier', image)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
capture.release()
cv2.destroyAllWindows()
