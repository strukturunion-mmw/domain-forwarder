#!/bin/bash

# Compress Credentials Folder
./@secret_credentials/zip-credentials.sh 

# Copy .env files
cp ./@secret_credentials/env.cloudrun ./src/.env

echo Ready to deploy...