<?php

   echo '    <!-- NAV -->
   <nav class="navbar navbar-dark bg-transparent navbar-expand-md py-2" id="main-nav">
       <div class="container">
           <a href="main.php" class="navbar-brand mr-auto">
               <img src="./images/Logo/logo1.png" width="250" height="100" alt="" class="img-fluid">
           </a>

           <button role="button" class="navbar-toggler" data-toggle="collapse" data-target="#idcollapse">
               <span class="navbar-toggler-icon"></span>
           </button>
           <div class="collapse navbar-collapse" id="idcollapse">
               <ul class="navbar-nav ml-auto">
                   <li class="nav-item">
                       <a href="main.php" class="nav-link">Home</a>
                   </li>
                   <li class="nav-item">
                   <a href="watchlist.php" class="nav-link">'. $_SESSION['username'] . ' Watchlist</a>
                   </li>
                   <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="'. $_SESSION['userimage'] .'" width="75" height="75" alt="" class="img-fluid">
                        </a>
                   <div class="dropdown-menu">
                     <a class="dropdown-item" href="restAccount.php">Update/Delete Account</a>
                     <a class="dropdown-item" href="#">Something</a>
                     <a class="dropdown-item" href="#">Something else here</a>
                     <div class="dropdown-divider"></div>
                     <a class="dropdown-item" href="signout.php">Sign Out</a>
                   </div>
                 </li>
               </ul>
           </div>
           <form action="search.php" method="POST">
           <input type ="text" name ="search" placeholder="Search" required class="form-control" style="display:inline; width:70%;height:35px;margin-top:7px;margin: 2px 5px 2px -3px">
           <button type="submit" name="submit_search" class="btn btn-primary"style="margin-top:-3px" ><i class="fas fa-search"></i></button>
           </form>
       </div>
   </nav>';
?>
