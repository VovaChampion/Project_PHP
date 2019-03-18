<?php
include_once 'dbconfig.php';
?>
<?php include_once 'header.php'; ?>

<div class="clearfix"></div>

<div class="container">
<div class="row">
<div class="col-md-6">
<a href="add-data.php" class="btn btn-large btn-info"><i class="glyphicon glyphicon-plus"></i> &nbsp; Add Records</a>
</div>
<div class="col-md-6">
<form class="form-group" action="search.php" method="get" id="searchform" >
<input  type="text" name="keywords" placeholder="Firstname or lastname">
<input type="submit" name="submit" value="Search" class="btn btn-primary" />
</form>
</div>
</div>
</div>

<div class="clearfix"></div><br />

<div class="container">
     <table class='table table-bordered table-responsive'>
     <tr>
     <th>ID</th>
     <th>First Name</th>
     <th>Last Name</th>
     <th>E-mail</th>
     <th>Phone</th>
     <th colspan="2" align="center">Actions</th>
     </tr>
     <?php
      $query = "SELECT * FROM tbl_users";       
      $records_per_page=4;
      $newquery = $crud->paging($query,$records_per_page);
      $crud->dataview($newquery);
      ?>
    <tr>
        <td colspan="7" align="center">
    <div class="pagination-wrap">
            <?php $crud->paginglink($query,$records_per_page); ?>
         </div>
        </td>
    </tr>
 
</table>
   
       
</div>

<?php include_once 'footer.php'; ?>