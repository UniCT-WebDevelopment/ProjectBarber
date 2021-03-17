# Nicolo' Calcagno - X81000653
# ProjectBarber

<ol>
    <li><a href="#intro">Introduction</a></li>
    <li>
        <a href="#how-to-start">How to start it</a>
    </li>
    <li>
        <a href="#about">About this project</a>
        <ul>
            <li><a href="#folders">Folder structure</a></li>
            <li><a href="#modules">Node modules installed</a></li>
        </ul>
    </li>
    <li><a href="#ref">References</a></li>
</ol>

# <span name="intro">Introduction</span>
<lr>
<span>This is a project realized for the course Web_Programming_Design&Usability of the Computer Science course at the University of Catania.
The intention of the project is to solve the problem that many barbers for a long time have to solve...The reservations!!! bookings that because of the current pandemic are much more recurrent.The reservations!!! reservations that due to the current pandemic are much more recurrent. The project basically tries to automate the booking process for a specific time and for a period of time dependent on the service that you want to book.
The project includes 3 key figures: admin, barber, client.
The admin will be able to manage all the schedules, book or cancel bookings for any barber working in his salon.The reservations!!! reservations that due to the current pandemic are much more recurrent. The project basically tries to automate the booking process for a specific time and for a period of time dependent on the service that you want to book.
The project includes 3 key figures: admin, barber, client.
The admin will be able to manage all the schedules, book or cancel reservations for any barber working in his salon, and add or remove services and barbers.
Each individual barber will be able to manage only his bookings, cancel them, view them or remove them.
While the customer will have the freedom to choose the service, the barber and the day he wants to book. After these choices, the customer will see all the free spaces proportional to the time of the chosen service so there is no overlap, and obviously can view all his bookings and remove them if desired.
</span>

</lr>


# <span name="how-to-start">How to start it</span>
<lr>
Please check the official laravel installation guide for server requirements before you start. <a href="https://laravel.com/docs/5.4/installation#installation">Official Documentation</a>

## Clone the repository

    git clone ...

## Switch to the repo folder

    cd ../projectbarber

## Install all the dependencies using composer

    composer install

## Run the database migrations (Set the database connection in .env before migrating)

    php artisan migrate

## Start the local development server

    php artisan serve

## You can now access the server at http://localhost:8000


## Create an admin account
register with the credentials you want, and in the database change the field "type_user" that will be initially "client" to "admin".

</lr>




# <span name="about">About this project</span>
<lr>

# <span name="folders">Folder structure</span>
<lr>
    This project follows the MVC pattern

    Models:
        app/Models/
            Booking.php (Model for booking)
            Day.php (Model for Day)
            Service.php (Model for Service)
            User.php (Model for User)
    Files of migrations:
        /database/migrations/.
    Views:
        /resources/views/
            adminpanel.blade.php
            bookingpaneladmin.blade.php 
            calendaradmin.blade.php
            hourpaneladmin.blade.php
            login.blade.php
            signup.blade.php
            bookingpanelemployee.blade.php
            calendaremployee.blade.php
            employeepanel.blade.php
            hourpanelemployee.blade.php
            calendar.blade.php
            choicebarber.blade.php
            choiceService.blade.php
            clientpanel.blade.php
            hourpanel.blade.php
    Controllers: 
        /app/Http/Controllers/MainController.php
    Assets:
        public/assets/
            /css/. (all file .css for views)
            /icon/. (all file .icon for view)
            /img/. (all file .img for view)
    Routes: 
        routes/web.php (all routes for requests)
</lr>

# <span name="modules">Node modules installed</span>
<lr>

## The modules installed:

<ul>
    <li>JQuery</li>
</ul>
</lr>


# <span name="ref">References</span>

<lr>
<ul>
    <li><a href="https://laravel.com/docs/8.x">Laravel Official Documentation</a></li>
</ul>

</lr>


</lr># ProjectBarber
# ProjectBarber
# ProjectBarber
