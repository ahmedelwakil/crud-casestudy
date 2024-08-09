<p>
    <h1>CRUD Case Study</h1>

## About Project
This project is a small demo for performing CRUD operations on entities.

## Project Deployment

Steps on how to deploy (Make sure docker-compose is installed on your machine):
- Clone project on your local machine
- Open the command line and change the current directory to the project directory
- Create <b>[.env](./.env)</b> file and copy it's content from the <b>[.env.deploy](./deploy-docker/.env.deploy)</b>
- Run Command ```docker-compose up -d```
- Enjoy! :star_struck:

<b>**Note</b> The deployment seeds the database automatically. Please refer to the <b>[run.sh](./deploy-docker/run.sh)</b> bash file. It contains the commands that the docker container executes after creating the container. 

<b>**Note</b> Authentication uses the [jwt-auth](https://github.com/tymondesigns/jwt-auth) composer package. 

The project will install 3 docker containers:
- **MySQL Container**
- **Redis Container**
- **Laravel Application Container**

To access any of the containers run ```docker exec -it {container-name} bash```. Please refer to the [docker-compose.yaml](./docker-compose.yaml) file for all container details especially container ports.

To Run Unit Tests:
- Access the Application Container ```docker exec -it foodics-api bash```
- Run the tests command ```./vendor/bin/phpunit```
- The testing environment uses on SQL Lite and runs in memory

## What is Implemented
- Repository Architecture using Abstract Factory Design Pattern for rapid development of CRUD operations for entities. 
- Docker Containers & Deployment (Application Container - Database Container)
- Application Configuration
- Database Design & Data [Migrations](./database/migrations)
- Supervisor & Queue worker for managing background jobs
- [Factories](./database/factories) & [Seeders](./database/seeders)
- Clean Code
  - Custom [Exceptions](./app/Exceptions)
  - Entities [Controllers](./app/Http/Controllers)
  - Entities [Services](./app/Services)
  - Entities [Repositories](./app/Repositories)
  - Entities [Models](./app/Models)
  - Constant [Utility Classes](./app/Utils)
- Readme [File](./README.md)

## Project Architecture

**Repository Architecture using Abstract Factory Design Pattern**

This architecture consists of 3 separated layers as follows:
- **Controller Layer**: Gather data from request, performs validation and pass user input data to service.
- **Service Layer**: The middleware between controller and repository. It is responsible for gathering data from controllers, performing business logic, and calling repositories for data manipulation.
- **Repository Layer**: Layer for interaction with models and performing DB operations.

This provides a clear separation of responsibilities and achieve many degrees of the **SOLID Principles** which reduces dependencies and make the project better in readability, maintainability, design patterns, and testability.


Each of this layer is implemented using **Abstract Factory Design Pattern** which provides the common operations in an abstract class that can be extended. 
- [BaseRepository](./app/Repositories/BaseRepository.php) implementing the [RepositoryInterface](./app/Repositories/RepositoryInterface.php) 
- [BaseService](./app/Services/BaseService.php) implementing the [ServiceInterface](./app/Services/ServiceInterface.php)
- [BaseController](./app/Http/Controllers/BaseController.php) implementing the [ControllerInterface](./app/Http/Controllers/ControllerInterface.php)

Each respective class then extends the BaseClass and the objects are binded in the [AppServiceProvider](./app/Providers/AppServiceProvider.php)
