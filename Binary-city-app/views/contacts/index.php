<!DOCTYPE html>
<html>
<head>
    <title>Contacts</title>
</head>
<body>
    <h2>Contacts</h2>
    <a href="index.php?controller=contact&action=createForm">➕ Add New Contact</a><br><br>

    <?php if (empty($contacts)): ?>
        <p>No contact(s) found.</p>
    <?php else: ?>
        <table border="1" cellpadding="5">
    <tr>
        <th>Name</th>
        <th>Surname</th>
        <th>Email Address</th>
        <th>Client</th>
    </tr>
    <?php foreach ($contacts as $contact): ?>
        <tr>
            <td><?= htmlspecialchars($contact['name']) ?></td>
            <td><?= htmlspecialchars($contact['surname']) ?></td>
            <td><?= htmlspecialchars($contact['email']) ?></td>
            <td><?= htmlspecialchars($contact['client_name'] ?? 'N/A') ?></td>
        </tr>
    <?php endforeach; ?>
</table>

    <?php endif; ?>
</body>
</html>

