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
        $search =   "'";
        $replace = "";
        $link = mysqli_connect(
            'localhost',  /* Хост, к которому мы подключаемся */
            'homestead',       /* Имя пользователя */
            'secret',   /* Используемый пароль */
            'db-test');     /* База данных для запросов по умолчанию */
        $str="SELECT id FROM user_table WHERE login = '".$login."'";
        $regin="INSERT INTO `db-test`.`user_table` (`login`, `password`) VALUES ('".$login."', '".$password."');";
        
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
            echo 'Логин занят. Придумайте другой логин';	
        }
    }

}
?>