<?php
class page{

    private $pdo;
    private $content;
    function __construct()// конструктор класса
    {
        $this->dbcon();//создаем подключение к локальному серверу и базам данных через PDO

        $this->router();//функция которая определяет нужную нам функцию


        $this->out();//функция вывода пользователей на экран
    }

    function router(){//благодаря условным операторам смотрим на какую страницу переходим в url

        if (isset($_GET["reg"])){

            $this->reg();

        }
        elseif (isset($_GET["add"])){

            $this->add();

        }
        elseif (isset($_GET["edit"])){

            $this->edit();

        }
        elseif (isset($_GET["saveinfo"])){

            $this->saveinfo();

        }
        elseif (isset($_GET["del"])){

            $this->del();

        }
        else{
            $this->showlist();

        }

    }

    function edit(){
        $sql = "select * from  `accounts`  where `ID`=:id ";//создаем запрос в БД для определения нужного нам аккаунта для дальнейшего редактирования
        $load_account=$this->pdo->prepare($sql);//определяем аккаунт
        $load_account->execute(array("id"=>$_GET["edit"]));//загружаем аккаунт для редакции

        if ($row = $load_account->fetch()){//проверяем загрузили ли мы аккаунт в переменную


            $tmpl = file_get_contents("html/edit.html");//выгружаем на страницу форму для редактирования из файла edit.html


            foreach ($row as $key => $value){// с помощью ассоциативного массива редактируем содержание полей путем замены изначального содержания на то,которое мы редактировали

                $tmpl = str_replace("{[".$key."]}",$value,$tmpl);


            }

            $this->content.=$tmpl;//выгружаем редактированный аккаунт


        }
        else{//если мы не нашли нужного для редактированния аккаунта-выходим в корневой файл сайта
            header("Location: /");
        }



    }




    function  del(){
        $sql = "update `accounts`set `del` =1 where `ID`=:id ";//честно говоря мы не удаляем аккаунт полностью,он остается в БД,мы просто маркеруем
        $upd_account=$this->pdo->prepare($sql);// его единицей,а затем при выводе мы просто не выводим на экран аккаунты с единицей в поле del
        $upd_account->execute(array("id"=>$_GET["del"]));
        header("Location: /");
    }

    function saveinfo(){//функция для сохранения данных введенного аккаунта с сайта в БД через PDO

        try{

            if(empty($_POST['First_name'])) exit("Поле First name не заполнено");//выводим ошибку пользователю из-за незаполнения обязательных полей
            if(empty($_POST['Last_name'])) exit("Поле Last name не заполнено");
            if(empty($_POST['Email'])) exit("Поле Email не заполнено");





            $sql = "update  `accounts` set `First_name` = :First_name, `Last_name` = :Last_name, `Email` = :Email, `Company_name` = :Company_name, `Position` = :Position, `Mobile_Phone` = :Mobile_Phone, `Home_Phone` = :Home_Phone, `Additional_Phone` = :Additional_Phone where `ID` =:id";//создаем запрос БД для сохранения в ее конкретные поля наше содержание,а так же даем каждому аккаунту свой ID
            $upd_account=$this->pdo->prepare($sql);
            $upd_account->execute(array(//заполняем поля в БД введенными пользователем значениями
                "First_name"=>$_POST["First_name"],
                "Last_name"=>$_POST["Last_name"],
                "Email"=>$_POST["Email"],
                "Company_name"=>$_POST["Company_name"],
                "Position"=>$_POST["Position"],
                "Mobile_Phone"=>$_POST["Mobile_Phone"],
                "Home_Phone"=>$_POST["Home_Phone"],
                "Additional_Phone"=>$_POST["Additional_Phone"],
                "id"=>$_GET["saveinfo"]
            ));


            header("Location: /");
        }
        catch(PDOException $exception)//если что-то пошло не так-выводим ошибку на экран
        {
            $this->content.= $exception->getMessage();
        }


    }



    function add(){//функция для занесения введенного аккаунта с сайта в БД через PDO

        try{

            if(empty($_POST['First_name'])) exit("Поле First name не заполнено ");//выводим ошибку пользователю из-за незаполнения обязательных полей
            if(empty($_POST['Last_name'])) exit("Поле Last name не заполнено");
            if(empty($_POST['Email'])) exit("Поле Email не заполнено");





            $sql = "INSERT INTO `accounts` (`First_name`, `Last_name`, `Email`, `Company_name`, `Position`, `Mobile_Phone`, `Home_Phone`, `Additional_Phone`) //создаем запрос БД для добавления в ее конкретные поля наше содержание
                    VALUES ( :First_name, :Last_name, :Email, :Company_name, :Position, :Mobile_Phone, :Home_Phone, :Additional_Phone)";
            $new_account=$this->pdo->prepare($sql);
            $new_account->execute(array(//заполняем поля в БД введенными пользоввателем значениями
                "First_name"=>$_POST["First_name"],
                "Last_name"=>$_POST["Last_name"],
                "Email"=>$_POST["Email"],
                "Company_name"=>$_POST["Company_name"],
                "Position"=>$_POST["Position"],
                "Mobile_Phone"=>$_POST["Mobile_Phone"],
                "Home_Phone"=>$_POST["Home_Phone"],
                "Additional_Phone"=>$_POST["Additional_Phone"]
            ));

            header("Location: /");
        }
        catch(PDOException $exception)//если что-то пошло не так-выводим ошибку на экран
        {
            $this->content.= $exception->getMessage();
        }


    }

    function reg (){//перенаправляем пользователя на страницу с формой регистрации аккаунта

        $this->content .= file_get_contents("html/reg.html");

    }


    function showlist(){//функция для транслирования контента на сайте

        $cnt = 10;//кол-во аккаунтов на 1 странице
        $fst = 0;//первый выведенный на странице аккаунт

        $p=1;


        $query = $this->pdo->query('SELECT count(`id`) as `cnt` FROM `accounts` where `del` =0');//запрос на БД осуществляющий трансляцию всех аккаунтов из БД кроме тех у которых в поле del стоит 1
        $row = $query->fetch();
        $ttlcnt = $row["cnt"];

        $ttlpages = intval($ttlcnt/10);//ищем количество полных страниц(страниц с 10 аккаунтами)
        if (intval($ttlcnt)%10){//если у нас все страницы переполнены аккаунтами,а аккаунты еще есть-создаем для них новую страницу
            $ttlpages++;
        }

        if (isset($_GET["page"])){//если мы уже находимся на какой-то странице
            $p = $_GET["page"];
        }
        $fst = ($p-1)*$cnt;//первый выведенный на странице аккаунт

        $pgntion ="";//объявляем переменную

        for ($i=1;$i<=$ttlpages;$i++){//определяем страницу на которой мы находимся активной
            $sact="";//объявляем переменную
            if ($i==$p){
                $sact = "active";
            }
            $pgntion.= "  <li class=\"page-item $sact\"><a class=\"page-link\" href=\"/?page=".$i."\">".$i."</a></li>\n";//задаем переменной значение кнопки паджинации "активная страница"
        }

        $pprev ="";//объявляем переменную
        if ($p>1){
            $pprev =" <li class=\"page-item\"><a class=\"page-link\" href=\"?page=".intval($p-1)."\"><<</a></li>";//задаем переменной значение кнопки паджинации "предыдущая страница"

        }
        $pnxt ="";
        if ($p<$ttlpages){


          
            $pnxt =" <li class=\"page-item\"><a class=\"page-link\" href=\"?page=".intval($p+1)."\"> >> </a></li>";//задаем переменной значение кнопки паджинации "следующая страница"

        }

        $pagination ="
        
        <nav aria-label=\"Page navigation example\">
  <ul class=\"pagination\">
   $pprev    //выводим на сайт кнопку паджинации \"предыдущая страница\"
    $pgntion   //выводим на сайт кнопку паджинации \"активная страница\"
   $pnxt    //выводим на сайт кнопку паджинации \"следующая страница\"
  </ul>
</nav>
        ";



        $this->content =  '<ul>';
        $query = $this->pdo->query('SELECT * FROM `accounts` where `del` =0 ORDER BY `id` DESC limit '.$fst.','.$cnt);//запрос на БД осуществляющий трансляцию всех аккаунтов из БД кроме тех у которых в поле del стоит 1,а так же принимает значения первого аккаунта на странице и количества аккаунтов выводимых на странице
        while($row = $query->fetch())//проверяем пуста ли переменная с запросом
        {
            $this->content.= '<li class="spisok"><b>'.$row["First_name"]. ' '.$row["Last_name"].' '.$row["Email"].' '.$row["Company_name"].' '.$row["Position"].' '.$row["Mobile_Phone"].' '.$row["Home_Phone"].' '.$row["Additional_Phone"].'</b>//заполняем в переменную аккаунты на сайт в виде списка 
<div class="btn-group">//создаем группу кнопок с кнопками изменить и удалить которые переносят нас на нужные страницы
<a href="/?del='.$row["ID"].'" onclick="return confirm(\'Вы действительно хотите удалить пользователя?\')"><button>Удалить</button></a>
<a href="/?edit='.$row["ID"].'"><button>Изменить</button></a>
</div>
';
        }
        $this->content.= '</ul>';
        $this->content.= $pagination .'<a class="btn btn-success" href = "/?reg">Добавить пользователя</a>';//заполняем переменную кнопкой добавить пользователся с ссылкой на нужную страницу




    }

    function out(){

        $tmpl = file_get_contents("html/page.html");

        $tmpl = str_replace("{[content]}",$this->content,$tmpl);//меняем местами метку {[content]} с нашими аккаунтами и кнопками

        echo $tmpl;//выводим все аккаунты с кнопки на страницу


    }

    function dbcon(){//создаем подключение к БД через PDO


        $type="mysql";
        $host="localhost";
        $base="database";
        $user="root";
        $pasw="";

        $dsn = $type.":host=".$host.";dbname=".$base;
        $opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        );
        $this->pdo = new PDO($dsn, $user, $pasw, $opt);



    }


}