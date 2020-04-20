OOP
===============================================
https://symfonycasts.com/screencast/oo

Setup
-----

Start local Apache web-server (stop first in case)
```bash
sudo /etc/init.d/apache2 status

sudo /etc/init.d/apache2 stop 

sudo /opt/lampp/lampp start
```

Start the built-in web server and open site
```bash
cd /PhpstormProjects/symfonycasts_oop

php -S localhost:8000
```

```
http://localhost:8000
```
## Table of Contents
1. [OOP Basics](#basics)
2. [Models, Services & Containers](#oop2)
   
    i. [Service Classes](#services) \
    ii. [Fetching objects from db](#db) \
    iii. [Single PDO / db connection](#pdo)  
    iv. [Service Container](#servicecontainer)  
    v. [Remarks - Dependency Injection](#remarks)   

3. [Inheritance, Abstract Classes, Interfaces](#oop3)

4. [Static methods, Namespaces, Exceptions & Traits](#oop4)

    i. [Constants](#const) \
    ii. [Static](#static) \
    iii. [](#pdo)  
    iv. [](#servicecontainer)  
    v. [](#remarks)   

# OOP Basics <a name="basics"></a>


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


# Models, Services & Containers <a name="oop2"></a>

## **Service Classes** <a name="services"></a>
(Chapter 1 -4; e.g. 'BattleManager')

* **Service Class**: 
    * "create object just once, if need to use method"
    * class whose main job is to do work
* store services for classes 
* are classes themselves
* avoid "flat functions"!
* Create Class if **passing around associative arrays of data**
    (e.g. Class for return values of battle outcome)

## **Fetching objects from db** <a name="db"></a>


* Objects are passed/called by **reference**! (Course 5)
* Arrays / string passed to function pass a **copy**
    * **&** ...possible to **call-by-reference** using `&$var` 

* Get Object by **single ID from db** (chapter 7): 
    * `@return Ship[]`   ...return value to ensure code-completion!!
    
## **Single PDO / db connection** <a name="pdo"></a>


* **Model Class - Properties**:
    * hold data about object
* **Service Class - Properties**:
    * hold options how class **behaves**
    * hold other **tools** (e.g. PDO Object)

## Best Practice: *Centralizing Configuration* (Dependency Injection)
**Goal**: Database configuration at **central location** (to reuse it!)
* Situation:    
    * `ShipLoader.php` is a Service Class
    * `PDO` is a Service Class

* **DON'T** ...
    * ... put configurations inside a service class!
    * ... just move config to other file and use **global**

* **DO** ...
    * ... use configuration as argument to a service class!
    * ... pass information to service class ( **__construct** )
   
PDO Object is a **Dependency**!
 
PDO object is passed to a service -> **Dependency Injection**

**Problem**: PDO service-object is configurable but created inside Loader service-class!

## Best Practice: *Centralizing Connection*
**Goal**: Outsource `new PDO()`, so every class / table can use it)

* **DON'T** ...
    * ... create new service object in a service
* **DO** ...
    * ... create service object (**pdo**) outside service class (**shiploader**)
    * ... pass information to service class ( **__construct** )

```
public function __construct(PDO $pdo)
{
    ...
}
```

**Problem**: Code to create service object `new PDO()` is duplicated and complicated

## Service  Container <a name="servicecontainer"></a>
**GOAL**: Special Class to create service-objects 

+ Used **Service-Classes**:
    + PDO
    + ShipLoader
    + BattleManager

+ All Service-Objects used in `Container.php`
+ All Service-Objects initialized using **Singleton-Pattern** (Lazy-Implementation?!)
https://en.wikipedia.org/wiki/Singleton_pattern

+ **QUESTION**: 
    + Better instantiate private service objects in container with `null` ???
    + When us `private static` for  Singleton-implementation ???



## Remarks: DEPENDENCY-INJECTION-Container: <a name="remarks"></a>
https://symfonycasts.com/screencast/oo-ep2/container-rescue#play

**Model-Objects**: Hold data / don't do much work / created when-where ever needed

**Service-Object**: Do work / 

Idea:
+ Configuration / Service-Objects NEVER hardcoded in Service-Classes
+ Move Configuration / Service-Objects OUTSIDE and pass through Constructor
+ Container Class does all work regarding all Service-Objects (Objects that does work)!

Benefits:
+ create all Service-Objects centralized
+ 

**Properties**

+ Model-Class Properties / Service-Class Properties

***Dependency Injection*** & ***Singletons***

+ **Configs** 
    + ... centralized (this case: `function.php`) 
    + ... passed to `__cocnstruct` private (static?)

+ **Service Objects** 
    + ...centralized (this case: `Container.php`) 
    + ...created in special Service-Class
    + ...passed to `__cocnstruct` private (static?)

+ **Container Class**
    + ...creates EVERY Service-Object
    + ...**Singleton-Pattern**

***Symfony / Composer***

+ Handle all **Dependency Injections** as well as all **Singletons**

# Inheritance, Abstract Classes, Interfaces <a name="oop3"></a>

## Inheritance 
`extends`

## Override & Access-Modifiers
public, protected, private  (compare scopes)

## Abstract Classes
Cannot be instantiated

## Interfaces
Abstract vs. Interfaces 
+ AbstractShip.php contains **logic**
+ AbstractShipStorage only **ensures specific functions**  
+ Classes can implement many interfaces, but can only extend one class
+ Abstract classes CAN contain concrete methods, interfaces CANNOT
+ Interfaces AND Abstract classes FORCE to implement the methods

If no logic --> use **Interface**

+ Interface flexibility especially for reusable **libraries**
+ in most projects maybe no use for interfaces ?!

# Static methods, Namespaces, Exceptions & Traits <a name="oop4"></a>

## Constants <a name="const"></a>
+ Constants are **static** --> No object instantiation needed, only `Classname::` or `self::`    

Use CONSTANTS if variable:
+ never change
+ has special meaning
+ is used multiple times?
+ is used from outside of the class?
+ If someone makes a minor typo, will the result be drastically different?
+ Is it important for us to have a list of all of these possible values in one spot

Advantage:
+ put variable into context (class related)
+ centralized (if change -> only once)

Example:
+ `public const ...` in *BattleManager.php* and **

## Static <a name="static"></a>
Use static methods for "global" function which doesn't depend on instances.

Example:
+ `public static function getAllBattleTypesWithDescription() {...` in *BattleManager.php* and *index.php*
