<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-2">
                <h1 class="text-center text-success">PHP OOP WITH AJAX</h1>
                <hr style="height:3px;color:black;background-color:black">
            </div> <!-- col-12 -->
        </div><!-- row -->
        <div class="row">
            <div class="col-md-5 mx-auto mt-3">
                <form action="" method="post" id="form">
                    <div id="result"></div>
                    <div class="form-group">
                        <label for="">Title</label>
                        <input type="text" id="title" class="form-control">
                    </div><!-- form-group -->
                    <div class="form-group mt-2">
                        <label for="">Description</label>
                        <textarea id="description" cols="" rows="3" class="form-control"></textarea>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <button type="submit" id="submit" class="btn btn-outline-success btn-block w-25 mt-3">Send__</button>
                    </div>
                </form>
            </div><!-- col-6 -->
            <div class="col-md-7 mt-1">
                <div id="show"></div>
                <div id="fetch"></div>
            </div> <!-- col-7 -->
        </div><!-- row -->
    </div><!-- container -->

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="read_data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit _ Modal -->
    <div class="modal fade" id="exampleModal_1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Post</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="edit_data"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="update">UpDate Post</button>
                </div>
            </div>
        </div>
    </div>


    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on("click", "#submit", function(e) {
            e.preventDefault();

            var title = $("#title").val();
            var description = $("#description").val();
            var submit = $("#submit").val();

            $.ajax({
                url: "insert.php",
                type: "post",
                data: {
                    title: title,
                    description: description,
                    submit: submit,
                },
                success: function(data) {
                    fetch();
                    $("#result").html(data);
                },
            });

            $("#form")[0].reset();
        });

        // fetch posts

        function fetch() {
            $.ajax({
                url: "fetch.php",
                type: "post",
                success: function(data) {
                    $("#fetch").html(data);
                },
            });
        }
        fetch();

        // Delete post

        $(document).on("click", "#delete", function(e) {
            e.preventDefault();
            if (window.confirm("Are you sure you want to delete")) {
                var delete_id = $(this).attr("value");
                $.ajax({
                    url: "delete.php",
                    type: "post",
                    data: {
                        delete_id: delete_id
                    },
                    success: function(data) {
                        fetch();
                        $("#show").html(data);
                    },
                });
            } else {
                return false;
            }
        });

        // Read post

        $(document).on("click", "#read", function(e) {
            e.preventDefault();

            var read_id = $(this).attr("value");
            $.ajax({
                url: "read.php",
                type: "post",
                data: {
                    read_id: read_id
                },
                success: function(data) {
                    // fetch();
                    $("#read_data").html(data);
                },
            });
        });

        // Edit post

        $(document).on("click", "#edit", function(e) {
            e.preventDefault();

            var edit_id = $(this).attr("value");
            $.ajax({
                url: "edit.php",
                type: "post",
                data: {
                    edit_id: edit_id
                },
                success: function(data) {
                    // fetch();
                    $("#edit_data").html(data);
                },
            });
        });

        // update post 

        $(document).on("click", "#update", function(e) {
            e.preventDefault();

            var edit_title = $("#edit_title").val();
            var edit_description = $("#edit_description").val();
            var update = $("#update").val();
            var edit_id = $("#edit_id").val();

            $.ajax({
                url: "update.php",
                type: "post",
                data: {
                    edit_id: edit_id,
                    edit_title: edit_title,
                    edit_description: edit_description,
                    update: update
                },
                success: function(data) {
                    fetch();
                    $("#show").html(data);
                },
            });


        });
    </script>

</body>

</html>