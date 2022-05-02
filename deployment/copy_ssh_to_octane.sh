#!/bin/bash

FROMUSER=azureuser
TOUSER=octane

sudo mkdir /home/$TOUSER/.ssh
sudo chmod 700 /home/$TOUSER/.ssh
sudo cp /home/$FROMUSER/.ssh/authorized_keys /home/$TOUSER/.ssh/authorized_keys
sudo chown -R $TOUSER:$TOUSER /home/$TOUSER/.ssh
sudo chmod 600 /home/$TOUSER/.ssh/authorized_keys