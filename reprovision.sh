CONTAINERS="worstthings_server_1 worstthings_php1_1"
IMAGES="worstthings_server worstthings_php1"

# Stop and remove all containers
docker stop $CONTAINERS
docker rm   $CONTAINERS

# Destroy all images
docker rmi  $IMAGES

# Recreate the images and containers
docker-compose up -d