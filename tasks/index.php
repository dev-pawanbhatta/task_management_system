<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <title>Manage Task | Task Management System</title>
    <?php include '../layouts/header.php'; ?>
</head>

<body>
    <?php include '../layouts/navbar.php'; ?>
    <div class="container my-5">
        <div class="card">
            <div class="card-header">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm float-end" data-bs-toggle="modal"
                    data-bs-target="#add">
                    Add Task
                </button>

                <!-- Modal -->
                <div class="modal fade" id="add" tabindex="-1" aria-labelledby="addLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered      ">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addLabel">Add Task</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <form action="../backend/crud/tasks/create.php" method="post">
                                <div class="modal-body">
                                    <div class="mb-3">
                                        <label for="title" class="form-label">Title</label>
                                        <input type="text" class="form-control" id="title" name="title">
                                    </div>
                                    <div class="mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea name="description" id="" cols="30" rows="10"
                                            class="form-control"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="time" class="form-label">Time</label>
                                        <input type="time" class="form-control" id="time" name="time">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submit">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Time</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $email = $_SESSION['email'];

                        $ch = curl_init();
                        $optArray = array(
                            CURLOPT_URL => "http://localhost/task_management_system/backend/crud/tasks/getall.php?email=$email",
                            CURLOPT_RETURNTRANSFER => true
                        );
                        curl_setopt_array($ch, $optArray);
                        $tasks = curl_exec($ch);
                        $tasks = json_decode($tasks);
                        $i = 1;
                        foreach ($tasks as $task) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $i++ ?></th>
                            <td><?= $task->title ?></td>
                            <td><?= $task->time ?></td>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#view<?= $task->id ?>">
                                    View
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="view<?= $task->id ?>" tabindex="-1"
                                    aria-labelledby="viewLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered      ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="viewLabel">Modal title</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ...
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>
                                                <button type="button" class="btn btn-primary">Save changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
    <script src=" https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
</body>

</html>