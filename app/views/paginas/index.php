<?php require APPROOT.'/views/shared/header.php'; ?>

</h1><?php echo $data['titulo']; ?></h1>
<ul>
    <?php foreach($data['posts'] as $post): ?>
        <li>
            <?php echo $post->titulo;?>
        </li>
    <?php endforeach; ?>
</ul>
<?php require APPROOT.'/views/shared/footer.php'; ?>
