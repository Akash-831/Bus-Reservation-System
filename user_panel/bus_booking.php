<?php
include("config/connection.php");
session_start();
date_default_timezone_set('Asia/Kolkata');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/Exception.php';
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';

if(isset($_POST['submit'])){

    $user_name    = trim($_POST['user_name']);
    $email        = trim($_POST['email']);
    $age          = trim($_POST['age']);
    $gender       = trim($_POST['gender']);
    $from_des     = trim($_POST['from_des']);
    $destination  = trim($_POST['destination']);
    $travel_date  = trim($_POST['travel_date']);
    $bus_id       = (int)$_POST['bus_id'];
    $seats        = trim($_POST['seats']);
    $status       = "confirmed";
    $user_id      = $_SESSION['user_id'];

    // Get ticket price
    $bus_query = mysqli_query($connection, "SELECT ticket_price FROM bus_info WHERE id = $bus_id");
    $bus_data  = mysqli_fetch_assoc($bus_query);
    $price_per_seat = $bus_data['ticket_price'] ?? 0;

    $seatArray  = explode(",", $seats);
    $seat_count = count($seatArray);
    $total_price = $price_per_seat * $seat_count;

    // Insert Booking
    $insert = "INSERT INTO booking_table 
    (user_name, email, age, gender, from_des, destination, travel_date, status, user_id, bus_id, ticket_price)
    VALUES 
    ('$user_name','$email','$age','$gender','$from_des','$destination','$travel_date','$status','$user_id','$bus_id','$total_price')";

    $run = mysqli_query($connection, $insert);

    if($run){

        $mail = new PHPMailer(true);

        try{
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;
            $mail->Username   = 'nakki831@gmail.com';
            $mail->Password   = 'azzugokkqaoqmiuv';
            $mail->SMTPSecure = 'tls';
            $mail->Port       = 587;
            $mail->SMTPDebug  = 0;   // Production mein 0 rakho

            $mail->setFrom('nakki831@gmail.com', 'BusGo');
            $mail->addAddress($email, $user_name);

            $mail->isHTML(true);
            $mail->Subject = '🎟️ Your Bus Booking is Confirmed - BusGo';

            $mail->Body = '
            <!DOCTYPE html>
            <html>
            <head>
                <meta charset="utf-8">
                <style>
                    @import url("https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap");
                    body { font-family: "Inter", sans-serif; }
                </style>
            </head>
            <body style="margin:0; padding:40px 0; background:#0f172a;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td align="center">
                            <table width="640" cellpadding="0" cellspacing="0" style="background:#1e2937; border-radius:24px; overflow:hidden; box-shadow:0 20px 60px rgba(0,0,0,0.5);">
                                
                                <!-- Bus Header -->
                                <tr>
                                    <td style="background: linear-gradient(135deg, #1e40af, #3b82f6); padding:45px 40px; text-align:center;">
                                        <div style="font-size:52px; margin-bottom:10px;">🚌</div>
                                        <h1 style="color:white; margin:0; font-size:30px; font-weight:700;">BusGo</h1>
                                        <p style="color:#bae6fd; margin:8px 0 0 0; font-size:18px;">Your Journey is Confirmed</p>
                                    </td>
                                </tr>
                                
                                <!-- Success -->
                                <tr>
                                    <td style="padding:40px 40px 20px; text-align:center;">
                                        <h2 style="color:#e0f2fe; margin:0 0 10px 0; font-size:26px;">🎉 Booking Confirmed!</h2>
                                        <p style="color:#94a3b8; font-size:17px;">Dear <strong>'.$user_name.'</strong>, your seats are reserved.</p>
                                    </td>
                                </tr>
                                
                                <!-- Ticket Style Card -->
                                <tr>
                                    <td style="padding:0 40px 40px;">
                                        <table width="100%" style="background:#0f172a; border:2px solid #60a5fa; border-radius:16px; padding:30px;" cellpadding="0">
                                            
                                            <!-- Route -->
                                            <tr>
                                                <td style="text-align:center; padding-bottom:25px;">
                                                    <p style="color:#60a5fa; font-size:18px; font-weight:600; margin:0;">
                                                        '.$from_des.' 
                                                        <span style="color:#64748b; font-size:24px;"> → </span> 
                                                        '.$destination.'
                                                    </p>
                                                </td>
                                            </tr>
                                            
                                            <!-- Details -->
                                            <tr>
                                                <td>
                                                    <table width="100%" cellpadding="10" style="color:#e2e8f0;">
                                                        <tr>
                                                            <td style="color:#94a3b8; width:45%;">Travel Date</td>
                                                            <td style="text-align:right; font-weight:600;">'.date("d F Y", strtotime($travel_date)).'</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="color:#94a3b8;">Seats Booked</td>
                                                            <td style="text-align:right; font-weight:600;">'.$seats.' <span style="color:#60a5fa;">('.$seat_count.' Seats)</span></td>
                                                        </tr>
                                                        <tr>
                                                            <td style="color:#94a3b8;">Price per Seat</td>
                                                            <td style="text-align:right; font-weight:600;">₹ '.number_format($price_per_seat).'</td>
                                                        </tr>
                                                        <tr style="border-top:1px dashed #475569;">
                                                            <td style="color:#94a3b8; padding-top:15px;">Total Amount</td>
                                                            <td style="text-align:right; font-weight:700; font-size:22px; color:#67e8f9; padding-top:15px;">
                                                                ₹ '.number_format($total_price).'
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                
                                <!-- CTA Button -->
                                <tr>
                                    <td align="center" style="padding:0 40px 45px;">
                                        <a href="https://yourwebsite.com/view_bus_booking.php" 
                                           style="background:linear-gradient(135deg, #3b82f6, #60a5fa); color:white; padding:16px 48px; 
                                                  border-radius:50px; text-decoration:none; font-weight:600; font-size:16.5px; 
                                                  display:inline-block; box-shadow:0 10px 25px rgba(59,130,246,0.3);">
                                            View Full Booking Details
                                        </a>
                                    </td>
                                </tr>
                                
                                <!-- Footer -->
                                <tr>
                                    <td style="background:#0f172a; padding:35px 40px; text-align:center; color:#64748b; font-size:14px; border-top:1px solid #334155;">
                                        Thank you for booking with <strong style="color:#60a5fa;">BusGo</strong><br>
                                        Safe Travels • Comfortable Journey Awaits You 🛤️
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </body>
            </html>';

            $mail->send();

            $_SESSION['booking_success'] = "Your booking has been confirmed successfully!";
            header("location: view_bus_booking.php");
            exit();

        }
        catch(Exception $e){
            echo "<script>alert('Booking saved but confirmation email could not be sent.');</script>";
            header("location: view_bus_booking.php");
            exit();
        }
    }
    else {
        echo "<script>alert('Failed to confirm booking. Please try again.');</script>";
    }
}
?>
<!doctype html>
<html lang="en">
  <!--begin::Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AdminLTE v4 | Dashboard</title>

    <!--begin::Accessibility Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes" />
    <meta name="color-scheme" content="light dark" />
    <meta name="theme-color" content="#007bff" media="(prefers-color-scheme: light)" />
    <meta name="theme-color" content="#1a1a1a" media="(prefers-color-scheme: dark)" />
    <!--end::Accessibility Meta Tags-->

    <!--begin::Primary Meta Tags-->
    <meta name="title" content="AdminLTE v4 | Dashboard" />
    <meta name="author" content="ColorlibHQ" />
    <meta
      name="description"
      content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS. Fully accessible with WCAG 2.1 AA compliance."
    />
    <meta
      name="keywords"
      content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard, accessible admin panel, WCAG compliant"
    />
    <!--end::Primary Meta Tags-->

    <!--begin::Accessibility Features-->
    <!-- Skip links will be dynamically added by accessibility.js -->
    <meta name="supported-color-schemes" content="light dark" />
    <link rel="preload" href="./css/adminlte.css" as="style" />
    <!--end::Accessibility Features-->

    <!--begin::Fonts-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
      integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q="
      crossorigin="anonymous"
      media="print"
      onload="this.media = 'all'"
    />
    <!--end::Fonts-->

    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/styles/overlayscrollbars.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(OverlayScrollbars)-->

    <!--begin::Third Party Plugin(Bootstrap Icons)-->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css"
      crossorigin="anonymous"
    />
    <!--end::Third Party Plugin(Bootstrap Icons)-->

    <!--begin::Required Plugin(AdminLTE)-->
    <link rel="stylesheet" href="./css/adminlte.css" />
    <!--end::Required Plugin(AdminLTE)-->

    <!-- apexcharts -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
      integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0="
      crossorigin="anonymous"
    />

    <!-- jsvectormap -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
      integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4="
      crossorigin="anonymous"
    />
  </head>
  <!--end::Head-->
  <!--begin::Body-->
  <body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
    <!--begin::App Wrapper-->
    <div class="app-wrapper">
      <!--begin::Header-->
<?php
  include("include/header.php");
?>
      <!--end::Header-->
      <!--begin::Sidebar-->
   <?php
  include("include/sidebar.php");
?>
      <!--end::Sidebar-->
      <!--begin::App Main-->
      <main class="app-main">

<!-- FORM UI START -->
<style>
/* (your same CSS — unchanged) */
.booking-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #0f172a;
    font-family: 'Inter', sans-serif;
    padding: 20px;
}

.glass-form {
    background: #1e293b;
    width: 100%;
    max-width: 500px;
    padding: 30px;
    border-radius: 24px;
    border: 1px solid #334155;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
}

.glass-form h3 {
    color: #f8fafc;
    margin-bottom: 25px;
    text-align: center;
}

.grid-layout {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 15px;
}

.full-row { grid-column: span 2; }

.input-field input, .input-field select {
    width: 100%;
    background: #0f172a;
    border: 2px solid #334155;
    border-radius: 12px;
    padding: 12px;
    color: #f1f5f9;
}

.submit-btn {
    width: 100%;
    margin-top: 20px;
    background: linear-gradient(135deg, #38bdf8, #2563eb);
    color: white;
    border: none;
    padding: 14px;
    border-radius: 12px;
    cursor: pointer;
}
</style>

<div class="booking-wrapper">
    <div class="glass-form">
        <h3>✨ Premium Booking</h3>

        <form method="post" class="grid-layout">

            <!-- Hidden fields (IMPORTANT) -->
            <input type="hidden" name="bus_id" value="<?= $_POST['bus_id'] ?? 1 ?>">
            <input type="hidden" name="seats" value="<?= $_POST['seats'] ?? '' ?>">

            <div class="input-field">
                <input type="text" name="user_name" placeholder="User Name" required>
            </div>

            <div class="input-field">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>

            <div class="input-field">
                <input type="number" name="age" placeholder="Age" required>
            </div>

            <div class="input-field">
                <select name="gender">
                    <option disabled selected>Gender</option>
                    <option>Male</option>
                    <option>Female</option>
                </select>
            </div>
<?php
$id = $_SESSION['bus_id'];
$select1 = "select * from bus_info where id='$id'";
$run1 = mysqli_query($connection, $select1);
$array = mysqli_fetch_array($run1);
?>
            <div class="input-field">
                <input type="text" name="from_des" value="<?=$array['from_city']?>" readonly>
            </div>

            <div class="input-field">
                <input type="text" name="destination" value="<?=$array['to_city']?>" readonly>
            </div>

            <div class="input-field full-row">
                <input type="date" name="travel_date" required>
            </div>

            <div class="full-row">
                <button type="submit" name="submit" class="submit-btn">
                    Confirm My Trip
                </button>
            </div>

        </form>
    </div>
</div>

      </main>
      <!--end::App Main-->
      <!--begin::Footer-->
      <footer class="app-footer">
        <!--begin::To the end-->
        <div class="float-end d-none d-sm-inline">Anything you want</div>
        <!--end::To the end-->
        <!--begin::Copyright-->
        <strong>
          Copyright &copy; 2014-2025&nbsp;
          <a href="https://adminlte.io" class="text-decoration-none">AdminLTE.io</a>.
        </strong>
        All rights reserved.
        <!--end::Copyright-->
      </footer>
      <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
    <!--begin::Third Party Plugin(OverlayScrollbars)-->
    <script
      src="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.11.0/browser/overlayscrollbars.browser.es6.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Third Party Plugin(OverlayScrollbars)--><!--begin::Required Plugin(popperjs for Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(popperjs for Bootstrap 5)--><!--begin::Required Plugin(Bootstrap 5)-->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.min.js"
      crossorigin="anonymous"
    ></script>
    <!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
    <script src="./js/adminlte.js"></script>
    <!--end::Required Plugin(AdminLTE)--><!--begin::OverlayScrollbars Configure-->
    <script>
      const SELECTOR_SIDEBAR_WRAPPER = '.sidebar-wrapper';
      const Default = {
        scrollbarTheme: 'os-theme-light',
        scrollbarAutoHide: 'leave',
        scrollbarClickScroll: true,
      };
      document.addEventListener('DOMContentLoaded', function () {
        const sidebarWrapper = document.querySelector(SELECTOR_SIDEBAR_WRAPPER);

        // Disable OverlayScrollbars on mobile devices to prevent touch interference
        const isMobile = window.innerWidth <= 992;

        if (
          sidebarWrapper &&
          OverlayScrollbarsGlobal?.OverlayScrollbars !== undefined &&
          !isMobile
        ) {
          OverlayScrollbarsGlobal.OverlayScrollbars(sidebarWrapper, {
            scrollbars: {
              theme: Default.scrollbarTheme,
              autoHide: Default.scrollbarAutoHide,
              clickScroll: Default.scrollbarClickScroll,
            },
          });
        }
      });
    </script>
    <!--end::OverlayScrollbars Configure-->

    <!-- OPTIONAL SCRIPTS -->

    <!-- sortablejs -->
    <script
      src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"
      crossorigin="anonymous"
    ></script>

    <!-- sortablejs -->
    <script>
      new Sortable(document.querySelector('.connectedSortable'), {
        group: 'shared',
        handle: '.card-header',
      });

      const cardHeaders = document.querySelectorAll('.connectedSortable .card-header');
      cardHeaders.forEach((cardHeader) => {
        cardHeader.style.cursor = 'move';
      });
    </script>

    <!-- apexcharts -->
    <script
      src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js"
      integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8="
      crossorigin="anonymous"
    ></script>

    <!-- ChartJS -->
    <script>
      // NOTICE!! DO NOT USE ANY OF THIS JAVASCRIPT
      // IT'S ALL JUST JUNK FOR DEMO
      // ++++++++++++++++++++++++++++++++++++++++++

      const sales_chart_options = {
        series: [
          {
            name: 'Digital Goods',
            data: [28, 48, 40, 19, 86, 27, 90],
          },
          {
            name: 'Electronics',
            data: [65, 59, 80, 81, 56, 55, 40],
          },
        ],
        chart: {
          height: 300,
          type: 'area',
          toolbar: {
            show: false,
          },
        },
        legend: {
          show: false,
        },
        colors: ['#0d6efd', '#20c997'],
        dataLabels: {
          enabled: false,
        },
        stroke: {
          curve: 'smooth',
        },
        xaxis: {
          type: 'datetime',
          categories: [
            '2023-01-01',
            '2023-02-01',
            '2023-03-01',
            '2023-04-01',
            '2023-05-01',
            '2023-06-01',
            '2023-07-01',
          ],
        },
        tooltip: {
          x: {
            format: 'MMMM yyyy',
          },
        },
      };

      const sales_chart = new ApexCharts(
        document.querySelector('#revenue-chart'),
        sales_chart_options,
      );
      sales_chart.render();
    </script>

    <!-- jsvectormap -->
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js"
      integrity="sha256-/t1nN2956BT869E6H4V1dnt0X5pAQHPytli+1nTZm2Y="
      crossorigin="anonymous"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js"
      integrity="sha256-XPpPaZlU8S/HWf7FZLAncLg2SAkP8ScUTII89x9D3lY="
      crossorigin="anonymous"
    ></script>

    <!-- jsvectormap -->
    <script>
      // World map by jsVectorMap
      new jsVectorMap({
        selector: '#world-map',
        map: 'world',
      });

      // Sparkline charts
      const option_sparkline1 = {
        series: [
          {
            data: [1000, 1200, 920, 927, 931, 1027, 819, 930, 1021],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline1 = new ApexCharts(document.querySelector('#sparkline-1'), option_sparkline1);
      sparkline1.render();

      const option_sparkline2 = {
        series: [
          {
            data: [515, 519, 520, 522, 652, 810, 370, 627, 319, 630, 921],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline2 = new ApexCharts(document.querySelector('#sparkline-2'), option_sparkline2);
      sparkline2.render();

      const option_sparkline3 = {
        series: [
          {
            data: [15, 19, 20, 22, 33, 27, 31, 27, 19, 30, 21],
          },
        ],
        chart: {
          type: 'area',
          height: 50,
          sparkline: {
            enabled: true,
          },
        },
        stroke: {
          curve: 'straight',
        },
        fill: {
          opacity: 0.3,
        },
        yaxis: {
          min: 0,
        },
        colors: ['#DCE6EC'],
      };

      const sparkline3 = new ApexCharts(document.querySelector('#sparkline-3'), option_sparkline3);
      sparkline3.render();
    </script>
    <!--end::Script-->
  </body>
  <!--end::Body-->
</html>
