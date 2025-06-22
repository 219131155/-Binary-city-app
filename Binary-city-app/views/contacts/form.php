<!DOCTYPE html>
<html>
<head><title>Create Contact</title></head>
<body>
    <h2>Create New Contact</h2>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= $error ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=contact&action=create">
        <label>Name:</label><br>
        <input type="text" name="name" required><br>

        <label>Surname:</label><br>
        <input type="text" name="surname" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>

        <button type="submit">Save Contact</button>
    </form>
</body>
</html>
