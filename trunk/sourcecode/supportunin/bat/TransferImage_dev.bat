@echo off
SET source="D:\work\back\trunk\src\supportunin\media\images\upload"
SET target="/var/www/html/uploadimage"

cd D:\work\back\trunk\src\supportunin\bat
winscp.com /command "option confirm off" "open root@10.30.9.118" "put "%source%" "%target%"" "exit"

SET source=
SET target=

