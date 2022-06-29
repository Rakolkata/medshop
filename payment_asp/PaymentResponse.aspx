<%@ Page Language="C#" AutoEventWireup="true" CodeFile="PaymentResponse.aspx.cs"
    Inherits="PaymentResponse" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Start your development with a Dashboard for Bootstrap 4.">
    <meta name="author" content="Creative Tim">
    <title>Pay Online - Customer Dashboard for Vprotect CRM</title>
    <!-- Favicon -->
    <link href="./assets/img/brand/favicon.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="./assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="./assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="./assets/css/argon.css?v=1.0.0" rel="stylesheet">

<script type="text/javascript">
function customertype(cust)
{
	if(cust=='existing'){
	       document.getElementById('cust').style.display="block";
		}
	else{
		document.getElementById('cust').style.display="none";
		}
	}
</script>

</head>
<body class="bg-default">
    <form id="form1" runat="server">
    <div class="main-content">
        <!-- Navbar -->
        <nav class="navbar navbar-top navbar-horizontal navbar-expand-md navbar-dark">
      <div class="container px-4">
        <a class="navbar-brand" href="./index.html">
          <img src="./assets/img/brand/white.png" />
        </a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-collapse-main">
          <!-- Collapse header -->
          <div class="navbar-collapse-header d-md-none">
            <div class="row">
              <div class="col-6 collapse-brand">
                <a href="./index.html">
                  <img src="./assets/img/brand/blue.png">
                </a>
              </div>
              <div class="col-6 collapse-close">
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                  <span></span>
                  <span></span>
                </button>
              </div>
            </div>
          </div>
          <!-- Navbar items -->
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="#">
                <i class="ni ni-planet"></i>
                <span class="nav-link-inner--text">Dashboard</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="#">
                <i class="ni ni-circle-08"></i>
                <span class="nav-link-inner--text">Register</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="Login.aspx">
                <i class="ni ni-key-25"></i>
                <span class="nav-link-inner--text">Login</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="Payment.aspx">
                <i class="ni ni-cart"></i>
                <span class="nav-link-inner--text">Pay</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link nav-link-icon" href="#">
                <i class="ni ni-single-02"></i>
                <span class="nav-link-inner--text">Profile</span>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
        <!-- Header -->
        <div class="header bg-gradient-primary py-7 py-lg-8">
            <div class="container">
                <div class="header-body text-center mb-7">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 col-md-6">
                            <h1 class="text-white">
                                Sis Prosegur Alarm Monitoring And Response Services Private Limited!</h1>
                            <!--<p class="text-lead text-light">For Payment Please share all mandatory(*) details:</p>-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Page content -->
        <div class="container mt--8 pb-5">
            <!-- Table -->
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <form method="post" name="customerData" action="ccavRequestHandler.aspx">
                    <div class="card bg-secondary shadow border-0">
                        <%--<div class="card-header bg-transparent pb-5">
                            <div class="text-muted text-center mt-2 mb-4">
                                <small>Payment Status</small></div>
                        </div>--%>
                        <div class="card-body px-lg-5 py-lg-5">
                            <form role="form">
                            <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">Payment Status</span>
                                        </div>
                                        <asp:Label ID="Label5" runat="server" Text="" CssClass="input-group-text"></asp:Label>
                                    </div>
                                </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Payment Mode</span>
                                    </div>
                                    <asp:Label ID="Label1" runat="server" Text="" CssClass="input-group-text"></asp:Label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Bank Trans ID</span>
                                    </div>
                                    <asp:Label ID="Label2" runat="server" Text="" CssClass="input-group-text"></asp:Label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Trans. Date</span>
                                    </div>
                                    <asp:Label ID="Label3" runat="server" Text="" CssClass="input-group-text"></asp:Label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">Amount</span>
                                    </div>
                                    <asp:Label ID="Label4" runat="server" Text="" CssClass="input-group-text"></asp:Label>
                                </div>
                            </div>
                            <div class="text-center">
                                <asp:Button ID="Button1" OnClick="btnSubmit_Click" CssClass="btn btn-primary mt-4" runat="server" Text="Make Another Payment" />
                            </div>
                            </form>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Footer -->
    <footer class="footer">
        <div class="row align-items-center justify-content-xl-between">
          <div class="col-xl-6">
            <div class="copyright text-center text-xl-left text-muted">
              &copy; 2018 <a href="#" class="font-weight-bold ml-1" target="_blank">Vprotect</a>
            </div>
          </div>
          <div class="col-xl-6">
            <ul class="nav nav-footer justify-content-center justify-content-xl-end">
              <li class="nav-item">
                <a href="http://www.infocityhosting.com" class="nav-link" target="_blank">Creative Infocity</a>
              </li>
              <!--<li class="nav-item">
                <a href="https://www.creative-tim.com/presentation" class="nav-link" target="_blank">About Us</a>
              </li>
              <li class="nav-item">
                <a href="http://blog.creative-tim.com" class="nav-link" target="_blank">Blog</a>
              </li>
              <li class="nav-item">
                <a href="https://github.com/creativetimofficial/argon-dashboard/blob/master/LICENSE.md" class="nav-link" target="_blank">MIT License</a>
              </li>-->
            </ul>
          </div>
        </div>
      </footer>
    </div> </div>
    <!-- Argon Scripts -->
    <!-- Core -->

    <script src="./assets/vendor/jquery/dist/jquery.min.js"></script>

    <script src="./assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Optional JS -->

    <script src="./assets/vendor/chart.js/dist/Chart.min.js"></script>

    <script src="./assets/vendor/chart.js/dist/Chart.extension.js"></script>

    <!-- Argon JS -->

    <script src="./assets/js/argon.js?v=1.0.0"></script>

    </form>
</body>
</html>
