@echo off
SET source="d:\Soft\xamp\xampp\htdocs\SupportUnin\uploadconfig"
SET target="/var/www/html/ppamf/configs"
SET sourcexml="d:\Soft\xamp\xampp\htdocs\SupportUnin\uploadxml"
SET targetxml="/var/www/html/projectp/ob266/localdata/config"

cd d:\Soft\xamp\xampp\htdocs\SupportUnin\bat
winscp.com /command "option confirm off" "open root@10.30.9.118" "put "%source%" "%target%"" "exit"
winscp.com /command "option confirm off" "open root@10.30.9.118" "put "%sourcexml%" "%targetxml%"" "exit"

SET source=
SET target=
SET sourcexml=
SET targetxml=

