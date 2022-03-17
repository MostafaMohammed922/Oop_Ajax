<?php
include("config.php");

$read_id = $_POST['read_id'];

$model = new Model();
$row = $model->read($read_id);

if (!empty($row)) { ?>
    <p>Title : <?= $row['title'] ?></p>
    <p>Description : <?= $row['description'] ?></p>
<?php
} ?>