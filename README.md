# Semestrální práce z WEB 2018 Tréninkový deník
**Popis zadání**
-   Uživateli systému jsou cvičence (autoři svých vlastních tréninků), treneři (sestavuje nabídku cvičení) a administrator (přiřazují role). Každý uživatel se do systému přihlašuje prostřednictvím vlastního uživatelského jména a hesla. Nepřihlášený uživatel vidí pouze uvodní stranku.
-   Nový uživatel se může do systému zaregistrovat, čímž získá status cvičence . 
-   Přihlášený cvičenec vidí své treninky. Může je přidávat, editovat.
-   Přihlášený trener ještě navíc může sestavovat nabídku treninků.
-   Přihlášený administrátor rozhoduje o přiřazování roli trenera uživatelům, které si o to požadalí. 

**`Olesya Dudchuk|A17B0638P|`**
E-mail:  [olesya@students.zcu.cz](mailto:olesya@students.zcu.cz)

[https://github.com/olesya25/www_dudchuk](https://github.com/olesya25/www_dudchuk)

## Popis použitých technologií
Vytvořila jsem webovou stránku tréninkový deník. Web dodržuje MVC architekturu. Použila jsem pro práci s databázi PDO. A místy jsem použivala JavaScript a knihovnu jQuery. Web obsahuje responzivní design (pomocí nástroje Bootstrap) a ošetření proti základním typům útoku (htmlspecialchars(), neobsahuje $_GET..).

## Popis adresářové struktury aplikace

### core

 - **Application.php**
 Třida umožní nastavít aplikace v režimu debuggeru. Nastavít se dá v souboru configurations.php ( DEBUG = true). 
 - **Controller.php**
 Třida **Controller** dědí od třidy **Application**, a je hlavní třida, od které dědí vsechné třidy typu **Controller**. V konstruktoru se vytvoří instance třidy **View**, která umožní posilání zpracovaných požadavků od uživatele na obrazovku.
 - **Cookie.php**
 Třida obsahuje pouze statické metody, které umožní manipulace s cookies uživatele, tj ukládat, mázat a pod.
 - **DB.php**
   Třida je typu Singleton, takže instance třidy lze vytvořit pouze jednou. V konstruktoru se nastaví připojení k databazi. Instance třidy **DB** je  atributem třidy **Model**. Metody třidy slouží pro prací s databazi. 
 - **Input.php**
Třida obsahuje pouze statické metody. Dovolujé snadno ošetřovat vstupní anebo vystupní data od uživatelů.
 - **Model.php**
**Model** je hlavní třida od které dědí všechné třidy typu **Model**. Použivá většinu metod třidý **DB**, instance které získává v konstruktoru. Rozdil je ten, že v konstruktoru se přimo nastaví název tabulky databazi, se kterou budemé pracovat a dal již použivá **$this->table**, tím padem není potřeba uvádět název pokáždě, když toho vyžaduje prototyp metody **DB**.
 - **Router.php**
 Rozcestník. Čté url adresu, a intepretujé ji tím způsobém, že první element je název Controlleru, druhý Action a všechny elementy co nasledujou potom, jsou argumenty metody. Argumentů může být víc než jeden, ale nejsou povinné.
 - **Session.php**
Třida obsahuje pouze statické metody, které umožní manipulace se session uživatele, tj ukládat, mázat a pod.
 - **Validate.php**
Slouží pro ošetřování kontrolu spravně zadaných vstupů od uživatele, při vyplnování různých formulařů. 
 - **View.php**
 Třida se stará o načtení souboru obsahujicí view, o které se požádá v přislušném kontrolleru.



### app
V adresáři se nachází controllers, models a views. 
#### controllers
Všechny třidy dědí od třidy **Controller**, která je v adresaří **core**
 - **Dashboard.php**
Kontroller je dostupný pouze pro admina. Obsahuje metody pro zobrazení tabulky s daty o uživatelích. Taky obsahuje metodu pro přiřazování roli trenera uživatelům.
 - **Diary.php**
 Kontroller je dostupný pro cvičence a trenera, ale není dostupný pro admina. Umožnujé manipilace s deníkém, tj. přidávat, měnít a prohližet treniky.
 - **Home.php**
Domácí stránka uživatelů. Liší se v závislosti na roli.  
 - **Register.php**
Kontoller se stará o registrací, přihlašování a odhlašování uživatelů.
 - **Restricted.php**
 Na tento kontroller je přesměrováný uživatel v připadě, že se pokusil nahrát stranku, do které nemá přistup.

#### library/helpres
Adresář obsahuje soubory, s pomocnými metodami

 - **download.php**
 Umožňuje stahoání souboru.
 - **functions.php**
 - **helpers.php**
 Obsahuje pomocné metody např.  **dump_die()** pro debugování, **currentUser()** pro ziskání objektu pravě přihlašenýho uživatele apod.

##### 
#### models
Všechny třidy dědí od třidy **Model**, která je v adresaří **core**
 - **Category.php**
 Model pracuje s tabulkou  'category'
 - **CategoryDrill.php**
  Model pracuje s tabulkou 'category_drill'
 - **Drill.php**
Model pracuje s tabulkou 'drill'
 - **Role.php**
Model pracuje s tabulkou 'role'
 - **Training.php**
Model pracuje s tabulkou 'training'
 - **TrainingDrill.php**
Model pracuje s tabulkou 'training_drill'
 - **Users.php**
Model pracuje s tabulkou 'users'
 - **UserSession.php**
Model pracuje s tabulkou 'user_session'
 

#### views
Struktura adresaře **views** je taková, že každý podadresář je pojmenován podle kontrolleru, který používá sadu pohledů. Potom každy dokumnet v podadresáři je pojmenován podle metody, která dáný pohled využivá. Dokumenty obsahují html, php a místy i JavaScript spolu s jQuery.

##### dashboard

 - assignrole.php
 - dashboard.php

##### diary

 - adddrill.php
 - createtraining.php
 - diary.png
 - drills.php
 - mydiary.php

##### home

 - adminindex.php
 - coachindex.php
 - coachrequest.php
 - index.php
 - userindex.php
##### layouts
 - chris.png
 - default.php
 - main_menu.php

##### register

 - login.php
 - register.php

##### restricted

 - index.php

##### acl.json
Obsahuje informaci o tom, do kterých stránek které uživatele mají dostup.
##### menu_acl.json
Obsahuje informaci o tom, jake položky mají uživatele, podle roli v hlavním menu. 

### config

 - **configuration.php**
Deklarace konstant. 

### css

 - **bootstrap.min.css**
 Rezponzivní design

 - **custom.css**
Vlastní design

### fonts
Různá písma.
### javascript

 - **bootstrap.min.js**
 Bootstrap javascript
 - **jQuery-2.2.4.min.js**
 Knihovna jQuery
### uploads
Soubory od uživatelů, které poslalí požadavek být trenerem. Obsahují životopis.
 - #### .htaccess
 Sys soubor pro nastaveni WEB serveru
 - #### index.php
  Hlávní soubor WEBu
 - #### README.md
 Dokumentace (md)
 - #### workout_diary (1).sql
Sql soubor s databazi
