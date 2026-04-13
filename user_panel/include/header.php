
      <nav class="app-header navbar navbar-expand bg-body">
        <!--begin::Container-->
        <div class="container-fluid">
          <!--begin::Start Navbar Links-->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
                <i class="bi bi-list"></i>
              </a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="#" class="nav-link">Home</a>
            </li>
            <li class="nav-item d-none d-md-block">
              <a href="#" class="nav-link">Contact</a>
            </li>
          </ul>
          <!--end::Start Navbar Links-->

          <!--begin::End Navbar Links-->
          <ul class="navbar-nav ms-auto">
            <!--begin::Navbar Search-->
 <li class="nav-item search-box">
  <form  method="POST" class="search-form">
    <!-- Input Field -->
    <input type="text" name="search_query" class="search-input" placeholder="Search your bus" required>
    
    <!-- Lens Icon as Submit Button -->
    <button type="submit" name="search_btn" class="search-toggle" style="background:none; border:none; padding:0; cursor:pointer;">
      <i class="bi bi-search"></i>
    </button>
  </form>
</li>



            <!--end::Navbar Search-->

            <!--begin::Messages Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-chat-text"></i>
                <span class="navbar-badge badge text-bg-danger">3</span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="./assets/img/user1-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Brad Diesel
                        <span class="float-end fs-7 text-danger"
                          ><i class="bi bi-star-fill"></i
                        ></span>
                      </h3>
                      <p class="fs-7">Call me whenever you can...</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="./assets/img/user8-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        John Pierce
                        <span class="float-end fs-7 text-secondary">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">I got your message bro</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <!--begin::Message-->
                  <div class="d-flex">
                    <div class="flex-shrink-0">
                      <img
                        src="./assets/img/user3-128x128.jpg"
                        alt="User Avatar"
                        class="img-size-50 rounded-circle me-3"
                      />
                    </div>
                    <div class="flex-grow-1">
                      <h3 class="dropdown-item-title">
                        Nora Silvester
                        <span class="float-end fs-7 text-warning">
                          <i class="bi bi-star-fill"></i>
                        </span>
                      </h3>
                      <p class="fs-7">The subject goes here</p>
                      <p class="fs-7 text-secondary">
                        <i class="bi bi-clock-fill me-1"></i> 4 Hours Ago
                      </p>
                    </div>
                  </div>
                  <!--end::Message-->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
              </div>
            </li>
            <!--end::Messages Dropdown Menu-->
<?php
include("config/connection.php");

$user_id = $_SESSION['user_id'];

$query = mysqli_query($connection, "SELECT COUNT(*) as total FROM booking_table WHERE user_id='$user_id'");
$row = mysqli_fetch_assoc($query);
$total = $row['total'];
?>


            <!--begin::Notifications Dropdown Menu-->
            <li class="nav-item dropdown">
              <a class="nav-link" data-bs-toggle="dropdown" href="#">
                <i class="bi bi-bell-fill"></i>
                <span class="navbar-badge badge text-bg-warning"><?=$row['total']?></span>
              </a>
              <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-envelope me-2"></i> 4 new messages
                  <span class="float-end text-secondary fs-7">3 mins</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-people-fill me-2"></i> 8 friend requests
                  <span class="float-end text-secondary fs-7">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                  <i class="bi bi-file-earmark-fill me-2"></i> 3 new reports
                  <span class="float-end text-secondary fs-7">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer"> See All Notifications </a>
              </div>
            </li>
            <!--end::Notifications Dropdown Menu-->

            <!--begin::Fullscreen Toggle-->
            <li class="nav-item">
              <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
              </a>
            </li>
            <!--end::Fullscreen Toggle-->

            <!--begin::User Menu Dropdown-->
            <li class="nav-item dropdown user-menu">
              <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                <img
                  src="./assets/img/user2-160x160.jpg"
                  class="user-image rounded-circle shadow"
                  alt="User Image"
                />
                <span class="d-none d-md-inline"><?=$_SESSION['user_name']?></span>
              </a>
             <!-- Dropdown Menu Styling -->
<style>
  .user-header {
    padding: 20px;
    text-align: center;
    background: linear-gradient(135deg, #0d6efd, #0a58ca);
  }
  .user-header img {
    width: 85px;
    height: 85px;
    border: 3px solid rgba(255,255,255,0.2);
    margin-bottom: 10px;
  }
  .user-header p {
    margin: 0;
    font-weight: 600;
  }
  .user-data-list {
    padding: 10px 0;
    list-style: none;
    margin: 0;
  }

  .user-data-item {
    padding: 8px 20px;
    display: flex;
    align-items: center;
    border-bottom: 1px solid #f4f4f4;
  }
  .user-data-item:last-child { border: none; }
  .user-data-item i {
    width: 25px;
    color: #0d6efd;
    font-size: 14px;
  }
  .search-box {
  display: flex;
  align-items: center;
  justify-content: flex-end;
}

.search-form {
  position: relative;
  display: flex;
  align-items: center;
  background: #f1f1f1;
  border-radius: 40px;
  width: 45px; /* Default choti width */
  height: 40px; 
  transition: width 0.5s cubic-bezier(0.4, 0, 0.2, 1);
  overflow: hidden;
  cursor: pointer; /* Icon/Bar par cursor pointer dikhega */
}

/* Jab click ya focus ho (Badi Width) */
.search-form:focus-within {
  width: 500px; /* Width ko aur badha diya gaya hai */
  background: 128, 128, 128;
  border: 1px solid 224,224,224; /* Optional: Blue border focus par */
  box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.search-input {
  width: 100%;
  height: 100%;
  border: none;
  background: transparent;
  outline: none;
  padding-left: 15px;
  padding-right: 45px; /* Icon ke liye space */
  font-size: 14px;
  opacity: 0;
  transition: opacity 0.3s ease;
}

.search-form:focus-within .search-input {
  opacity: 1;
}

.search-toggle {
  position: absolute;
  right: 0;
  width: 45px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  color: #555;
  pointer-events: none; /* Click seedha input field par jayega */
}

.bi-search {
  font-size: 1.2rem;
}

  .user-data-text {
    font-size: 13px;
    color: #555;
  }
  .user-data-label {
    display: block;
    font-size: 10px;
    text-transform: uppercase;
    color: #999;
    font-weight: bold;
  }
  .user-footer {
    background-color: #f8f9fa;
    padding: 10px 15px;
  }
</style>

<ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end shadow-lg border-0">
    <!-- Header: Photo & ID -->
    <li class="user-header text-white">
        <img src="./assets/img/user2-160x160.jpg" class="rounded-circle shadow-sm" alt="User">
        <p>
            <?= htmlspecialchars($_SESSION['user_name']) ?>
            <br>
            <small class="badge bg-light text-primary mt-2">ID: #<?= $_SESSION['user_id'] ?></small>
        </p>
    </li>

    <!-- Body: Contact Details -->
    <li class="user-body p-0">
        <div class="user-data-list">
            <!-- Email -->
            <div class="user-data-item">
                <i class="bi bi-envelope-fill"></i>
                <div class="user-data-text">
                    <span class="user-data-label">Email Address</span>
                    <?= htmlspecialchars($_SESSION['email_id'] ?? 'guest' )?>
                </div>
            </div>
            <!-- Contact -->
            <div class="user-data-item">
                <i class="bi bi-telephone-fill"></i>
                <div class="user-data-text">
                    <span class="user-data-label">Phone Number</span>
                    <?= htmlspecialchars($_SESSION['user_contact'] ?? 'Not Provided') ?>
                </div>
            </div>
        </div>
    </li>
    <!-- Footer: Actions -->
    <li class="user-footer d-flex justify-content-between">
        <a href="user_profile.php" class="btn btn-sm btn-primary px-3">
            <i class="bi bi-person-gear"></i> Profile
        </a>
        <a href="user_logout.php" class="btn btn-sm btn-outline-danger px-3">
            <i class="bi bi-box-arrow-right"></i> Sign out
        </a>
    </li>
</ul>
            </li>
            <!--end::User Menu Dropdown-->
          </ul>
          <!--end::End Navbar Links-->
        </div>
        <!--end::Container-->
      </nav>