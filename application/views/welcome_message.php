<h2><?php echo $title; ?></h2>

<?php foreach ($students as $students_item): ?>

        <h3><?php echo $students_item['name']; ?></h3>
        <div class="main">
                <?php echo $students_item['address']; ?>
        </div>
        <p><a href="<?php echo ('http://localhost/student/'.$students_item['id']); ?>">View article</a></p>

<?php endforeach; ?>