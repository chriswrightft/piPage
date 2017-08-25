# piPage
Raspberry pi page using PHP and docker to run it locally

To build the dockerfile use the below code
```
docker build -t pi-page ~/Documents/repos/piPage/

To run the built image use the below code
```
docker run -p 8080:80 -v ~/Documents/repos/piPage/:/var/www/html -d pi-page
