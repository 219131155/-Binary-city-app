<!DOCTYPE html>
<html>
<head><title>Clients</title></head>
<body>
    <h2>Clients</h2>
    <a href="index.php?controller=client&action=createForm">➕ Add New Client</a><br><br>

    <?php if (empty($clients)): ?>
        <p>No client(s) found.</p>
    <?php else: ?>
        <table border="1" cellpadding="5">
            <tr>
                <th>Name</th>
                <th>Client Code</th>
                <th>No. of Linked Contacts</th>
            </tr>
            <?php foreach ($clients as $client): ?>
                <tr>
                    <td><?= htmlspecialchars($client['name']) ?></td>
                    <td><?= htmlspecialchars($client['code']) ?></td>
                    <td align="center"><?= $client['linked_contacts'] ?? 0 ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php endif; ?>
</body>
</html>
