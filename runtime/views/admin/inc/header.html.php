<!DOCTYPE html>
<html lang="en">

<!-- header styles and scripts -->
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $appConfigs[site_name]?></title>
    <meta name="description" content="<?php echo $appConfigs[site_desc]?>" />
    <meta name="author" content="<?php echo $appConfigs[site_author]?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="renderer" content="webkit" />
    
    <link rel="icon" type="image/png" href="/static/admin/i/favicon.png" />
    <link rel="apple-touch-icon-precomposed" href="/static/admin/i/app-icon72x72@2x.png" />
    <?php echo $this->importResource('css', "admin/css/amazeui.min.css")?>
    <?php echo $this->importResource('css', "common/js/datepicker/amazeui.datetimepicker.min.css")?>
    <?php echo $this->importResource('css', "common/js/chosen/amazeui.chosen.css")?>
    <?php echo $this->importResource('css', "admin/css/app.css")?>
    <?php echo $this->importResource('css', "admin/css/admin.css")?>

    <?php echo $this->importResource('js', "common/js/jquery.min.js")?>
    <?php echo $this->importResource('js', "common/js/sea.min.js")?>
    <?php echo $this->importResource('js', "admin/js/admin-config.js")?>

</head>