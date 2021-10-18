<?
function load_users_data($user_ids) {
    $user_ids = explode(',', $user_ids);
    foreach ($user_ids as $user_id) {
        $db = mysqli_connect("localhost", "root", "123123", "database");
        $sql = mysqli_query($db, "SELECT * FROM users WHERE id=$user_id");
        while($obj = $sql->fetch_object()){
            $data[$user_id] = $obj->name;
        }
        mysqli_close($db);
    }
    return $data;
}

// Как правило, в $_GET['user_ids'] приходит строка
// с номерами пользователей через запятую, например: 1,2,17,48

$data = load_users_data($_GET['user_ids']);
foreach ($data as $user_id=>$name) {
    echo "<a href=\"/show_user.php?id=$user_id\">$name</a>";
}


/***
	
строка 1 - отсуствует тег php (правильный вариант '<?php'). Это нарушение стандарта PSR-1 (использование только тэгов <?php и <?=)
строка 2 - по стандарту PSR-1 методы объявляются в camelCase (название функции написано в snake_case).
строка 5 - подключение к БД находятся внутри цикла и это непровильно, потому что при 
		   каждом шаге происходить подключение к БД (это нагружает сервер). Правльный вариант подключение к БД должен быть перед циклом.
строка 6 - при таком стиле написание запроса происходить SQL инъекция. Пользователь может выполнить любой запрос к БД через URL (GET запрос) от имени root. 		   
строка 8 - не объявлен массив $data
строка 10 - так как подключение к БД находятся внутри цикла и ее нужно перенести за пределами цикла.  mysqli_close нужно вставить после цикла 


***/
