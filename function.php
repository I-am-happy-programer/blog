<?php

function showMinNews($id,$title,$stext,$ftext){
/*$link=mysqli_connect('localhost','homestead','secret','db-test');
$res = mysqli_query($link, "SELECT * FROM main_table WHERE id = $id");
$row = mysqli_fetch_assoc($res);
$title = $row['title'];
$stext = $row['stext'];
$ftext = $row['ftext'];*/
echo '<div class="news"><h2>'.$title.'</h2><p>'.$stext.'</p>	<a href="news.php?id='.$id.'">Читать далее</a></div>';
}
function showFullNews($id,$title,$stext,$ftext){
/*$link=mysqli_connect('localhost','homestead','secret','db-test');
$res = mysqli_query($link, "SELECT * FROM news WHERE id = $id");
$row = mysqli_fetch_assoc($res);
$title = $row['title'];
$stext = $row['stext'];
$ftext = $row['ftext'];*/
echo '<div><h1 class="newtitle">'.$title.'</h1><p class="newtext">'.$ftext.'</p></div>';
}