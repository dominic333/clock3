

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<style>
    .body-special #content {
    z-index: 2;
    top: 0;
    left: 0;
}
    #content {
    position: absolute;
    top: 100px;
    right: 0;
    bottom: 0;
    width: 100%;
    left: 0;
    overflow: hidden;
    -webkit-overflow-scrolling: touch;
    -webkit-overflow-scrolling: -blackberry-touch;
    -moz-transition: none;
    -o-transition: none;
    -webkit-transition: none;
    transition: none;
}
    .text-center{
        text-align: center;
    }
    .page-err {
    width: 100%;
    height: 100%;
    background-color: #fff;
}
    .page-err .err-status {
    background-color: #fff;
}
    .page-err .err-status h1 {
    margin: 100px 0 -47px;
    color: #e9e9e9;
    font-size: 200px;
}
    .page-err .err-message {
    background-color: #ffffff;
    padding: 24px;
    text-transform: uppercase;
}
    .page-err .err-message h2 {
    font-size: 40px;
    color: #c52f4d;
    font-weight: 300;
	margin-bottom: 10px;
}
    .page-err .err-body {
    padding: 0px 10px 20px;
}
    .page-err .btn-goback {
    color: #c52f4d;
    background-color: transparent;
    border-color: #fff;
    text-decoration: initial;   
}

	.err-body p {
	margin-bottom: 0;
    margin-top: 0px;
    text-transform: none;
	color:#c52f4d;
}
    
</style>


<div class="view-container">
                <!-- ngView:  --><section data-ng-view="" id="content" class="animate-fade-up ng-scope"><div class="page-err ng-scope">
    <div class="text-center">
        <div class="err-status">
             <h1>404</h1>
        </div>
        <div class="err-message">
            <h2>Page not found</h2>
                <div class="err-body">
                <p>The page you were looking for appears to be moved,deleted or does not exist . <br> Sorry for the inconvenience caused.</p>
                <br />
                    <a href="javascript:window.history.go(-1);" class="btn btn-lg btn-goback" style="text-decoration: underline;">
                    <span class="fa fa-home"></span>
                    <span class="space"></span>
                    Click here To Go Back to Home Page
                    </a>
                </div>
        </div>
    </div>
</div></section>
            </div>





<?php /*?><html>
<body>
<section>
<div>
<div align="center" style="margin-top:50px; margin-bottom:50px;">
<h3>Oops! An Error Occurred
The server returned a "404 Not Found".
Something is broken. Please e-mail us at [email] and let us know what you were doing when this error occurred. We will fix it as soon as possible. Sorry for any inconvenience caused.</h3>  
<div class="col-sm-2 col-resp">   
<a class="btn btn-warning btn-block" href="javascript:window.history.go(-1);"><i class="fa fa-arrow-left"></i>&nbsp;Back</a>
</div>
</div>
</div>
</section>
</body>
</html><?php */?>