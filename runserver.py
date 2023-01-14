import os

import pyperclip
import socket

print("Running ON: http://"+str(socket.gethostbyname(socket.gethostname()))+"/")
os.system("start http://"+str(socket.gethostbyname(socket.gethostname()))+" /")
pyperclip.copy(str(socket.gethostbyname(socket.gethostname())))

dataip = socket.gethostbyname(socket.gethostname())
os.system("php artisan serve --host "+dataip+" --port 80")
