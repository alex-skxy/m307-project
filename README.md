# m307-project

## Sitemap

| Name   | Route   | Inhalt                                      |
|--------|---------|---------------------------------------------|
| Home   | /       | navigation (links to the list and creation) |
| List   | /list   | list loans                                  |
| Create | /create | creation of loans                           |
| Edit   | /edit   | editing/updating loans                      |

## Sitemap
## Formulars
## Validation
### Create - From
| Filename | Route| 
|--------|---------|
| name   | not empty, no special characters, no whitespaces, no numbers |
| rename | not empty, no special characters, no whitespaces, no numbers  |
| e-mail | not empty, valid e-mail |
| phone | not empty, only numbers, no whitespaces |
| amount installments | not empty, only numbers, no whitespaces, no numbers |
| loan package | not empty, only numbers, no whitespaces, no numbers |

### Edit - From
| Filename | Route| 
|--------|---------|
| name   | not empty, no special characters, no whitespaces, no numbers |
| rename | not empty, no special characters, no whitespaces, no numbers  |
| e-mail | not empty, valid e-mail |
| phone | not empty, only numbers, no whitespaces |
| loan package | not empty, only numbers, no whitespaces, no numbers |
| status | ????? |

## Database

###person
| field-name | datatype | 
|--------|---------|
| id_person | INT, PRIMARY KEY, A.I |
| name | Varchar(30), NOT NULL |
| lastname | Varchar(30), NOT NULL |
| e-mail | Varchar(30), NOT NULL |
| instalments | INT, NOT NULL |
| fk_creditpackages_id | INT, FOREIGN KEY, NOT NULL |
| paid_back | BOOL, NOT NULL, DEFAULT = false |
| start_date | Datetime, DEFAULT = NOW |

###loan
| field-name | datatype | 
|--------|---------|
| id_creditpackages | INT, PRIMARY KEY, A.I | 
| name | Varchar(50), NOT NULL | 

## Test cases
Project for ÜK Modul 307
