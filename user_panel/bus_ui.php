<?php
session_start();
include("config/connection.php");
$_SESSION['bus_id'] = $_GET['id'];
$id=$_SESSION['bus_id'];
$select = "select * from bus_info where id='$id'";
$run = mysqli_query($connection, $select);
$array = mysqli_fetch_array($run);
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
<?php
include("config/connection.php");

$id = intval($_GET['id']);

/* BUS DATA */
$select = "SELECT * FROM bus_info WHERE id=$id";
$run = mysqli_query($connection, $select);
$array = mysqli_fetch_assoc($run);

/* BOOKED SEATS */
$seatQuery = "SELECT seat_number FROM seat_table WHERE bus_id=$id";
$seatRun = mysqli_query($connection, $seatQuery);

$bookedSeats = [];
while($row = mysqli_fetch_assoc($seatRun)){
    $bookedSeats[] = (int)$row['seat_number'];
}

$totalSeats = $array['total_seat'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Bus Booking UI</title>

<style>

body {
  font-family: 'Segoe UI', sans-serif;
  background: linear-gradient(135deg, #eef2f7, #dbeafe);
  margin: 0;
}

.header {
  text-align: center;
  font-size: 26px;
  font-weight: 800;
  margin: 20px 0;
}

.container {
  max-width: 1100px;
  margin: auto;
  display: flex;
  gap: 30px;
  background: rgba(255,255,255,0.8);
  backdrop-filter: blur(10px);
  padding: 25px;
  border-radius: 18px;
  box-shadow: 0 15px 35px rgba(0,0,0,0.15);
}

.bus {
  width: 380px;
  background: #fff;
  border-radius: 50px 50px 20px 20px;
  padding: 18px;
  position: relative;
}

.bus::before {
  content: "";
  position: absolute;
  top: -22px;
  left: 50%;
  transform: translateX(-50%);
  width: 140px;
  height: 35px;
  background: linear-gradient(135deg, #2563eb, #1e40af);
  border-radius: 25px;
}

.driver {
  text-align: center;
  background: #2563eb;
  color: white;
  padding: 6px;
  border-radius: 6px;
  font-size: 12px;
  margin-bottom: 14px;
}

.seats {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 10px;
}

.aisle {
  grid-column: span 4;
  height: 10px;
}

.seat {
  height: 42px;
  background: #e5e7eb;
  border-radius: 10px;
  display: flex;
  align-items: center;
  justify-content: center;
  font-size: 12px;
  cursor: pointer;
}

.seat.selected {
  background: #22c55e;
  color: white;
}

.seat.booked {
  background: #ef4444;
  color: white;
  cursor: not-allowed;
}

.info {
  flex: 1;
}

.price {
  font-size: 24px;
  font-weight: bold;
  color: #16a34a;
}

.book-btn {
  display: block;
  margin-top: 18px;
  padding: 12px;
  background: linear-gradient(135deg, #ff5722, #ff9800);
  color: white;
  text-align: center;
  border-radius: 12px;
  font-weight: 700;
  text-decoration: none;
  cursor: pointer;
}

</style>
</head>

<body>

<div class="header">🚌 Bus Booking</div>

<div class="container">

  <div class="bus">
    <div class="driver">Driver</div>
    <div class="seats" id="seats"></div>
  </div>

  <div class="info">

    <div class="top">
      <div>
        <div class="bus-name"><?=$array['bus_model']?></div>
        <div><?=$array['from_city']?> → <?=$array['to_city']?></div>
      </div>

      <div class="price" id="totalPrice">₹<?=$array['ticket_price']?></div>
    </div>

    <p><b>Time:</b> <?=$array['Out_time']?> - <?=$array['reaching_time']?></p>

    <p>Selected Seats: <span id="selectedSeats">None</span></p>

<button type="button" class="book-btn" onclick="goToBooking()">Book Now</button>  </div>

</div>

<script>

const totalSeats = <?=$totalSeats?>;
const bookedSeats = <?= json_encode($bookedSeats) ?>;
const pricePerSeat = <?=$array['ticket_price']?>;

const seatsContainer = document.getElementById("seats");
const selectedSeatsText = document.getElementById("selectedSeats");
const totalPriceText = document.getElementById("totalPrice");

let selectedSeats = [];

/* CREATE SEATS */
for (let i = 1; i <= totalSeats; i++) {

  const seat = document.createElement("div");
  seat.classList.add("seat");

  seat.innerText = i;
  seat.dataset.number = i;

  // already booked
  if (bookedSeats.includes(i)) {
    seat.classList.add("booked");
  }

  seat.addEventListener("click", () => {

    if (seat.classList.contains("booked")) return;

    const number = parseInt(seat.dataset.number);

    seat.classList.toggle("selected");

    if (seat.classList.contains("selected")) {
      selectedSeats.push(number);
    } else {
      selectedSeats = selectedSeats.filter(n => n !== number);
    }

    selectedSeatsText.innerText =
      selectedSeats.length ? selectedSeats.join(", ") : "None";

    updatePrice();
  });

  seatsContainer.appendChild(seat);

  if (i % 4 === 0) {
    const gap = document.createElement("div");
    gap.classList.add("aisle");
    seatsContainer.appendChild(gap);
  }
}

function updatePrice() {
  totalPriceText.innerText = "₹" + (selectedSeats.length * pricePerSeat);
}

/* BOOK SEATS */
function bookSeats() {

  if (selectedSeats.length === 0) {
    alert("Select seats first");
    return;
  }

  fetch("book_seats.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json"
    },
    body: JSON.stringify({
      bus_id: <?=$id?>,
      seats: selectedSeats
    })
  })
  .then(res => res.json())
  .then(data => {
    alert(data.message);
    location.reload();
  });

}
function goToBooking() {

  if (selectedSeats.length === 0) {
    alert("Select seats first");
    return;
  }

  const form = document.createElement("form");
  form.method = "POST";
  form.action = "bus_booking.php";

  // bus_id
  const busInput = document.createElement("input");
  busInput.type = "hidden";
  busInput.name = "bus_id";
  busInput.value = "<?=$id?>";

  // selected seats
  const seatInput = document.createElement("input");
  seatInput.type = "hidden";
  seatInput.name = "seats";
  seatInput.value = selectedSeats.join(",");

  form.appendChild(busInput);
  form.appendChild(seatInput);

  document.body.appendChild(form);
  form.submit();
}

</script>

</body>
</html>
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


