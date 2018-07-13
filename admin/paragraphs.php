<?php include "includes/admin_header.php" ?>

<?php

if(isset($_GET['source'])) {

  $source = $_GET['source'];
} else {
  $source = '';
}

switch ($source) {
  case 'add_paragraph':
    include 'includes/add_paragraph.php';
    break;

  case 'edit_paragraph':
    include 'includes/edit_paragraph.php';
    break;

  default:
    include "includes/view_all_paragraphs.php";
    break;
} 

?>





<?php include "includes/admin_navigation.php" ?>
<?php include "includes/admin_footer.php" ?>