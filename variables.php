<?php
$should_show_result = false;

$error = 'Ошибка';
$ok = 'Ok';
$status_file = $status_host = $status_count_hosts = $status_sizeof = $status_sitemap = $status_response_code = $ok;

$state_file_ok = 'Файл robots.txt присутствует';
$state_host_ok = 'Директива Host указана';
$state_count_hosts_ok = 'В файле прописана 1 директива Host';
$state_filesize_ok_first = 'Размер файла robots.txt составляет ' ;
$state_filesize_ok_second = ', что находится в пределах допустимой нормы';
$state_sitemap_ok = 'Директива Sitemap указана';
$state_response_code_ok = 'Файл robots.txt отдаёт код ответа сервера 200';

$state_file_error = 'Файл robots.txt отсутствует';
$state_host_error = 'В файле robots.txt не указана директива Host';
$state_count_hosts_error = 'В файле прописано несколько директив Host';
$state_filesize_error_first = 'Размера файла robots.txt составляет ';
$state_filesize_error_second = ' , что превышает допустимую норму';
$state_sitemap_error = 'В файле robots.txt не указана директива Sitemap';
$state_response_code_error = 'При обращении к файлу robots.txt сервер возвращает код ответа';

$recommendations_ok = 'Доработки не требуются';

$recommendations_file_error = 'Программист: Создать файл robots.txt и разместить его на сайте.';
$recommendations_host_error = 'Программист: Для того, чтобы поисковые системы знали, какая версия сайта является основных зеркалом,
                               необходимо прописать адрес основного зеркала в директиве Host. В данный момент это не прописано.
                               Необходимо добавить в файл robots.txt директиву Host. Директива Host задётся в файле 1 раз, после всех правил.';
$recommendations_count_hosts_error = 'Программист: Директива Host должна быть указана в файле толоко 1 раз. Необходимо удалить все дополнительные 
                                директивы Host и оставить только 1, корректную и соответствующую основному зеркалу сайта';
$recommendations_filesize_error = 'Программист: Максимально допустимый размер файла robots.txt составляем 32 кб. Необходимо отредактировть файл 
                             robots.txt таким образом, чтобы его размер не превышал 32 kб';
$recommendations_sitemap_error = 'Программист: Добавить в файл robots.txt директиву Sitemap';
$recommendations_response_code_error = 'Программист: Файл robots.txt должны отдавать код ответа 200, иначе файл не будет обрабатываться. 
                                   Необходимо настроить сайт таким образом, чтобы при обращении к файлу robots.txt сервер возвращает код ответа 200';

$absence_host = 'Проверка невозможна, т.к. директива Host отсутствует';

$message_error = '';
