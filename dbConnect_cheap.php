<?php
$dbConnection = mysqli_connect("localhost", "root", "", "hello_world");

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
    exit();
}

// Perform queries
if ($result = mysqli_query($dbConnection, "SELECT users.id as user_id, username, email, name FROM users join status on users.status_id = status.id")) {
    printf("Select returned %d rows.\n", mysqli_num_rows($result));
    
    printf("<table border='1'>");
    printf("<tr><th>id</th><th>name</th><th>email</th><th>status_id</th></tr>");
    while ($row = mysqli_fetch_assoc($result)) {
        printf("<tr><td>%s</td><td>%s</td><td>%s</td><td>%s</td></tr>", $row["user_id"], $row["username"], $row["email"], $row["name"]);
    }
    // Free result set
    mysqli_free_result($result);
}

mysqli_close($dbConnection);
?>