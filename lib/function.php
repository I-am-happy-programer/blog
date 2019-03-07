<?php

				
function checkreg(){
	if (isset($_SESSION['userName'])&& !empty( $_SESSION['userName'])){
        return $_SESSION['userName'];
        
    }else{
        return false;
    }

	if (isset($_SESSION['auth']))
	 {
	 	echo 'good';
		//require('../index.php');
		}	
		else
		{
			echo 'loh';
		}
	
}
function logIn(){
	
    if (isset($_POST['btnLogin'])){
    	unset($_SESSION['userName']);
        $login=$_POST['login'];
        $password=$_POST['password'];
        $search =   "'";
        $replace = "";
        $link = mysqli_connect(
            'localhost',  /* Хост, к которому мы подключаемся */
            'homestead',       /* Имя пользователя */
            'secret',   /* Используемый пароль */
            'db-test');     /* База данных для запросов по умолчанию */
        $str="SELECT id FROM user_table WHERE login = '".str_replace($search, $replace, $login)."' AND password = '".str_replace($search, $replace, $password)."'";
        
        $result = mysqli_query($link, $str);
        $row_cnt = $result->num_rows;
        //print_r($result);exit;
        if ($row_cnt == 1)
        {
           
            $_SESSION['userName']=str_replace($search, $replace, $login);
            //$ebat = "SELECT verify FROM user_table WHERE login = '".$_SESSION['userName']."'";
           // $isverify = mysqli_query($link, $ebat);
          //  $_SESSION['isverify'] = $isverify;
           header("Location: ../index.php");
			exit;
        }
        else{
            echo 'Неверный логин или пароль';	
        }
    }

}
function showmain()
{
                    R::setup( 'mysql:host=localhost;dbname=db-test','homestead', 'secret' ); 
                $news= R::findAll( 'news' );
                foreach ($news as $new) {
                    showMinNews($new['id'],$new['title'],$new['stext'],$new['ftext']);
                    }
}
function RegIn(){
	
    if (isset($_POST['btnReg'])){
    	unset($_SESSION['userName']);
        $login=$_POST['login'];
        $password=$_POST['password'];
        $email = $_POST['email'];
        $search =   "'";
        $replace = "";
        $code = rand(1000000,9000000);
        $verify = "false";
        $link = mysqli_connect(
            'localhost',  /* Хост, к которому мы подключаемся */
            'homestead',       /* Имя пользователя */
            'secret',   /* Используемый пароль */
            'db-test');     /* База данных для запросов по умолчанию */
        $str="SELECT id FROM user_table WHERE login = '".$login."' OR email = '".$email."'";
        $regin="INSERT INTO `db-test`.`user_table` (`login`, `password`, `email`, `code`, `verify`) VALUES ('".$login."', '".$password."', '".$email."', '".$code."', '".$verify."');";
        
        $result = mysqli_query($link, $str);
        $row_cnt = $result->num_rows;
        //print_r($result);exit;
        if ($row_cnt == 0)
        {
           mysqli_query($link, $regin);
           header("Location: ../index.php");
			exit;
        }
        else
        {
            echo 'Логин или почта заняты';	
        }
    }

}
?>