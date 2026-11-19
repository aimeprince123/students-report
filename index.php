
<?php
require_once "db.php";

$result = $conn->query("SELECT * FROM students ORDER BY id ASC");

function e($value) {
    return htmlspecialchars((string)$value, ENT_QUOTES, "UTF-8");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Management System</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 30px;
            background:darkviolet;
}

        .container {
            max-width: 1100px;
            margin: 30px auto;
            background:black(255, 255, 255, 0.94);
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }

        h1 {
            text-align: center;
            color:white;
            font-size: 32px;
        }

        .add, .edit, .delete {
            display: inline-block;
            padding: 9px 13px;
            color: white;
            text-decoration: none;
            border-radius: 6px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            font-weight: bold;
            transition: 0.3s;
        }

        .add {
            background: #16a34a;
        }

        .add:hover {
            background: #15803d;
        }

        .edit {
            background: green;
        }

        .edit:hover {
            background: #1d4ed8;
        }

        .delete {
            background: #dc2626;
        }

        .delete:hover {
            background: #b91c1c;
        }

        .delete-form {
            display: inline;
        }

        .table-wrapper {
            width: 100%;
            overflow-x: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background: white;
        }

        th, td {
            border: 1px solid #d1dbe8;
            padding: 12px;
            text-align: left;
        }

        th {
            background: #123b70;
            color: white;
        }

        tr:nth-child(even) {
            background: #eaf2ff;
        }

        tr:hover {
            background: #dbeafe;
        }

        .delete-form {
            display: inline;
        }

        @media (max-width: 600px) {
            body {
                padding: 10px;
            }

            .container {
                padding: 15px;
                margin: 10px auto;
            }

            h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>

<div class="container">

    <h1>SCHOOL RECORDS</h1>

    <a class="add" href="create.php">+ ADD NEW STUDENT</a>

    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Age</th>
            <th>Course</th>
            <th>Actions</th>
        </tr>

        <?php if ($result && $result->num_rows > 0): ?>

            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= (int)$row["id"] ?></td>
                    <td><?= e($row["name"]) ?></td>
                    <td><?= e($row["email"]) ?></td>
                    <td><?= e($row["age"]) ?></td>
                    <td><?= e($row["course"]) ?></td>

                    <td>
                        <!-- EDIT BUTTON -->
                        <a class="edit"
                           href="edit.php?id=<?= (int)$row["id"] ?>">
                            Edit
                        </a>

                        <!-- DELETE BUTTON -->
                        <form class="delete-form"
                              action="delete.php"
                              method="POST"
                              onsubmit="return confirm('Are you sure you want to delete this student?');">

                            <input type="hidden"
                                   name="id"
                                   value="<?= (int)$row["id"] ?>">

                            <button class="delete" type="submit">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endwhile; ?>

        <?php else: ?>
            <tr>
                <td colspan="6">No students found.</td>
            </tr>
        <?php endif; ?>

    </table>

</div>

</body>

</html>
