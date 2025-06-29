
<!DOCTYPE html>
<html>
<head><title>Create Contact</title></head>
<body>
    <h2>Create New Contact</h2>
    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="index.php?controller=contact&action=create">
        <label>Name:</label><br>
        <input type="text" name="name" required><br>

        <label>Surname:</label><br>
        <input type="text" name="surname" required><br>

        <label>Email:</label><br>
        <input type="email" name="email" required><br>

        <label>Client:</label><br>
        <select name="client_id" required>
            <option value="" disabled selected>-- Select Client --</option>
            <?php if (empty($clients)): ?>
                <option value="" disabled>No clients available</option>
            <?php else: ?>
                <?php foreach ($clients as $client): ?>
                    <option value="<?= $client['id'] ?>">
                        <?= htmlspecialchars($client['name']) ?>
                    </option>
                <?php endforeach; ?>
            <?php endif; ?>
        </select><br><br>

        <button type="submit" <?= empty($clients) ? 'disabled' : '' ?>>Save Contact</button>
    </form>
</body>
</html>


