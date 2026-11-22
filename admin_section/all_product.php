<?php
include('../function/function.php');


if (!isset($_SESSION['username'])) {
  header('location: login');
}

function format_date($date){
        return date('D, M jS Y', strtotime($date));
    }
?>
<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from www.ansonika.com/sparker/admin_section/listings.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Dec 2018 07:14:58 GMT -->
<?php include ('include/header.php'); ?>
		<div class="box_general">
			<div class="header_box">
				<h2 class="d-inline-block">Todos os pedidos</h2>
				
			</div>
			<div class="list_general">
			    <div class="container table-responsive">
			   <table class="table" id="table_id">
  <thead class="thead-dark">
    <tr>
      
      <th scope="col">Numero do Pedido</th>
      
      <th scope="col">Remetente</th>
      <th scope="col">Destinatario</th>
      <th scope="col">Data</th>
      <th scope="col">Status</th>
      <th scope="col">Ação</th>
    </tr>
  </thead>
  <tbody>
      
      <?php 
                                      
                                    //get online payment
                                    $get_product=mysqli_query($conn, "SELECT * FROM shipping ORDER BY id desc");
                                    while($row_payment=mysqli_fetch_array($get_product)){ 
                                    ?>
    <tr>
      <th scope="row"><?php echo $row_payment['tracking_num']  ?></th>
      
      <td><?php echo $row_payment['s_name']  ?></td>
      <td><?php echo $row_payment['r_name']  ?></td>
      <td><?php echo $row_payment['date_created2']  ?></td>
      <td><?php echo $row_payment['status'] ?></td>
      <td>
        
        <a href="edit_product?id=<?php echo $row_payment['id']  ?>" class="btn btn-sm btn-warning">Editar</a> <a href="all_product?del=<?php echo $row_payment['id']; ?>&tracking_num=<?php echo $row_payment['tracking_num']; ?>"
   onclick="return confirm('Você quer mesmo deletar?');"
   class="btn btn-sm btn-danger">
   Delete
</a>
    </tr>
    
      <?php } ?>
                                
                                         
                            
   
  </tbody>
</table>
                
                </div>
			
			</div>
		</div>
	
	  </div>
	  <!-- /container-fluid-->
   	</div>
    <!-- /container-wrapper-->
    <?php include('include/footer.php');

  if(isset($_GET['del'])){

    $id = $_GET['del'];
    $tracking_num = $_GET['tracking_num'];

    $ck = mysqli_query($conn, "SELECT * FROM `shipping` WHERE id = '$id'");
    $ftch = mysqli_fetch_array($ck);

    $sql = "DELETE FROM shipping WHERE id = '$id'";
    $result = $conn->query($sql);

    $sql2 = "DELETE FROM orders WHERE n_track = '$tracking_num'";
    $result2 = $conn->query($sql2);

    echo "<script>alert('A entrega $tracking_num foi deletada.');</script>";
    echo "<script>window.open('all_product','_self');</script>";
}

      if(isset($_GET['stock'])){
  
      $id=$_GET['stock'];

      $update_product="UPDATE products SET stock='1' WHERE product_id ='$id' ";
      $sql= mysqli_query($conn, $update_product);
       
      echo "<script>alert('Pedido atualizado.')</script>";
          echo "<script>window.open('all_product','_self')</script>";
      }

      if(isset($_GET['stock1'])){
  
      $id=$_GET['stock1'];

      $update_product="UPDATE products SET stock='0' WHERE product_id ='$id' ";
      $sql= mysqli_query($conn, $update_product);
       
      echo "<script>alert('Pedido atualizado.')</script>";
          echo "<script>window.open('all_product','_self')</script>";
      }
     ?>
	
</body>

<!-- Mirrored from www.ansonika.com/sparker/admin_section/listings.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 25 Dec 2018 07:14:58 GMT -->
</html>
