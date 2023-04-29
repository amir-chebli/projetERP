<!DOCTYPE html>
<html>
<head>
    <title>Client Management</title>
    <link rel="stylesheet" href="style2.css">
</head>
<body>
    <h1>Client Management</h1>

    <form method="post">
        <h2>Add a New Client</h2>
        <label for="codeCLT">CodeCLT:</label>
        <input type="text" name="codeCLT" id="codeCLT" required>
        <br>
        <label for="nom">Nom:</label>
        <input type="text" name="nom" id="nom" required>
        <br>
        <label for="tel">Tel:</label>
        <input type="text" name="tel" id="tel" required>
        <br>
        <label for="adresse">Adresse:</label>
        <input type="text" name="adresse" id="adresse" required>
        <br>
        <input type="submit" name="add" value="Add Client">
    </form>

    <form method="post">
        <h2>Modify Client Information</h2>
        <label for="codeCLT">CodeCLT:</label>
        <input type="text" name="codeCLT" id="codeCLT" required>
        <br>
        <label for="tel">New Tel:</label>
        <input type="text" name="tel" id="tel" required>
        <br>
        <input type="submit" name="modify" value="Modify Client">
    </form>

    <form method="post">
        <h2>Delete a Client</h2>
        <label for="codeCLT">CodeCLT:</label>
        <input type="text" name="codeCLT" id="codeCLT" required>
        <br>
        <input type="submit" name="delete" value="Delete Client">
    </form>

    <?php
// include the database connection file
include 'db_conn.php';

// add a new client
if(isset($_POST['add'])) {
    $codeCLT = $_POST['codeCLT'];
    $nom = $_POST['nom'];
    $tel = $_POST['tel'];
    $adresse = $_POST['adresse'];

    // insert the client into the database
    $sql = "INSERT INTO client (codeCLT, nom, tel, adresse) VALUES ('$codeCLT', '$nom', '$tel', '$adresse')";
    if(mysqli_query($conn, $sql)) {
        echo "New client added successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// modify client information
if(isset($_POST['modify'])) {
    $codeCLT = $_POST['codeCLT'];
    $tel = $_POST['tel'];

    // update the client's telephone number
    $sql = "UPDATE client SET tel='$tel' WHERE codeCLT='$codeCLT'";
    if(mysqli_query($conn, $sql)) {
        echo "Client information updated successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// delete a client
if(isset($_POST['delete'])) {
    $codeCLT = $_POST['codeCLT'];

    // delete the client from the database
    $sql = "DELETE FROM client WHERE codeCLT='$codeCLT'";
    if(mysqli_query($conn, $sql)) {
        echo "Client deleted successfully.";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

?>
<?php
// Connect to the database
require_once('db_conn.php');

// Query the database for all clients
$sql = "SELECT * FROM client";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Query failed: " . mysqli_error($conn));
}

// Display the results in an HTML table
echo "<h2>Clients List</h2>";
echo "<table>";
echo "<tr><th>CodeCLT</th><th>Nom</th><th>Tel</th><th>Adresse</th></tr>";
while ($row = mysqli_fetch_assoc($result)) {
    echo "<tr><td>" . $row['codeCLT'] . "</td><td>" . $row['nom'] . "</td><td>" . $row['tel'] . "</td><td>" . $row['adresse'] . "</td></tr>";
}
echo "</table>";

// Close the database connection
mysqli_close($conn);
?>

</body>
</html>

