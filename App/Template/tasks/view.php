<?php /** @var \App\DTO\BookDTO $data */ ?>
<h1>VIEW BOOK</h1>


<a href="profile.php">My Profile</a>

<p><span style="font-weight: bold">Book Title:</span> <?= $data->getTitle() ?></p>

<p><span style="font-weight: bold">Book Author: </span><?= $data->getAuthor() ?></p>

<p><span style="font-weight: bold">Description: </span><?= $data->getDescription() ?></p>

<p><span style="font-weight: bold">Genre: </span><?= $data->getName() ?></p>

<?php
$image = $data->getImage();
$imageData = base64_encode(file_get_contents($image));
echo '<img src="data:image/jpeg;base64,'.$imageData.'">';
?>