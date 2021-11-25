import time


count = 1
while True:
    print(count)
    count = count + 1
    time.sleep(0.3)
    if count == 5:
        break

