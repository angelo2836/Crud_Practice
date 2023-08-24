 <?php
        $conn = mysqli_connect('localhost:3306', 'root', '', 'crud');
        ?>
 <!DOCTYPE html>
 <html lang="en">

 <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Document</title>
         <style>
                 * {
                         box-sizing: border-box;
                 }

                 #myInput {
                         background-image: url('/css/searchicon.png');
                         background-position: 10px 10px;
                         background-repeat: no-repeat;
                         width: 100%;
                         font-size: 16px;
                         padding: 12px 20px 12px 40px;
                         border: 1px solid #ddd;
                         margin-bottom: 12px;
                 }

                 #myTable {
                         border-collapse: collapse;
                         width: 100%;
                         border: 1px solid #ddd;
                         font-size: 18px;
                 }

                 #myTable th,
                 #myTable td {
                         text-align: left;
                         padding: 12px;
                 }

                 #myTable tr {
                         border-bottom: 1px solid #ddd;
                 }

                 #myTable tr.header,
                 #myTable tr:hover {
                         background-color: #f1f1f1;
                 }
         </style>
 </head>

 <body>

         <form action="index.php?save=1" method="POST">

                 <input type="text" placeholder="name" name="thename" id="addI">
                 <input type="submit" id="addB" value="OK">
         </form>
         <!-- view list -->
         <input type="text" id="myInput" onkeyup="myFunction()" placeholder="Search for names.." title="Type in a name">
         <table id="myTable">

                 <tr class="header">
                         <th style="width:60%;">Name</th>
                         <th style="width:40%;">functions</th>
                 </tr>
                 <?php

                        $sql = "SELECT * FROM name";
                        $retval = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($retval) > 0) {
                                while ($row = mysqli_fetch_assoc($retval)) {
                                        $row['NUM'];
                        ?>

                                 <tr>



                                         <td><?php echo $row['fname']; ?></td>
                                         <td><a href="index.php?edit=<?php echo $row['NUM']; ?>"><input type="button" value="edit"></a>
                                                 <a href="index.php?delete=<?php echo $row['NUM']; ?>"><input type="button" value="delete"></a>
                                         </td>
                                 </tr>

                 <?php
                                }
                        }
                        ?>
         </table>
         <?php
                //edit 
                if (isset($_GET['edit'])) {
                ?><script>
                         var input_add = document.getElementById("addI");
                         var button_add = document.getElementById("addB");
                         input_add.style.display = "none";
                         button_add.style.display = "none";
                 </script>
                 <?php
                        $id = $_GET['edit'];
                        $sql = "SELECT * FROM name where NUM = $id ";
                        $retval = mysqli_query($conn, $sql);
                        if (mysqli_num_rows($retval) > 0) {
                                while ($row = mysqli_fetch_assoc($retval)) {
                        ?>
                                 <form action="index.php?update=<?php echo $id; ?>" method="POST">
                                         <input type="text" name="edited_name" value="<?php echo $row['fname']; ?>">
                                         <input type="submit" value="Update">
                                 </form>
                 <?php
                                }
                        }
                }

                //save
                if (isset($_GET['save'])) {
                        $name_add = $_POST['thename'];
                        echo $sql = "INSERT INTO name VALUES ('$name_add','')";
                        $retval = mysqli_query($conn, $sql);
                        ?>
                 <script type="text/javascript">
                         window.location = "index.php";
                 </script>
         <?php
                }
                ?>

         <!-- Update -->
         <?php

                if (isset($_GET['update'])) {

                        $name_edited = $_POST['edited_name'];
                        $id = $_GET['update'];

                        $sql = "UPDATE name SET fname = '$name_edited' WHERE NUM = $id ";
                        $retval = mysqli_query($conn, $sql);
                ?>
                 <script type="text/javascript">
                         window.location = "index.php";
                 </script>
         <?php
                }
                ?>
         <!-- Update -->
         <?php

                if (isset($_GET['delete'])) {

                        $id = $_GET['delete'];

                        $sql = "DELETE FROM name WHERE NUM = $id";
                        $retval = mysqli_query($conn, $sql);
                ?>
                 <script type="text/javascript">
                         window.location = "index.php";
                 </script>
         <?php
                }
                ?>



 </body>

 </html>
 <script>
         function myFunction() {
                 var input, filter, table, tr, td, i, txtValue;
                 input = document.getElementById("myInput");
                 filter = input.value.toUpperCase();
                 table = document.getElementById("myTable");
                 tr = table.getElementsByTagName("tr");
                 for (i = 0; i < tr.length; i++) {
                         td = tr[i].getElementsByTagName("td")[0];
                         if (td) {
                                 txtValue = td.textContent || td.innerText;
                                 if (txtValue.toUpperCase().indexOf(filter) > -1) {
                                         tr[i].style.display = "";
                                 } else {
                                         tr[i].style.display = "none";
                                 }
                         }
                 }
         }
 </script>