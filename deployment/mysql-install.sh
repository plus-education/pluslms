#!/bin/bash

sudo apt update && sudo apt upgrade -y
sudo apt install mariadb-server -y
sudo systemctl enable mariadb.service --now
sudo mysql_secure_installation

