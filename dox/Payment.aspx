<%@ Page Language="C#" AutoEventWireup="true" CodeFile="Payment.aspx.cs" Inherits="Payment" %>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
    <form runat="server" id="form1">
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
                        <div class="card-header bg-transparent pb-5">
                            <!--<div class="text-muted text-center mt-2 mb-4"><small>Sign up with</small></div>-->
                            <div class="text-center">
                                <a href="#" class="btn btn-neutral btn-icon mr-4"><span class="btn-inner--icon">
                                    <input type="radio" name="existing" checked="" value="existing" onclick="customertype('existing');"></span>
                                    <span class="btn-inner--text">Existing Customer</span> </a><a href="#" class="btn btn-neutral btn-icon mr-4">
                                        <span class="btn-inner--icon">
                                            <input type="radio" name="existing" value="newcust" onclick="customertype('newcust');"></span>
                                        <span class="btn-inner--text">New Customer</span> </a>
                            </div>
                        </div>
                        <div class="card-body px-lg-5 py-lg-5">
                            <div class="text-center text-muted mb-4">
                                <div class="text-muted font-italic">
                                    <small>For Payment Please share all <span class="text-success font-weight-700">mandatory(*)</span>
                                        details:</small></div>
                                <!--<small>Sign up with credentials</small>-->
                            </div>
                            <form role="form">
                            <div id="cust">
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="ni ni-single-02"></i></span>
                                        </div>
                                        <asp:TextBox ID="txtcustid" runat="server" placeholder="Customer ID" CssClass="form-control form-control-alternative"></asp:TextBox>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-cart"></i></span>
                                    </div>
                                    <asp:TextBox ID="txtinvoice" required runat="server" CssClass="form-control form-control-alternative"
                                        placeholder="Invoice Number*"></asp:TextBox>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                    </div>
                                    <asp:TextBox ID="txtamount" CssClass="form-control form-control-alternative" required
                                        runat="server" placeholder="Invoice Amount*"></asp:TextBox>
                                    <%--<input type="number" id="input-invoice-amount" class="form-control form-control-alternative"
                                         name="amount">--%>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-hat-3"></i></span>
                                    </div>
                                    <asp:TextBox ID="txtname" runat="server" required placeholder="Name*" CssClass="form-control"></asp:TextBox>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <asp:TextBox ID="txtemail" CssClass="form-control" required placeholder="Email*"
                                        runat="server"></asp:TextBox>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-mobile-button"></i></span>
                                    </div>
                                    <asp:TextBox ID="txtphone" runat="server" required CssClass="form-control form-control-alternative"
                                        placeholder="Phone Number*"></asp:TextBox>
                                    <!--<input class="form-control" placeholder="Password" type="password">-->
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-chat-round"></i></span>
                                    </div>
                                    <textarea rows="4" runat="server" id="txtmessage" class="form-control form-control-alternative"
                                        placeholder="Message to Admin OR Account.."></textarea>
                                </div>
                            </div>
                            <!--<div class="text-muted font-italic"><small>password strength: <span class="text-success font-weight-700">strong</span></small></div>-->
                            <div class="text-center">
                                <asp:Button ID="Button1" OnClick="btnSubmit_Click" CssClass="btn btn-primary mt-4"
                                    runat="server" Text="Checkout" />
                            </div>
                            <div class="row my-4">
                                <div class="col-12">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <!--<input class="custom-control-input" id="customCheckRegister" type="checkbox">
                      <label class="custom-control-label" for="customCheckRegister">-->
                                        <span class="text-muted">
                                            <asp:Label ID="Label1" runat="server" Text=""></asp:Label></span>
                                        <!--</label>-->
                                    </div>
                                </div>
                            </div>
                            <div class="row my-4">
                                <div class="col-12">
                                    <div class="custom-control custom-control-alternative custom-checkbox">
                                        <!--<input class="custom-control-input" id="customCheckRegister" type="checkbox">
                      <label class="custom-control-label" for="customCheckRegister">-->
                                        <span class="text-muted">I agree with the <a href="privacyterms.aspx">Privacy Policy
                                            &amp; Terms Condition</a></span>
                                        <!--</label>-->
                                    </div>
                                </div>
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
