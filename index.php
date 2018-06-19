<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Анализатор robots.txt</title>
    <link rel="stylesheet" href="styles/index.css">
</head>
<body>
<?php
    
    // Подключаем классы и переменные
    include 'variables.php';
    include 'classes/UserInfo.php';
    include 'classes/ValidationState.php';

if(isset($_POST['submit'])){
    $userInfo = new UrlInfo();
    $urlInfoResult = $userInfo->validateUrl();
    if(!$urlInfoResult->isValid){
        $message_error = 'Пожалуйста, введите валидную ссылку';
    }
    else{
        $should_show_result = true;
        $file = $urlInfoResult->url . "/robots.txt";

        $data = file_get_contents($file);

        $obj_file = new ValidationState();
        if (!$data) {
            $obj_file->status = $error;
            $obj_file->state = $state_file_error;
            $obj_file->recommendations = $recommendations_file_error;
        }
        else {
            $obj_file->status = $ok;
            $obj_file->state = $state_file_ok;
            $obj_file->recommendations = $recommendations_ok;
        }

        $obj_host = new ValidationState();
        $obj_count_hosts = new ValidationState();
        if (!preg_match("/Host/i", $data)) {
            $obj_host->status = $error;
            $obj_host->state = $state_host_error;
            $obj_host->recommendations = $recommendations_host_error;
            $obj_count_hosts->status = $error;
            $obj_count_hosts->state = $absence_host;
            $obj_count_hosts->recommendations = '';
        }
        else{
            $obj_host->status = $ok;
            $obj_host->state = $state_host_ok;
            $obj_host->recommendations = $recommendations_ok;

            $length_hosts = preg_match("/Host/i", $data);

            if ($length_hosts > 1) {
                $obj_count_hosts->status = $error;
                $obj_count_hosts->state = $state_count_hosts_error;
                $obj_count_hosts->recommendations = $recommendations_count_hosts_error;
            }
            else{
                $obj_count_hosts->status = $ok;
                $obj_count_hosts->state = $state_count_hosts_ok;
                $obj_count_hosts->recommendations = $recommendations_ok;
            }
        }

        $obj_size_file = new ValidationState();
        $headers = get_headers($file, 1);
        if (isset($headers['Content-Length'])) {
            $size = $headers['Content-Length'];

            if($size <= 0) {
                $size = 'размер файла неизвестный';
                $obj_size_file->status = $error;
                $obj_size_file->state = $size;
                $obj_size_file->recommendations = '';
            }
            elseif($size > 32*1024) {
                $obj_size_file->status = $error;
                $obj_size_file->state = $state_filesize_error_first . $size . ' байт(а)' . $state_filesize_error_second;
                $obj_size_file->recommendations = $recommendations_filesize_error;
            }
            else {
                $obj_size_file->status = $ok;
                $obj_size_file->state = $state_filesize_ok_first . $size. ' байт(а)' . $state_filesize_ok_second;
                $obj_size_file->recommendations = $recommendations_ok;
            }
        }
        else {
            $size = 'размер файла неизвестный';
            $obj_size_file->status = $error;
            $obj_size_file->state = $size;
            $obj_size_file->recommendations = '';
        }

        $obj_sitemap = new ValidationState();
        if (!preg_match("/Sitemap/i", $data)) {
            $obj_sitemap->status = $error;
            $obj_sitemap->state = $state_sitemap_error;
            $obj_sitemap->recommendations = $recommendations_sitemap_error;
        }
        else{
            $obj_sitemap->status = $ok;
            $obj_sitemap->state = $state_sitemap_ok;
            $obj_sitemap->recommendations = $recommendations_ok;
        }

        $response_code = preg_match("/200 OK/i", $headers[0]);
        $response = substr($headers[0],9,3);

        $obj_response_code = new ValidationState();
        if (!$response_code) {
            $obj_response_code->status = $error;
            $obj_response_code->state = $state_response_code_error;
            $obj_response_code->recommendations = $recommendations_response_code_error;
        }
        else{
            $obj_response_code->status = $ok;
            $obj_response_code->state = $state_response_code_ok;
            $obj_response_code->recommendations = $recommendations_ok;
        }
    }
 }
?>

<div class="form">
    <p class="title">Введите адрес сайта:</p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div>
            <label for="url">
                <input type="text" name="url" id="url" required>
            </label>
            <div class="msg-error"><?php echo $message_error; ?></div>
        </div>
        <button type="submit" class="button" name="submit">Проверить</button>
    </form>
</div>
<div class="content">

<?php
    // Показать таблицу результатов если ссылка корректная
    if($should_show_result){
       include 'result.php';
    }
?>

</div>
</body>
</html>