<?php
include("config/connection.php");
session_start();
$id = $_GET['id'];
$select = "select * from booking_table where id='$id'";
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
   <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
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
      <main class="ticket-card">
   
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BusGo • E-Ticket</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
  
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
    
    body {
      font-family: 'Inter', system_ui, sans-serif;
    }

    .bus-bg {
      background-image: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.85)), 
                        url('https://picsum.photos/id/1015/2000/1200');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;
    }

    .glass {
      background: rgba(30, 41, 59, 0.85);
      backdrop-filter: blur(16px);
      -webkit-backdrop-filter: blur(16px);
      border: 1px solid rgba(148, 163, 184, 0.2);
    }
.ticket-card{
background-image: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.85)), 
                        url('https://picsum.photos/id/1015/2000/1200');
      background-size: cover;
      background-position: center;
      background-attachment: fixed;}
    .ticket-container {
      perspective: 1300px;
    }

    .ticket {
      transition: transform 0.9s cubic-bezier(0.25, 0.1, 0.25, 1);
      transform-style: preserve-3d;
    }

    #flip:checked ~ .ticket {
      transform: rotateY(180deg);
    }

    .front, .back {
      backface-visibility: hidden;
      position: absolute;
      width: 100%;
      height: 100%;
      border-radius: 28px;
      overflow: hidden;
      box-shadow: 0 30px 60px -15px rgba(0, 0, 0, 0.5);
    }

    .back {
      transform: rotateY(180deg);
    }

    .perforation {
      background: repeating-linear-gradient(
        90deg,
        rgba(148, 163, 184, 0.3),
        rgba(148, 163, 184, 0.3) 12px,
        transparent 12px,
        transparent 22px
      );
    }
  </style>
</head>
<body class="bus-bg min-h-screen flex items-center justify-center p-6">

  <div class="w-full max-w-[320px] mx-auto">

    <!-- Top Bar -->
    <div class="flex justify-between items-center mb-8 text-white">
      <div class="flex items-center gap-3">
        <div class="w-9 h-9 bg-gradient-to-br from-orange-400 to-amber-500 rounded-2xl flex items-center justify-center text-xl shadow-md">🚌</div>
        <div>
          <h1 class="text-2xl font-bold tracking-tight text-white">BusGo</h1>
          <p class="text-xs text-slate-400 -mt-0.5">Premium Travel</p>
        </div>
      </div>
      <div class="text-right">
        <div class="text-emerald-400 text-xs font-medium">CONFIRMED</div>
        <div class="font-mono text-xs text-slate-400">BG-98765432</div>
      </div>
    </div>

    <!-- Ticket Container -->
    <div class="ticket-container relative h-[460px]">
      
      <input type="checkbox" id="flip" class="hidden peer">

      <label for="flip" id ="ticket" class="ticket block w-full h-full cursor-pointer">

        <!-- FRONT SIDE -->
        <div class="front glass text-slate-100" id="ticketFront">
          
          <!-- Soft Orange Gradient Header -->
          <div class="h-14 bg-gradient-to-r from-orange-500/90 to-amber-500/90 flex items-center px-6">
            <div class="flex-1">
              <div class="text-xs font-medium tracking-wider">DELUXE AC • SEAT 12A</div>
              <div class="text-[10px] text-white/80">Volvo Multi-Axle Sleeper</div>
            </div>
            <div class="text-right">
              <div class="text-2xl font-bold text-white">₹<?=$array['ticket_price']?></div>
              <div class="text-xs text-white/70">incl. taxes</div>
            </div>
          </div>

          <!-- Main Content -->
          <div class="p-6 space-y-6">
            
            <!-- Passenger Details -->
            <div class="grid grid-cols-2 gap-x-8 gap-y-5 text-sm">
              <div>
                <div class="text-xs text-slate-400">PASSENGER</div>
                <div class="font-semibold text-white"><?=$array['user_name']?></div>
              </div>
              <div>
                <div class="text-xs text-slate-400">AGE / GENDER</div>
                <div class="font-semibold text-white"><?=$array['age']?> • <?=$array['gender']?></div>
              </div>
              <div class="col-span-2">
                <div class="text-xs text-slate-400">EMAIL</div>
                <div class="font-medium text-orange-300"><?=$array['email']?></div>
              </div>
            </div>

            <!-- Route -->
            <div class="flex items-center justify-between">
              <div class="flex-1">
                <div class="text-xs text-slate-400">FROM</div>
                <div class="font-semibold text-lg text-white"><?=$array['from_des']?></div>
                <div class="text-xs text-slate-400">Kashmere Gate ISBT</div>
              </div>
              <div class="flex flex-col items-center px-4 text-orange-400">
                <i class="fa-solid fa-arrow-right-long text-2xl"></i>
              </div>
              <div class="flex-1 text-right">
                <div class="text-xs text-slate-400">TO</div>
                <div class="font-semibold text-lg text-white"><?=$array['destination']?></div>
                <div class="text-xs text-slate-400">Sindhi Camp</div>
              </div>
            </div>

            <!-- Travel Info -->
            <div class="grid grid-cols-3 gap-4 text-center text-sm">
              <div>
                <div class="text-xs text-slate-400">DATE</div>
                <div class="font-semibold text-white"><?=$array['travel_date']?></div>
              </div>
              <div>
                <div class="text-xs text-slate-400">DEPARTURE</div>
                <div class="font-semibold text-orange-300">22:30</div>
              </div>
              <div>
                <div class="text-xs text-slate-400">ARRIVAL</div>
                <div class="font-semibold text-white">06:45</div>
              </div>
            </div>

            <!-- Perforation -->
            <div class="perforation h-px my-3"></div>

            <!-- Booking ID -->
            <div class="flex justify-between text-xs">
              <div>
                <span class="text-slate-400">Booking ID</span><br>
                <span class="font-mono font-medium text-orange-300">BG-98765432</span>
              </div>
              <div class="text-right">
                <span class="text-slate-400">Seat</span><br>
                <span class="font-medium text-emerald-400">12A • Window</span>
              </div>
            </div>
          </div>

          <!-- Buttons -->
          <div class="absolute bottom-0 inset-x-0 p-6 pt-10 bg-gradient-to-t from-slate-800/90 to-transparent">
            <div class="grid grid-cols-2 gap-3">
              <button onclick="downloadTicket(event)" 
                      class="flex items-center justify-center gap-2 py-3 bg-slate-700 hover:bg-slate-600 text-slate-200 rounded-2xl text-sm font-medium transition-all active:scale-95 border border-slate-600">
                <i class="fa-solid fa-download"></i>
                Download
              </button>
              <button onclick="printTicket(event)" 
                      class="flex items-center justify-center gap-2 py-3 bg-orange-500 hover:bg-orange-600 text-white rounded-2xl text-sm font-medium transition-all active:scale-95">
                <i class="fa-solid fa-print"></i>
                Print
              </button>
            </div>
          </div>
        </div>

        <!-- BACK SIDE -->
        <div class="back glass bg-slate-800 flex flex-col text-slate-100">
          <div class="flex-1 flex flex-col items-center justify-center p-8">
            <div class="bg-white p-4 rounded-3xl shadow-inner">
              <?php
$url = "http://192.0.0.8/bus/view_ticket1.php?id=".$array['id'];
?>

<img src="https://api.qrserver.com/v1/create-qr-code/?size=240x240&data=<?= urlencode($url) ?>" 
     alt="QR Code" 
     class="w-52 h-52 rounded-2xl">
            </div>
            
            <div class="mt-8 text-center">
              <p class="text-sm font-medium">Scan to view ticket details</p>
              <p class="text-xs text-slate-400 mt-2 font-mono">BG-98765432</p>
            </div>
          </div>

          <div class="p-6 border-t border-slate-700">
            <button onclick="document.getElementById('flip').checked = false; event.stopImmediatePropagation()" 
                    class="w-full py-3.5 bg-slate-700 hover:bg-slate-600 text-white rounded-2xl text-sm font-medium transition-all active:scale-95 flex items-center justify-center gap-2">
              <i class="fa-solid fa-arrow-rotate-left"></i>
              Back to Ticket
            </button>
          </div>
        </div>
      </label>
    </div>

    <!-- Footer Hint -->
    <div class="text-center mt-8">
      <p onclick="document.getElementById('flip').checked = !document.getElementById('flip').checked" 
         class="inline-flex items-center gap-2 text-slate-400 hover:text-white text-xs cursor-pointer transition-colors">
        <i class="fa-solid fa-arrows-rotate"></i>
        Tap anywhere on ticket to flip
      </p>
    </div>
  </div>
  <script>
    function printTicket(e) {
      e.stopImmediatePropagation();
      window.print();
    }

  function downloadTicket(e) {
  e.stopImmediatePropagation();

  const { jsPDF } = window.jspdf;
  let ticket = document.getElementById("ticketFront");

  html2canvas(ticket).then(canvas => {
    let imgData = canvas.toDataURL("image/png");

    let pdf = new jsPDF('p', 'mm', 'a4');

    let imgWidth = 190;
    let imgHeight = canvas.height * imgWidth / canvas.width;

    pdf.addImage(imgData, 'PNG', 10, 10, imgWidth, imgHeight);
    pdf.save("Bus_Ticket.pdf");
  });
}
  </script>


</main>
      <!--end::App Main-->
      <!--begin::Footer-->
    
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
