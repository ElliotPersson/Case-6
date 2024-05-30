# Case-6

This is a CRUD application where you can create, delete and edit different businesses. You can also look at the added businesses but you can only delete or edit the business if you are the owner.

## Before you start

Before you begin, make sure you have the following installed on your computer:

[Git](https://git-scm.com/downloads)
[Docker](https://www.docker.com/products/docker-desktop/)
[Visual Studio Code](https://code.visualstudio.com/)

## Installation

To get started using this application you need to open up visual studio code and open a new terminal and enter following git command: 

git clone https://github.com/ElliotPersson/Case-6.git

After you have cloned the repository you can open the folder called case 6 which contains all the files and folders you need.

When you are in the Case 6 folder you need to open the terminal again and type:

 docker compose up

Once everything has finished loading you should be able to access localhost:8060 to access the application.

Before you can use it you need to make sure that everything from the database is there and is working. To do that you need to type /setup.php right next to localhost:8060 to navigate to setup.php.

Once that is done you will be redirected back to the login screen.

Now everything should work and you should be able to register yourself, log in and create, remove, edit or view businesses and logout.


## Screenshots

![Homepage](app/public/screenshots/Skärmbild%20(11).png)

![Creating business](app/public/screenshots/Skärmbild%20(12).png)

![Business created](app/public/screenshots/Skärmbild%20(14).png)

![View businesses](app/public/screenshots/Skärmbild%20(16).png)