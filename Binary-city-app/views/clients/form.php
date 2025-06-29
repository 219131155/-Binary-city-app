<!DOCTYPE html>
<html>
<head>
    <title>Create Client</title>
</head>
<body>

    <h2>Create New Client</h2>

    <!-- Display error message if the $error variable is not empty -->
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <!-- Form that submits via POST to the 'create' action in ClientController -->
    <form method="POST" action="index.php?controller=client&action=create">
        
        <!-- Input field for the client's name -->
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <!-- Submit button -->
        <button type="submit">Save Client</button>
    </form>

</body>
</html>

