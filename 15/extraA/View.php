<?php

class View {

    //users weergeven
    public function showUsers($users) { //eerdere probleem wat ik had nu dus weg omdat $users word meegegeven
        ?>

        <!DOCTYPE html>
        <html>
        <head>
            <title>Users</title>
        </head>

        <body>

        <h1>Users</h1>

        <?php foreach ($users as $user): ?>

            <p>
                <?= htmlspecialchars($user["name"]) ?>
                -
                <?= htmlspecialchars($user["age"]) ?> jaar
            </p>

        <?php endforeach; ?>

        </body>
        </html>

        <?php
    }
}