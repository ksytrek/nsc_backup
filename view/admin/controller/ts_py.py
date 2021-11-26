import time


count = 1
while True:
    print(count)
    count = count + 1
    time.sleep(1)
    if count == 5:
        break

