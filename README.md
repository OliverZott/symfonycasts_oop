OOP
===============================================
https://symfonycasts.com/screencast/oo

Setup
-----

Start the built-in web server and open site

```bash
cd /path/to/the/project
php -S localhost:8000
```

```
http://localhost:8000
```

Content - Course 1
-------

* Type hints with Class name before Argument
* **__DIR__** to find current path
  * `__DIR__./path_name/file_name.php`
* **Access modifiers**
  * public, private
  * setter / getter 
  
* **Type Hinting** ...to get:
  * Better error Messages
  * Method recommendations / previews
  
* **Constructors**
  * `__construct`

**Summary:** Create Class if...
   + ...store data
   + ...need function to do stuff


Content - Course 2
-------
* **Service Classes** (e.g. 'BattleManager')
    * store services for classes 
    * are classes themselves
    * avoid "flat functions"!
  
*  Create Class if **passing around associative array of data**
    * Class for return values of battle outcome

* Objects are passed/called by **reference**! (Course 5)
* Arrays / string passed to function pass a **copy**
    * **&** ...possible to **call-by-reference** using `&$var` 














