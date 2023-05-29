<?php

// Connect to the database
$conn = mysqli_connect("localhost", "root", "", "hello_world") or die("Connection failed: " . mysqli_connect_error());

// Create a user
if (isset($_POST['create'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "INSERT INTO users (username, email, status_id) VALUES ('$name', '$email', '1')";
    if (mysqli_query($conn, $sql)) {
        echo "User created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Read all users
if (isset($_GET['read'])) {
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>";
        echo "<th>ID</th>";
        echo "<th>Name</th>";
        echo "<th>Email</th>";
        echo "</tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['id'] . "</td>";
            echo "<td>" . $row['username'] . "</td>";
            echo "<td>" . $row['email'] . "</td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "No users found";
    }
}

// Update a user
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $sql = "UPDATE users SET username='$name', email='$email' WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "User updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Delete a user
if (isset($_GET['delete'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM users WHERE id=$id";
    if (mysqli_query($conn, $sql)) {
        echo "User deleted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
}

// Close the connection
mysqli_close($conn);
?>

<!-- Include Material Design Lite CSS -->
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.indigo-pink.min.css">

<!-- Create user form -->
<h2 class="mdl-typography--title">Create User</h2>
<form action="" method="post">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="name" name="name">
        <label class="mdl-textfield__label" for="name">Name</label>
    </div><br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="email" id="email" name="email">
        <label class="mdl-textfield__label" for="email">Email</label>
    </div><br>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="create">
        Create
    </button>
</form>

<!-- Read all users table -->
<h2 class="mdl-typography--title">Read Users</h2>
<a href="?read" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored">
    Read
</a>

<!-- Update user form -->
<h2 class="mdl-typography--title">Update User</h2>
<form action="" method="post">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="number" id="id" name="id">
        <label class="mdl-textfield__label" for="id">ID</label>
    </div><br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="text" id="name" name="name">
        <label class="mdl-textfield__label" for="name">Name</label>
    </div><br>
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="email" id="email" name="email">
        <label class="mdl-textfield__label" for="email">Email</label>
    </div><br>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="update">
        Update
    </button>
</form>

<!-- Delete user form -->
<h2 class="mdl-typography--title">Delete User</h2>
<form action="" method="get">
    <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
        <input class="mdl-textfield__input" type="number" id="delete-id" name="delete-id">
        <label class="mdl-textfield__label" for="delete-id">ID</label>
    </div><br>
    <button class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" type="submit" name="delete">
        Delete
    </button>
</form>