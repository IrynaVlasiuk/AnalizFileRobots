<?php
session_start();
?>
<table border="2" cellspacing="0">
    <tr class="color-title">
        <th class="col-number">№</th>
        <th class="col-title">Название проекта</th>
        <th class="col-status">Статус</th>
        <th class="col-state"></th>
        <th>Текущее состояние</th>
        <th class="col-empty"></th>
    </tr>
    <tr><td colspan="6" class="row-empty"></td></tr>
    <tr>
        <td rowspan="2">1</td>
        <td rowspan="2">Проверка наличия файла robots.txt</td>
        <?php if($obj_file->status == $ok){ echo '<td rowspan="2" class="color-ok">'. $obj_file->status. '</td>';}
        else{
            echo '<td rowspan="2" class="color-error">'. $obj_file->status. '</td>';
        }
        ?>
        <td>Состояние</td>
        <td><?php echo $obj_file->state ; ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td><?php echo $obj_file->recommendations; ?></td>
        <td></td>
    </tr>
    <tr><td colspan="6" class="row-empty"></td></tr>
    <tr>
        <td rowspan="2">6</td>
        <td rowspan="2">Проверка указания директивы Host</td>
        <?php if($obj_host->status == $ok){ echo '<td rowspan="2" class="color-ok">'. $obj_host->status. '</td>';}
        else{
            echo '<td rowspan="2" class="color-error">'. $obj_host->status. '</td>';
        }
        ?>
        <td>Состояние</td>
        <td><?php echo $obj_host->state; ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td><?php echo $obj_host->recommendations; ?></td>
        <td></td>
    </tr>
    <tr><td colspan="6" class="row-empty"></td></tr>
    <tr>
        <td rowspan="2">8</td>
        <td rowspan="2">Проверка количества директив Host, прописанных в файле</td>
        <?php if($obj_count_hosts->status == $ok){ echo '<td rowspan="2" class="color-ok">'. $obj_count_hosts->status. '</td>';}
        else{
            echo '<td rowspan="2" class="color-error">'. $obj_count_hosts->status. '</td>';
        }
        ?>
        <td>Состояние</td>
        <td><?php echo $obj_count_hosts->state; ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td><?php echo $obj_count_hosts->recommendations; ?></td>
        <td></td>
    </tr>
    <tr><td colspan="6" class="row-empty"></td></tr>
    <tr>
        <td rowspan="2">10</td>
        <td rowspan="2">Проверка размера файла robots.txt</td>
        <?php if($obj_size_file->status == $ok){ echo '<td rowspan="2" class="color-ok">'. $obj_size_file->status. '</td>';}
        else{
            echo '<td rowspan="2" class="color-error">'. $obj_size_file->status . '</td>';
        }
        ?>
        <td>Состояние</td>
        <td><?php echo $obj_size_file->state; ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td><?php echo $obj_size_file->recommendations; ?></td>
        <td></td>
    </tr>
    <tr><td colspan="6" class="row-empty"></td></tr>
    <tr>
        <td rowspan="2">11</td>
        <td rowspan="2">Проверка указания директивы Sitemap</td>
        <?php if($obj_sitemap->status == $ok){ echo '<td rowspan="2" class="color-ok">'. $obj_sitemap->status. '</td>';}
        else{
            echo '<td rowspan="2" class="color-error">'. $obj_sitemap->status. '</td>';
        }
        ?>
        <td>Состояние</td>
        <td><?php echo $obj_sitemap->state; ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td><?php echo $obj_sitemap->recommendations; ?></td>
        <td></td>
    </tr>
    <tr><td colspan="6" class="row-empty"></td></tr>
    <tr>
        <td rowspan="2">12</td>
        <td rowspan="2">Проверка кода ответа сервера для файла robots.txt</td>
        <?php if($obj_response_code->status == $ok){ echo '<td rowspan="2" class="color-ok">'. $obj_response_code->status . '</td>';}
        else{
            echo '<td rowspan="2" class="color-error">'. $obj_response_code->status. '</td>';
        }
        ?>
        <td>Состояние</td>
        <td><?php if($response !== '200') { echo $obj_response_code->state . ' ' . $response ;} else { echo $obj_response_code->state; } ?></td>
        <td></td>
    </tr>
    <tr>
        <td>Рекомендации</td>
        <td><?php echo $obj_response_code->recommendations;?></td>
        <td></td>
    </tr>
</table>

<?php
$_SESSION['number'] = ['1','6','8','10','11','12'];
$_SESSION['name'] = ['Проверка наличия файла robots.txt', 'Проверка указания директивы Host', 'Проверка количества директив Host, прописанных в файле',
    'Проверка размера файла robots.txt', 'Проверка указания директивы Sitemap', 'Проверка кода ответа сервера для файла robots.txt'];
$_SESSION['status'] = [$obj_file->status, $obj_host->status, $obj_count_hosts->status , $obj_size_file->status, $obj_sitemap->status,
    $obj_response_code->status];
$_SESSION['state'] = [$obj_file->state, $obj_host->state, $obj_count_hosts->state, $obj_size_file->state, $obj_sitemap->state,
    $obj_response_code->state];
$_SESSION['recommendations'] = [$obj_file->recommendations, $obj_host->recommendations, $obj_count_hosts->recommendations,
    $obj_size_file->recommendations, $obj_sitemap->recommendations,$obj_response_code->recommendations];
?>

<div class="div-btn">
    <a class="btn-save" href="excel.php">Сохранить</a>
</div>
