#!/bin/bash

# Variables
REGION="us-east-2"
ACCOUNT_ID="${AWS_ACCOUNT_ID}"
REPOSITORY_NAME="spicesavor/app"
IMAGE_NAME="inertia-demo-app:latest"
ECR_URI="${ACCOUNT_ID}.dkr.ecr.${REGION}.amazonaws.com/${REPOSITORY_NAME}"
APP_TAG="${ECR_URI}:latest"

# Authenticate Docker to ECR
echo "Authenticating with ECS"
aws ecr get-login-password --region $REGION | docker login --username AWS --password-stdin $ECR_URI

# Tag the Docker image
echo "creating image tag"
docker tag $IMAGE_NAME $APP_TAG

# Push the Docker image to ECR
docker push $APP_TAG
