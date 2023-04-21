Basado en:
https://www.digitalocean.com/community/tutorials/how-to-install-and-set-up-laravel-with-docker-compose-on-ubuntu-20-04
https://www.youtube.com/watch?v=w6u8amnFhSo&t=2s
https://www.youtube.com/watch?v=8fbVRBaTkTU
https://www.youtube.com/watch?v=0uG0B5HqiuA

docker-compose build app
docker-compose up -d
docker-compose exec app composer install
docker-compose exec app php artisan queue:table
docker-compose exec app php artisan migrate
docker-compose exec app php artisan make:job SendEmail
docker-compose exec app php artisan make:mail EmailQueue
docker-compose exec app php artisan make:controller EmailController
<!-- docker-compose exec app php artisan queue:work -->
docker-compose exec app php artisan make:command TestTask
docker-compose exec app php artisan schedule:list
<!-- docker-compose exec app php artisan schedule:run -->
docker-compose exec app php artisan places:new Cartagena 10.42 -- -75.52  
docker-compose logs app

# Kubernetes
gcloud auth list
gcloud config set project famous-vista-304216
gcloud container clusters get-credentials cluster-1 --region=us-central1-c

docker build -t laravel-k8s -f Dockerfile-k8s .
docker tag laravel-k8s gcr.io/famous-vista-304216/laravel-k8s:latest
docker push gcr.io/famous-vista-304216/laravel-k8s:latest

kubectl apply -f zk8s/laravel-d.yaml
kubectl apply -f zk8s/laravel-s.yaml
kubectl apply -f zk8s/laravel-i.yaml

---

gcloud config set project valued-range-382821
gcloud container clusters get-credentials k8s-std-dprimero --region=us-central1-c

docker build -t laravel-k8s -f Dockerfile-k8s .
docker tag laravel-k8s gcr.io/valued-range-382821/laravel-k8s:latest
docker push gcr.io/valued-range-382821/laravel-k8s:latest

kubectl apply -f zk8s/nginx-cm.yaml
kubectl apply -f zk8s/laravel-pvc.yaml
kubectl apply -f zk8s/laravel-d.yaml
kubectl apply -f zk8s/laravel-s.yaml
kubectl apply -f zk8s/laravel-i.yaml

kubectl exec -it laravel-app-667c9fbc45-rwhzf -c laravel-app -- /bin/bash

