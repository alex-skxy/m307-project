# m307-project

## Sitemap

| Name   | Route   | Inhalt                                      |
|--------|---------|---------------------------------------------|
| Home   | /       | navigation (links to the list and creation) |
| List   | /list   | list loans                                  |
| Create | /create | creation of loans                           |
| Edit   | /edit   | editing/updating loans                      |

## Forms

### Create

![create](doc/create.png)

### edit

![edit](doc/edit.png)

## Validation

### Create - From

| Filename | Route| 
|--------|---------|
| name   | not empty, no special characters, no numbers |
| lastname | not empty, no special characters, no numbers  |
| e-mail | not empty, valid e-mail |
| phone | not empty, only numbers and + |
| amount installments | not empty, only numbers (integer), no whitespaces, 1-10 |
| loan package | not empty, only values from the list of available loan packages  |

### Edit - From

| Filename | Route| 
|--------|---------|
| name   | no
| name   | not empty, no special characters, no numbers |
| lastname | not empty, no special characters, no numbers  |
| e-mail | not empty, valid e-mail |
| phone | not empty, only numbers and + |
| loan package | not empty, only numbers, no whitespaces, no numbers |
| status | boolean: true - the loan has been fully repaid, false - the loan has not been repaid yet |

## Database

### person

| field-name | datatype | 
|--------|---------|
| id_person | INT, PRIMARY KEY, A.I |
| name | Varchar(100), NOT NULL |
| lastname | Varchar(100), NOT NULL |
| e-mail | Varchar(100), NOT NULL |
| instalments | INT, NOT NULL |
| fk_creditpackages_id | INT, FOREIGN KEY, NOT NULL |
| paid_back | BOOL, NOT NULL, DEFAULT = false |
| start_date | Datetime, DEFAULT = NOW |

### loan

| field-name | datatype | 
|--------|---------|
| id_creditpackages | INT, PRIMARY KEY, A.I | 
| name | Varchar(50), NOT NULL | 

## Test cases

Project for ÜK Modul 307
