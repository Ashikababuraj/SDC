<?php
include 'db.php';

// Fetch all students
$result = $conn->query("SELECT * FROM students ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Students</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h3>Students List</h3>
    <a href="add_student.php" class="btn btn-success mb-3">+ Add Student</a>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
        <tr>
            <th width="5%">ID</th>
            <th width="20%">Name</th>
            <th width="25%">Email</th>
            <th width="15%">Mobile</th>
            <th width="10%">Status</th>
            <th width="25%">Actions</th>
        </tr>
        </thead>

        <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>

                <?php 
                    // var_dump($row); exit;
                ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><?= $row['name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['mobile']; ?></td>
                    <td>
                        <?php if($row['status'] == 1): ?>
                            <span class="badge bg-success">Active</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Inactive</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="edit_student.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">
                            Edit
                        </a>
                        <a href="delete_student.php?id=<?= $row['id'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="return confirm('Are you sure you want to delete this student?');">
                            Delete
                        </a>
                    </td>
                </tr>
            <?php endwhile; ?>

        <?php else: ?>
            <tr>
                <td colspan="6" class="text-center text-danger">No students found</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

</body>
</html>
