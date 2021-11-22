import shutil
import cv2
from pathlib import Path
import time
import connect

OUTPUT_PATH = 'datasets/faces'
OUTPUT_PATH_TEST = 'datasets/faces_test'
SIZE = (256,256)
MAX_CAPTURE = 50

detector = cv2.CascadeClassifier('model-haar/haarcascade_frontalface_default.xml')
font = cv2.FONT_HERSHEY_SIMPLEX
color = (0,255,0)
label = input('input name: ')
output_path = Path(OUTPUT_PATH)
if not output_path.exists():
    output_path.mkdir()
output_face_path = Path(OUTPUT_PATH + '/' + label)
if not output_face_path.exists():
    output_face_path.mkdir()

count = 0
capture = cv2.VideoCapture(0)
#capture.set(cv2.CAP_PROP_FRAME_WIDTH, 1920)
#capture.set(cv2.CAP_PROP_FRAME_HEIGHT, 1080)
capture.set(cv2.CAP_PROP_FRAME_WIDTH, 640)
capture.set(cv2.CAP_PROP_FRAME_HEIGHT, 480)
cv2.namedWindow("face-acquisition", cv2.WINDOW_AUTOSIZE)
cv2.moveWindow("face-acquisition", 20,20)
#cv2.namedWindow("face-acquisition", cv2.WND_PROP_FULLSCREEN)
#cv2.setWindowProperty("face-acquisition", cv2.WND_PROP_FULLSCREEN, cv2.WINDOW_FULLSCREEN)
time.sleep(2)
start_time = time.time()
while count < MAX_CAPTURE:
    ret, frame = capture.read()
    gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
    faces = detector.detectMultiScale(gray, 1.3, 5)
    if len(faces) > 0:
        for (x, y, w, h) in faces:
            face = frame[y:y+h, x:x+w]
            output_name = OUTPUT_PATH + '/' + label + '/img' + str(count) + '.jpg'
            output_name_test = OUTPUT_PATH_TEST + '/' + label + '/img' + str(count) + '.jpg'
            face_cropped = frame[y:y+h, x:x+w]
            face_resized = cv2.resize(face_cropped, SIZE, interpolation=cv2.INTER_LINEAR)
            if (time.time() - start_time) >= 0.5:
                start_time = time.time()
                cv2.imwrite(output_name, face_resized)
                count += 1
            cv2.rectangle(frame, (x,y), (x+w,y+h), color, 2)
            cv2.putText(frame, 'count = ' + str(count) + ' of ' + str(MAX_CAPTURE), (x,y-10), font, 0.6, color, thickness=2)

    cv2.imshow('face-acquisition', frame)
    if cv2.waitKey(1) & 0xFF == ord('q'):
        break
capture.release()
cv2.destroyAllWindows()

server = connect.Server("http://skbright.totddns.com:28006/nsc_backup/raspberrypi_communication/postReceiver.php")
server.upload_face_to_server(label)
