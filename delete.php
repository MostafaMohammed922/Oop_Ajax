<?php
include("config.php");

$delete_id = $_POST['delete_id'];

$model = new Model();
$delete = $model->delete($delete_id);