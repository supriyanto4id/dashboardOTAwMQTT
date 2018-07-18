 <!-- <?php echo json_encode($info); ?>  -->

<?php foreach ($someArray as $key => $value) {
    echo $value["name_device"] . ", " . $value["topic_publish"] . "<br>";
  } ?>
