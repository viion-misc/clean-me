### Initial findings

```
php clean-me.php
```

> PHP Parse error:  syntax error, unexpected 'name' (T_STRING) in W:\clean-me\clean-me.php on line 62

Super obvious fix, line should be: `$user->get_person_by_last_name();`

Other factors/bugs:
- A lot of random white space
- Function starting { should be on a new line
- There are escape '\' for strings, could use `sprintf`
- Personally prefer PDO over mysqli
- foreach "endforeach", should use { }, same for && vs "and" as it causes illogical truthness (not the "endforeach", the "and" if used), using {} just ensures consistency and PSR compliance.
- [BUG-ISH] Line 65 has @ to silence errors, because it passes "true" when there is no 1st parameter. Never ever ever use @ to silence the application
- Functions are a mix of camelCase and snake_case, should all be camelCase (this includes GetProperties should be getProperties)
- No docblocks, so IDE support is limited
- No return types, no param types
- I'm not a frontend dev and this is pick but `</ td>` to `</td>` remove the spacing
- Hard coded and duplicate mysqli initialising + credentials
- Assuming "User" is a model/entity, it shouldn't have any logic relating to database or any printing logic (eg the table), would use a decorator or service/utility for this
- [BUG] Line 44 has a commented out variable that is expected in the 2 array entries
- The saving of a model and its properties are inconsistent for the usage of the properties, for example the input is done via: `$x->firstName = Y` and the output is done via `$x['first_name']` this mix of camelCase to snake_case can be confusing, should make this a model with `get/set` and let PDO handle creation/reading.
- "save person" and "get person by last name" fall for the great little-bobby-tables (it has a SQL Injection venerability - https://xkcd.com/327/)
- line 68 mix's different ways to output a variable... Stick to a consistent way.
- Assuming there I'm not misunderstand housing/letting terminology, "pets 1" in the getProperties array doesn't make any sense to me
- In the getProperties array I have no idea what the entries are, going to just assuming some property addresses and a property id and a pets condition? Expecting: `<Cottage>, sleeps <num> [people?] <br>`

Running the app:

```
$ php -S localhost:8888 clean-me.php

PeterJohnson
Craster Reach, sleeps 1 
Richard House, sleeps 5 
```

### Database changes

I understand that database changes can some times be 100% off limits, however for this as it's small and I am to demonstrate skill I've made some adjustments to the `db.sql` file for what I think would be a better way to use the table and support better ID generation.

Removed the `auto_increment` from id and changed it to `char(36)` to support UUID.

Created a "Propeties" table for the "Property" model, it's pre-populated through the `db.sql` for now.

```
mysql> describe users;                                          
+-------------+-------------+------+-----+---------+-------+    
| Field       | Type        | Null | Key | Default | Extra |    
+-------------+-------------+------+-----+---------+-------+    
| id          | varchar(36) | NO   | PRI | NULL    |       |    
| prefix      | varchar(30) | NO   |     | NULL    |       |    
| first_name  | varchar(30) | NO   |     | NULL    |       |    
| second_name | varchar(30) | NO   |     | NULL    |       |    
| suffix      | varchar(30) | NO   |     | NULL    |       |    
+-------------+-------------+------+-----+---------+-------+    
5 rows in set (0.00 sec)                                        
                                                                
mysql> describe properties;                                     
+----------------+-------------+------+-----+---------+-------+ 
| Field          | Type        | Null | Key | Default | Extra | 
+----------------+-------------+------+-----+---------+-------+ 
| id             | varchar(36) | NO   | PRI | NULL    |       | 
| number         | int(16)     | NO   |     | NULL    |       | 
| name           | varchar(64) | NO   |     | NULL    |       | 
| number_of_beds | tinyint(2)  | NO   |     | NULL    |       | 
| location       | varchar(64) | NO   |     | NULL    |       | 
| allow_smoking  | tinyint(1)  | NO   |     | NULL    |       | 
| allow_pets     | tinyint(1)  | NO   |     | NULL    |       | 
+----------------+-------------+------+-----+---------+-------+ 
```

# Run:

- mysql import `db.sql`
- run: `composer install`
- modify `app/config.yml`
- run: `php app.php`

Expected result:

```
λ php app.php
Created users
There are 30 users in the database.
Looking for Johnson
Found: Peter Johnson
Getting properties ...
There are 2 properties in the database.
Property Craster Reach, sleeps 1, accepts cats and does not allow smoking.
Property Richard House, sleeps 5, does not allow cats and allows smoking.
```
