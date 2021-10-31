import cv2
import numpy as np
import pandas as pd
import matplotlib.pyplot as plt
from joblib import dump, load
from pathlib import Path
import face_recognition

from sklearn.decomposition import PCA
from sklearn.svm import SVC
from sklearn.neural_network import MLPClassifier
from sklearn.model_selection import cross_val_predict
from sklearn.metrics import accuracy_score, classification_repoconrt, confusion_matrix

HAAR_MODEL = './model-haar/haarcascade_frontalface_default.xml'

PROCESSED_IMAGE_PATH = './datasets/processed'
PROCESSED_CSV_FILE = './datasets/processed.csv'
DETECTED_FACE_PATH = './datasets/cropped'
DETECTED_CSV_FILE = './datasets/cropped.csv'

train_csv_file = PROCESSED_CSV_FILE

# INPUT/OUTPUT PARAMETERS
INPUT_IMAGE_PATH = './datasets/faces'
OUTPUT_CSV_FILE = './datasets/faces.csv'
OUTPUT_MODEL_NAME = './model/faces-encoding.lib'

# EXPERIMENTAL PARAMETERS
DETECT_FACE = False
IMAGE_SIZE = 256
FACE_SIZE = (256,256)

def create_csv(dataset_path, output_csv):
    root_dir = Path(dataset_path)
    items = root_dir.iterdir()

    filenames = []
    labels = []
    print('reading image files ... ')

    for item in items:
        if item.is_dir():
            for file in item.iterdir():
                if file.is_file():
                    print(str(file))
                    filenames.append(file)
                    labels.append(item.name)

    raw_data = {'filename': filenames, 'label': labels}
    df = pd.DataFrame(raw_data, columns=['filename','label'])
    df.to_csv(output_csv)
    print(len(filenames), 'image file(s) read')
    input("Press [ENTER] key to continue...")


def resize(image, width=None, height=None):
    (h, w) = image.shape[:2]
    if width is None:
        r = height/float(h)
        dim = (int(w*r), height)
    else:
        r = width/float(w)
        dim = (width, int(h*r))
    return cv2.resize(image, dim, interpolation=cv2.INTER_LINEAR)

def process_image(input_csv, output_csv, output_path_name):
    dataset = pd.read_csv(input_csv, sep=',')
    ids = dataset.values[:,0]
    names = dataset.values[:,1]
    labels = dataset.values[:,2]

    output_path = Path(output_path_name)
    if not output_path.exists():
        output_path.mkdir()

    filenames = []
    print('preprocessing images ... ')
    for item in names:
        input_path = Path(item)
        if input_path.is_file():
            output_name = output_path_name + '/image' + str(ids[len(filenames)]) + input_path.suffix
            print(input_path, '->', output_name)
            image = cv2.imread(str(input_path))
            image = resize(image, width=IMAGE_SIZE, height=IMAGE_SIZE)
            cv2.imwrite(output_name, image)
            filenames.append(output_name)



    prc_data = {'filename': filenames, 'label': labels}
    df = pd.DataFrame(prc_data, columns=['filename', 'label'])
    df.to_csv(output_csv)
    print(len(filenames), 'image file(s) processed')
    input("Press [ENTER] key to continue...")

def detect_face(input_csv, output_csv, output_path_name):
    dataset = pd.read_csv(input_csv, sep=',')
    ids = dataset.values[:,0]
    names = dataset.values[:,1]
    labels = dataset.values[:,2]

    output_path = Path(output_path_name)
    if not output_path.exists():
        output_path.mkdir()

    clf = cv2.CascadeClassifier(HAAR_MODEL)
    face_filenames = []
    face_labels = []
    count = 0
    face_count = 0
    print('detecting faces ... ')
    for item in names:
        image = cv2.imread(item)
        face_label = labels[count]

        gray = cv2.cvtColor(image, cv2.COLOR_BGR2GRAY)
        faces = clf.detectMultiScale(gray, 1.3, 5)
        for (x, y, w, h) in faces:
            cropped = image[y:y+h, x:x+w]
            output_file = output_path_name + '/face' + str(len(face_filenames)) + '.jpg'
            cv2.imwrite(output_file, cropped)

            face_filenames.append(output_file)
            face_labels.append(face_label)
        print(item, '->', len(faces), ' face(s) detected')
        face_count += len(faces)
        count += 1
    crp_data = {'filename': face_filenames, 'label': face_labels}
    df = pd.DataFrame(crp_data, columns=['filename', 'label'])
    df.to_csv(output_csv)
    print('Total of', face_count, 'face(s) detected')
    input("Press [ENTER] key to continue...")

def train_model(train_csv, output_model_name):
    dataset = pd.read_csv(train_csv, sep=',')
    ids = dataset.values[:,0]
    names = dataset.values[:,1]
    labels = dataset.values[:,2]
    new_labels = []
    images = []
    print('Training recognition model ...')
    i = 0
    for item in names:
        image = cv2.imread(str(item))
        rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
        encodings = face_recognition.face_encodings(rgb)
        for encoding in encodings:
            print("encoding image: " + str(item))
            images.append(encoding)
            new_labels.append(labels[i])
        i = i + 1

    clf = SVC(kernel='rbf', probability=True)
    clf.fit(images, new_labels)
    dump(clf, output_model_name)

    print('Model created in', output_model_name)
    input("Press [ENTER] key to continue...")

def validate_model(validate_csv, model_name):
    dataset = pd.read_csv(validate_csv, sep=',')
    ids = dataset.values[:,0]
    names = dataset.values[:,1]
    labels = dataset.values[:,2]

    new_labels = []
    images = []
    i = 0
    print('Validating recognition model ...')
    for item in names:
        image = cv2.imread(str(item))
        rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)
        encodings = face_recognition.face_encodings(rgb)
        for encoding in encodings:
            print("encoding image: " + str(item))
            images.append(encoding)
            new_labels.append(labels[i])
        i = i + 1

    clf = load(model_name)
    y_p = cross_val_predict(clf, images, new_labels, cv=5)
    print('Accuracy Score:', '{0:.4g}'.format(accuracy_score(new_labels,y_p) * 100), '%')
    print('Confusion Matrix:')
    print(confusion_matrix(new_labels,y_p))
    print('Classification Report:')
    print(classification_report(new_labels,y_p))

create_csv(INPUT_IMAGE_PATH, OUTPUT_CSV_FILE)


process_image(OUTPUT_CSV_FILE, PROCESSED_CSV_FILE, PROCESSED_IMAGE_PATH)
if DETECT_FACE:
    detect_face(PROCESSED_CSV_FILE, DETECTED_CSV_FILE, DETECTED_FACE_PATH)
    train_csv_file = DETECTED_CSV_FILE
train_model(train_csv_file, OUTPUT_MODEL_NAME)
validate_model(train_csv_file, OUTPUT_MODEL_NAME)

