import json
import sys
import os.path
from datetime import datetime
from os.path import basename
import requests
import os
import zipfile
import time


def send_log(link_of_postreciever_server, id_mem, id_room):
    req = requests.post(link_of_postreciever_server, data={"id_mem": id_mem,
                                                           "id_room": id_room})
    # .strip() = Trimming Whitespaces
    return req.text.strip()


def get_current_permission():
    try:
        f = open("permission/name_permission.txt", "r")
        return f.readline().strip()
        f.close()
    except:
        NameError


def get_current_permission_list(room, key):
    # Opening JSON file
    f = open("permission/" + get_current_permission(), )
    data = json.load(f)
    list = []
    for i in data:
        if (i["id_room"] == str(room)):
            list.append(i[key])
    f.close()
    # return list
    return list


def get_all_current_permission_list():
    # Opening JSON file
    f = open("permission/" + get_current_permission(), )
    data = json.load(f)
    list = []
    for i in data:
        list.append(i)
    f.close()
    # return list
    return list


# check lastest permission on server
def get_latest_permission(link_of_postreciever_server):
    req = requests.post(link_of_postreciever_server, data={'check_latest_permission': 'value'})
    # .strip() = Trimming Whitespaces
    return req.text.strip()


def get_current_model():
    try:
        f = open("model/namemodel.txt", "r")
        return f.readline().strip()
        f.close()
    except:
        NameError


# check lastest model
def get_latest_model(link_of_postreciever_server):
    req = requests.post(link_of_postreciever_server, data={'check_latest_model': 'value'})
    # .strip() = Trimming Whitespaces
    return req.text.strip()


# signal to server to compile files
def download_prep(link_of_postreciever_server):
    req = requests.post(link_of_postreciever_server, data={'zip_files': 'value'})
    print(req.text)


def download_file(link_of_file_on_server, destination_for_downloaded_file):
    filename = link_of_file_on_server.rsplit('/', 1)[1]
    completeName = os.path.join(destination_for_downloaded_file, filename)
    with open(completeName, "wb") as f:
        print("\n Downloading %s" % filename)
        response = requests.get(link_of_file_on_server, stream=True)
        total_length = response.headers.get('content-length')

        if total_length is None:  # no content length header
            f.write(response.content)
        else:
            dl = 0
            total_length = int(total_length)
            for data in response.iter_content(chunk_size=4096):
                dl += len(data)
                f.write(data)
                done = int((dl / total_length) * 100)
                sys.stdout.write("\r[%s%s]" % (done, "%"))
                sys.stdout.flush()


def extract_file(zipped_file, destination_for_unzip):
    with zipfile.ZipFile(zipped_file, 'r') as zip_ref:
        zip_ref.extractall(destination_for_unzip)
    zip_ref.close()


def upload_face(files_to_upload, link_of_postreciever_server):
    test_file = {'file': open(files_to_upload, "rb")}
    print("Uploading....")
    test_response = requests.post(link_of_postreciever_server, files=test_file)
    print("Uploaded")
    print(test_response.text)


def upload_model(model_to_upload, link_of_postreciever_server):
    test_file = {'file_model': open(model_to_upload, "rb")}
    print("Uploading....")
    test_response = requests.post(link_of_postreciever_server, files=test_file)
    print("Uploaded")
    print(test_response.text)


def upload_permission(model_to_upload, link_of_postreciever_server):
    test_file = {'file_permission': open(model_to_upload, "rb")}
    print("Uploading....")
    test_response = requests.post(link_of_postreciever_server, files=test_file)
    print("Uploaded")
    print(test_response.text)


def zipdir(dirName, archived_name):
    # ziph is zipfile handle
    ziph = zipfile.ZipFile(archived_name + '.zip', 'w', zipfile.ZIP_DEFLATED)
    # Iterate over all the files in directory
    for folderName, subfolders, filenames in os.walk(dirName):
        for filename in filenames:
            # create complete filepath of file in directory
            filePath = os.path.join(folderName, filename)
            # Add file to zip
            ziph.write(filePath, os.path.join(dirName, basename(filePath)))
    ziph.close()


def export_list():
    now = datetime.now()
    current_time = now.strftime("_%Y_%m_%d_%H_%M_%S")
    arr = os.listdir("datasets/faces/")
    js = 'model/data' + current_time + '.json'
    f = open("model/list.txt", "w")
    f.write('data' + current_time + '.json')
    f.close()
    count = 0
    list = []
    for x in arr:
        text = {"id": count,
                "name": x,
                }
        count += 1
        list.append(text)

    with open(js, 'w') as f:
        json.dump(list, f)

    return js


def timer():
    time_send_log = time.time()
    while (True):
        if time.time() - time_send_log >= 6:
            print("time has passed for 6 secs")
            #rest timer
            time_send_log = time.time()


# ownload_file("http://skbright.totddns.com:28006/nsc_backup/raspberrypi_communication/postReceiver.php",os.getcwd())
# print(get_latest_permission("http://gonewhich.thddns.net:7071/Upload_Download/postReceiver.php"))
# print(get_all_current_permission_list())
# print(get_current_permission_list(1,"id_mem"))
# download_prep("http://gonewhich.thddns.net:7071/Upload_Download/postReceiver.php")
# print(get_current_permission_list(key="id_mem",room=1))
#timer()
