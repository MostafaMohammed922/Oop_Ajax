<?php
include("config.php");

$model = new Model();
$rows = $model->fetch();
?>
<table class="table table-hover tablel-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Description</th>
            <th class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        if (!empty($rows)) {
            foreach ($rows as $row) {
        ?>
                <tr>
                    <td><?= $i++; ?></td>
                    <td><?= $row['title']; ?></td>
                    <td><?= $row['description']; ?></td>
                    <td class="text-center">
                        <a href="#" id="read" class="btn btn-outline-info" value="<?= $row['id']?>" data-bs-toggle="modal" data-bs-target="#exampleModal">Read</a>
                        <a href="#" id="edit" class="btn btn-outline-success" value="<?= $row['id']?>" data-bs-toggle="modal" data-bs-target="#exampleModal_1">Edit</a>
                        <a href="#" id="delete" class="btn btn-outline-danger" value="<?= $row['id']?>">Delete</a>
                    </td>
                </tr>
        <?php
            }
        }else{
            echo "
                    <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                        No Data
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                    </div>
                    ";
        }
        ?>
    </tbody>
</table>