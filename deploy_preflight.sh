#!/bin/bash

# Stop local Instances
cd /workspaces/domain-forwarder/src && bash ./vendor/bin/sail down

# Compress Credentials Folder
./@secret_credentials/zip-credentials.sh 

# Copy .env files
cp ./@secret_credentials/env.cloudrun ./src/.env

echo Ready to deploy...