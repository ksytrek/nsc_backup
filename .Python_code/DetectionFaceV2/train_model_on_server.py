import requests
#userdata = {"firstname": "John", "lastname": "Doe", "password": "jdoe123"}
#res = requests.post('http://localhost/', params=userdata)

#signal for server to train all images on the server into model
res = requests.post("http://gonewhich.thddns.net:7071/index.php", data={'train': 'value'})
print(res.text)