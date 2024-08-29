# Create ECS cluster

# ECS cluster name
CLUSTER_NAME='SpiceSavor'
PUBLIC_SUBNET='subnet-043315d65d420599c'
PRIVATE_SUBNET='subnet-08d01af18516d91d9'
MYSQL_SG='sg-0dcab0f3980005e36'
APP_SG='sg-0fc94b5e5f16834b2'
DEFAULT_SG='sg-0af09df3b4de4cdf5'

# Create cluster json output
# CLUSTER_OUTPUT=$(aws ecs create-cluster \
# --cluster-name "$CLUSTER_NAME" \
# --tags key=Environment,value=Production)

# # Cluster ARN
# CLUSTER_ARN=$(echo $CLUSTER_OUTPUT | jq -r '.cluster.clusterArn')

# echo "Cluster $CLUSTER_NAME created with arn: $CLUSTER_ARN"

# # Application register task definition json output
APP_TASK_DEF_OUTPUT=$(aws ecs register-task-definition \
--cli-input-json file://ecs/tasks/app.json)

# # Application task ARN
# APP_TASK_ARN=$(echo $APP_TASK_DEF_OUTPUT | jq -r '.taskDefinition.taskDefinitionArn')

# echo "Mysql task created with arn: $APP_TASK_ARN"

# # Create mysql ecs service
# aws ecs create-service \
# --cluster "$CLUSTER_NAME" \
# --task-definition mysql \
# --enable-execute-command \
# --service-name mysql \
# --launch-type FARGATE \
# --network-configuration "awsvpcConfiguration={subnets=[${PRIVATE_SUBNET}, ${PUBLIC_SUBNET}],securityGroups=[${MYSQL_SG}, ${DEFAULT_SG}],assignPublicIp=ENABLED}" \
# --desired-count 1

# echo "Mysql service created"

# Create application ecs service
aws ecs create-service \
--cluster "$CLUSTER_NAME" \
--task-definition laravel \
--enable-execute-command \
--service-name app \
--launch-type FARGATE \
--network-configuration "awsvpcConfiguration={subnets=[${PRIVATE_SUBNET}, ${PUBLIC_SUBNET}],securityGroups=[${APP_SG},${MYSQL_SG},${DEFAULT_SG}]}" \
--desired-count 1

# echo "App service created"

# # Retrieve app task arn from list tasks command
# APP_TASK_ARN=$(aws ecs list-tasks --cluster "$CLUSTER_NAME" --service-name app)

# echo $APP_TASK_ARN

# # Retrieve database task arn from list tasks command
# DB_TASK_ARN=$(aws ecs list-tasks --cluster "$CLUSTER_NAME" --service-name mysql --query 'taskArns[0]' --output text)

# echo "App task ARN: $APP_TASK_ARN"

# Retrieve application container private IP address
# APP_PRIVATE_IP=$(aws ecs describe-tasks \
# --cluster "$CLUSTER_NAME" \
# --tasks "$APP_TASK_ARN" \
# --query 'tasks[0].attachments[0].details[3].value' \
# --output text)

# echo "App private IP address $APP_PRIVATE_IP"

# DB_PRIVATE_IP=$(aws ecs describe-tasks \
# --cluster "$CLUSTER_NAME" \
# --tasks "$DB_TASK_ARN" \
# --query 'tasks[0].attachments[0].details[3].value' \
# --output text)

# echo "Database private IP address $DB_PRIVATE_IP"

# ECS execute command to execute cli commands in the ECS container
# Prerequisites https://docs.aws.amazon.com/AmazonECS/latest/developerguide/ecs-exec.html
# aws ecs execute-command \
# --cluster "$CLUSTER_NAME" \
# --task "$APP_TASK_ARN" \
# --container app \
# --interactive --command "/bin/sh"