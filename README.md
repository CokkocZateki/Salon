# _HAIR SALON LISTING_

##### An app to display and edit lists of Stylists and their Clients, 21-Aug-2015_

#### By _**Rick Hills**_

## Description

An app to add and edit lists of Stylists and their Clients.  

## Setup

* _Clone this repository_
* _Run composer install in project folder_
* _Unzip hair_salon.sql and import to MySQL database_
* _Start PHP server in web folder_
* _Navigate web browser to localhost:8000_

MySQL Commands used, as per class instructions:
-------------------------------------------------------------------------------
mysql> create database hair_salon;
Query OK, 1 row affected (0.00 sec)

mysql> use hair_salon;
Database changed
mysql> create table stylists(name varchar(255), id serial PRIMARY KEY);
Query OK, 0 rows affected (0.08 sec)

mysql> create table clients(client_name varchar(255), stylist_id int, id serial);
Query OK, 0 rows affected (0.07 sec)

mysql>

## Technologies Used

_PHP, Twig, Silex, PHPUnit, MySQL, HTML, Bootstrap, CSS_

### Legal

Copyright (c) 2015 **_Rick Hills_**

This software is licensed under the MIT license.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
