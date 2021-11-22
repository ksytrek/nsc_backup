import os
import file
import shutil
import urllib
from urllib.request import urlopen


class Server:
    def __init__(self, postreciever):
        self.postr = str(postreciever)
        # download zipped file
        self.zip_location_on_server = self.postr.replace("postReceiver.php", "face.zip")

        # check for connection
        self.is_connect()

    def is_connect(self):
        try:
            urlopen(self.postr, timeout=1)
            return True
        except urllib.error.URLError as Error:
            print(Error)
            return False

    def upload_face_to_server(self, name):
        # get in faces directory
        os.chdir('datasets/faces')

        file.zipdir(name, name)
        file.upload_face(name + ".zip", self.postr)
        os.remove(name + ".zip")

        # remove faces folder
        dir_path = name
        try:
            shutil.rmtree(dir_path)
        except OSError as e:
            print("Error: %s : %s" % (dir_path, e.strerror))

        # get back to root directory
        os.chdir('../../')

    def download_face_from_server(self):
        # signal for server to zip the files
        file.download_prep(self.postr)
        #download zipped file from server
        file.download_file(self.zip_location_on_server, os.getcwd())

        #extract to this machine
        file.extract_file("face.zip", "datasets/faces/")
        file.os.remove("face.zip")

    def upload_model(self):
        file.upload_model("model/namemodel.txt", self.postr)
        file.upload_model("model/"+file.get_current_model(),self.postr)

    def check_update_model(self):
        if file.get_latest_model(self.postr) == "0":
            print("There's no model available on server")
            return False
        elif file.get_latest_model(self.postr) != file.get_current_model() or not os.path.exists(
                "model/" + file.get_current_model()):
            return True
        else:
            return False

    def update_model(self):
        try:
            # remove old model
            if os.path.exists("model/" + str(file.get_current_model())):
                os.remove("model/" + str(file.get_current_model()))
            else:
                os.mkdir("model")
        except OSError as error:
            print(error)

        # locate .txt
        txt_location_on_server = self.postr.replace("postReceiver.php", "model/namemodel.txt")
        # download .txt
        file.download_file(txt_location_on_server, "model/")

        # locate model
        model_location_on_server = self.postr.replace("postReceiver.php", "model/" + file.get_current_model())
        # download model
        file.download_file(model_location_on_server, "model/")

    def check_update_permission(self):
        if file.get_latest_permission(self.postr) == "0":
            print("There's no model available on server")
            return False
        elif file.get_latest_permission(self.postr) != file.get_current_permission() or not os.path.exists(
                "permission/" + file.get_current_permission()):
            return True
        else:
            return False

    def update_permission(self):
        try:
            # remove old model
            if os.path.exists("permission/" + str(file.get_current_permission())):
                os.remove("permission/" + str(file.get_current_permission()))
            else:
                if not os.path.exists("permission"):
                    os.mkdir("permission")
        except OSError as error:
            print(error)
        # locate .txt
        txt_location_on_server = self.postr.replace("postReceiver.php", "permission/name_permission.txt")
        # download .txt
        file.download_file(txt_location_on_server, "permission/")

        # locate model
        model_location_on_server = self.postr.replace("postReceiver.php", "permission/" + file.get_current_permission())
        # download model
        file.download_file(model_location_on_server, "permission/")

f = Server("http://skbright.totddns.com:28006/nsc_backup/raspberrypi_communication/postReceiver.php")
print(f.check_update_model())

#f = Server("http://gonewhich.thddns.net:7071/Upload_Download/postReceiver.php")
#f.download_face_from_server()





