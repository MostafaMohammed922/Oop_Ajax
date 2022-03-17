<?php
include("config.php");

$edit_id = $_POST['edit_id'];

$model = new Model();
$row = $model->edit($edit_id);

if (!empty($row)) { ?>
    <form action="" method="post" id="form">
        <div>
            <input type="hidden" id="edit_id" value="<?=$row['id']?>">
        </div>
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" id="edit_title" class="form-control" value="<?= $row['title'] ?>">
        </div><!-- form-group -->
        <div class="form-group mt-2">
            <label for="">Description</label>
            <textarea id="edit_description" cols="" rows="3" class="form-control"><?= $row['description'] ?></textarea>
        </div><!-- form-group -->
    </form>
<?php
} ?>