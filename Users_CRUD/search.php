<?php
include_once 'header.php'; 
require_once 'searchdb.php';
if(isset($_GET['keywords'])){
$keywords = $db->escape_string($_GET['keywords']);
$query = $db->query("
SELECT first_name,last_name,email_id,contact_no
FROM tbl_users
WHERE first_name LIKE '%{$keywords}%'
OR last_name LIKE '%{$keywords}%'
");
?>
<div class="container alert alert-success">
Found <?php echo $query->num_rows; ?> results.<a href='index.php'>HOME</a>
</div>
<?php
if($query->num_rows){
    while($r= $query->fetch_object()){
        ?>
        <div class="container">
        <div class="row">
        <div class="col-md-12">
        <table class='table table-bordered table-responsive'>
     <tr>
     <th>First Name</th>
     <th>Last Name</th>
     <th>E-mail</th>
     <th>Phone</th>
     </tr>
     <tr>
        <td><?php echo $r->first_name; ?></td>
        <td><?php echo $r->last_name; ?></td>
        <td><?php echo $r->email_id; ?></td>
        <td><?php echo $r->contact_no; ?></td>
        </div>
        </div>
        </div>
        </tr>
        </table>
       <?php
        }

    }
}

include_once 'footer.php';
