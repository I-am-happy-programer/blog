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
        $link = mysqli_connect(
            'localhost',  /* Хост, к которому мы подключаемся */
            'homestead',       /* Имя пользователя */
            'secret',   /* Используемый пароль */
            'db-test');     /* База данных для запросов по умолчанию */
        $str="SELECT id FROM user_table WHERE login = '".$login."' AND password = '".$password."'";
        
        $result = mysqli_query($link, $str);
        $row_cnt = $result->num_rows;
        //print_r($result);exit;
        if ($row_cnt == 1)
        {
            $_SESSION['userName']=$login;
           header("Location: ../index.php");
			exit;
        }
        else{
            echo 'Неверный логин или пароль';	
        }
    }

}
function RegIn(){
	
    if (isset($_POST['btnReg'])){
    	unset($_SESSION['userName']);
        $login=$_POST['login'];
        $password=$_POST['password'];
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