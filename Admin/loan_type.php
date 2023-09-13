<title>Types of Loan | LM System </title>
 <?php 
    include 'sidebar.php';
 ?>

 <div id="layoutSidenav_content">
    <main>
        <div class="container-fluid px-4">
        <h4 class="mt-4">Types of Loan</h4>
        <div class="card mb-4">
                <div class="card-header">
                    <!-- <i class="fas fa-table me-1"></i>
                    Types of Loan -->
                    <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="bi bi-plus-square"></i> Add new</button>
                </div>

                <div class="card-body">
                    <table id="datatablesSimple">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Loan Image</th>
                                <th>Loan name</th> 
                                <th>Loan description</th>    
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                              $i = 1;
                              include("../config.php");
                              $query ="SELECT * FROM loan_types";
                              $result = mysqli_query($conn,$query);
                              while($row = mysqli_fetch_assoc($result))
                               {

                             ?>
                              <tr>
                                  <td><?php echo $i++; ?></td>
                                  <td>
                                      <img src="../images-loan/<?php echo $row["loan_image"];?>" alt="" width="70">
                                  </td>
                                  <td><?php echo $row["loan_name"];?></td>
                                  <td><?php echo $row["loan_description"];?></td>
                                  <td>
                                    <button class="btn btn-success" data-bs-toggle="modal" type="button" data-bs-target="#update_loan<?php echo $row['loan_Id']; ?>"><i class="bi bi-pencil-square"></i> </button>
                                    <button class="btn btn-danger" data-bs-toggle="modal" type="button" data-bs-target="#delete_loan<?php echo $row['loan_Id']; ?>"><i class="bi bi-trash"></i> </button>
                                  </td>  

                                  <?php include 'loan_type_update.php';  ?>             
                            </tr>
                            <?php  
                                include 'loan_type_delete.php'; 
                               }    
                            ?>

                        </tbody>
                    </table>
                </div>
                 <?php include 'loan_type_create.php'; ?>
            </div>
        </div>
    </main>

    <?php include 'footer.php'; ?>

</div>
<script>

   function getImagePreview(event)
  {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('preview');
    var newimg=document.createElement('img');
    var text=document.createElement('p');
    text.innerHTML='Image preview';
    text.style['position']="relative";
    text.style['margin-left']="175px";
    text.style['margin-top']="10px";
    text.style['font-weight']="bold";
    imagediv.innerHTML='';
    newimg.src=image;
    newimg.width="90";
    newimg.height="90";
    newimg.style['border-radius']="50%";
    newimg.style['display']="block";
    newimg.style['margin-left']="auto";
    newimg.style['margin-right']="auto";
    newimg.style['box-shadow']="rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    imagediv.appendChild(newimg);
    imagediv.appendChild(text);
  }


  function updategetImagePreview(event)
  {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('updatepreview');
    var newimg=document.createElement('img');
    var text=document.createElement('p');
    text.innerHTML='Image preview';
    text.style['position']="relative";
    text.style['margin-left']="175px";
    text.style['margin-top']="10px";
    text.style['font-weight']="bold";
    imagediv.innerHTML='';
    newimg.src=image;
    newimg.width="90";
    newimg.height="90";
    newimg.style['border-radius']="50%";
    newimg.style['display']="block";
    newimg.style['margin-left']="auto";
    newimg.style['margin-right']="auto";
    newimg.style['box-shadow']="rgba(100, 100, 111, 0.2) 0px 7px 29px 0px";
    imagediv.appendChild(newimg);
    imagediv.appendChild(text);
  }

</script>


<!-- DO NOT DELETE END DIV TAG -->
    </div>
<!-- DO NOT DELETE END DIV TAG -->