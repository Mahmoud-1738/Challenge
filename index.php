<?php
include 'includes/conn.php';
$database = new Database();
$pdo = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $comments = $_POST['comments'];

    $insert = $pdo->prepare('INSERT INTO youtube (name, email, comments) VALUES (?, ?, ?)');
    $insert->execute([$name, $email, $comments]);

    header('Location: index.php');
    exit;
}

$stmt = $pdo->prepare('SELECT * FROM youtube ORDER BY id DESC');
$stmt->execute();
$youtube = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

    <iframe width="960" height="540" src="https://www.youtube.com/embed/eUDVUZZyA0M?si=K4Wz2LH-M9yqKrCn"
        title="YouTube video player" frameborder="0"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
        referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>

    <h2>Laat een reactie achter</h2>
    <form method="POST" action="">
        <input type="text" name="name" placeholder="Naam" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <textarea name="comments" placeholder="Reactie..." required></textarea><br>
        <button type="submit">Plaatsen</button>
    </form>

    <h2>Reacties</h2>
    <?php foreach ($youtube as $youtube1): ?>
    <div class="comment">
        <div class="comment-header">
            <img src="avatar.php?name=<?= urlencode($youtube1['name']) ?>" width="40" height="40"
                style="border-radius: 50%;" alt="avatar">
            <div>
                <strong><?= htmlspecialchars($youtube1['name']) ?></strong><br>
                <small><?= htmlspecialchars($youtube1['created_at']) ?></small>
            </div>
        </div>
        <p><?= htmlspecialchars($youtube1['comments']) ?></p>
    </div>
    <?php endforeach; ?>

</body>

</html>