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
                   <a href="watchlist.php" class="nav-link"> Watchlist</a>
                   </li>
                   <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
                            <img src="'. $_SESSION['userimage'] .'" width="30" height="30" alt="" class="img-fluid rounded">
                        </a>
                   <div class="dropdown-menu">
                     <a class="dropdown-item" href="restAccount.php">Update/Delete Account</a>'; 
                     if(($_SESSION['username'] == 'Rasha') || ($_SESSION['username'] == 'Natalie') || ($_SESSION['username'] == 'Ljubica') || ($_SESSION['username'] == 'Andjelka') || ($_SESSION['username'] == 'Nesa')){
                        echo      
                    '<a class="dropdown-item" href="#">Add movie in database</a>
                    <a class="dropdown-item" href="#">View all users</a>
                    <a class="dropdown-item" href="#">View users movie statistics</a>
                    <a class="dropdown-item" href="#">Something</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="signout.php">Sign Out</a>
                    </div>
                </li>
                <li>
                <form action="search.php" method="POST">
                <input type ="text" name ="search" placeholder="Search" required class="form-control" style="display:inline; width:70%;height:35px;margin-top:7px">
                <button type="submit" name="submit_search" class="btn btn-primary"style="margin-top:-3px" ><i class="fas fa-search"></button>
                </form>
            </li>
                </ul>
            </div>
        </div>
    </nav>';
                     } else {
                        echo
                    '<a class="dropdown-item" href="#">Something</a>
                    <a class="dropdown-item" href="#">Something else here</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="signout.php">Sign Out</a>
                    </div>
                </li>
                <li>
                <form action="search.php" method="POST">
                <input type ="text" name ="search" placeholder="Search" required class="form-control" style="display:inline; width:70%;height:35px;margin-top:7px">
                <button type="submit" name="submit_search" class="btn btn-primary"style="margin-top:-3px" >Search</button>
                </form>
            </li>
                </ul>
            </div>
        </div>
    </nav>';
    }




   ?>
