<?php
/** @var array $users */
//kreeg error van Intelephense dat $users niet herkend word, wat logisch is. dus na wat raadplegen dit geprobeerd.
//! Q: hoe los je dit netjes op? -> classes?
//! Q: dit bestand .php of .html noemen?

?>
<!DOCTYPE html>
<html>
<head>
    <title>Users</title>
</head>
<body>

<h1>Users</h1>

<ul>
    <?php foreach ($users as $user): ?> <!-- zonder het php gedeelte werkt dit wel, maar wel warning van Intelephense. -->
        <li>
            <?= htmlspecialchars($user["name"]) ?>
            <?= htmlspecialchars($user["age"]) ?> jaar
        </li>
    <?php endforeach; ?>
</ul>

</body>
</html>