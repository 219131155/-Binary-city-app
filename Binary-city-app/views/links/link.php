<!DOCTYPE html>
<html>
<head>
    <title>Link Contact to Client</title>
</head>
<body>
    <h2>Link Contact to Client</h2>
    <?php if (!empty($message)) echo "<p><b>$message</b></p>"; ?>
    <form method="POST" action="index.php?controller=link&action=submit">
        <label>Select Client:</label>
        <select name="client_id">
            <option value="">--Choose Client--</option>
            <?php foreach ($clients as $client): ?>
                <option value="<?= $client['id'] ?>">
                    <?= htmlspecialchars($client['name']) ?> (<?= $client['code'] ?>)
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <label>Select Contact:</label>
        <select name="contact_id">
            <option value="">--Choose Contact--</option>
            <?php foreach ($contacts as $contact): ?>
                <option value="<?= $contact['id'] ?>">
                    <?= htmlspecialchars($contact['name']) ?> <?= htmlspecialchars($contact['surname']) ?>
                </option>
            <?php endforeach; ?>
        </select><br><br>

        <button type="submit">Link Contact</button>
    </form>
    <br>
    <a href="index.php?controller=client&action=index">&larr; Back to Clients</a>
</body>
</html>
