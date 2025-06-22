<!DOCTYPE html>
<html>
<head><title>Create Client</title></head>
<body>
    <h2>Create New Client</h2>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=client&action=create">
        <label>Name:</label><br>
        <input type="text" name="name" required><br><br>

        <button type="submit">Save Client</button>
    </form>
</body>
</html>
