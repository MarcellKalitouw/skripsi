<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Register - Yunit Laundry </title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="author" content="colorlib.com">

		<!-- MATERIAL DESIGN ICONIC FONT -->
		<link rel="stylesheet" href="{{asset ('../template_register/colorlib-wizard-4/fonts/material-design-iconic-font/css/material-design-iconic-font.css') }}">

		<!-- DATE-PICKER -->
		<link rel="stylesheet" href="{{ asset ('../template_register/colorlib-wizard-4/vendor/date-picker/css/datepicker.min.css') }}">

		<!-- STYLE CSS -->
		<link rel="stylesheet" href="{{ asset ('../template_register/colorlib-wizard-4/css/style.css') }}">
        <style>
            .btn-upload-gambar{
                padding: 5px 30px;
                border: none;
                display: inline-flex;
                height: 40px;
                width: auto;
                letter-spacing: 1.3px;
                align-items: center;
                background: #e4bd37;
                font-family: 'Muli-Bold';
                cursor: pointer;
                position: relative;
                /* padding-left: 40px; */
                text-transform: uppercase;
                color: #fff;
                border-radius: 5px;
            }
        </style>
	</head>
	<body onload="killSteps()">
		<div class="wrapper">
			<div class="image-holder">
				<img src="{{asset ('../template_register/colorlib-wizard-4/images/form-wizard.png') }}" alt="">
			</div>
            <form id="formRegister" action="{{ route('login.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @method('post')

            	<div class="form-header">
            		<a href="#">#Yunit Laundry</a>
            		<h3>Login sebagai Partner usaha</h3>
            	</div>
            	<div id="">
            		<!-- SECTION 1 -->
	                

	                <!-- SECTION 3 -->
	                <h4></h4>
	                <section>
	                    <div class="form-row">
	                    	<label for="">
	                    		Email:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="email" name="email" class="form-control" placeholder="" required>
	                    	</div>
	                    </div>	
	                    <div class="form-row">
	                    	<label for="">
	                    		Password:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="password" name="password" class="form-control" placeholder="" required >
	                    	</div>
	                    </div>	
						@if ($error = Session::get('error'))
                        <div class="alert alert-danger" style="color: #000000; background:rgba(145, 145, 145, 0.3); padding:5%; border-radius: 25px;" >
                            <strong style="color: #C74667;">Whoops!</strong> There were some problems with your input.<br><br>
                            <ul>
                               
                                <li>{{ $error }}</li>
                            </ul>
                        </div>
                        @endif
	                    <div class="actions clearfix" >
							<ul style="display: flex; ">
								<button type="submit"  class="btn-upload-gambar" >Submit</button>
							</ul>
	                    	
	                    </div>
						
	                </section>
                    
            	</div>
            </form>
		</div>
        <script>
            function submitForm() {
                let form = document.getElementById("formRegister");
                form.submit();
            }
            function getFoto() {
                let inGbr = document.getElementById("gambar");
                inGbr.click();
            }
			
			function killSteps(){
				let steps = document.getElementsByClassName('steps');
				steps.remove();
				alert('hi');
			}
        </script>
		<script src="{{asset ('../template_register/colorlib-wizard-4/js/jquery-3.3.1.min.js') }}"></script>
		
		<!-- JQUERY STEP -->
		<script src="{{ asset ('../template_register/colorlib-wizard-4/js/jquery.steps.js') }}"></script>

		<!-- DATE-PICKER -->
		<script src="{{asset ('../template_register/colorlib-wizard-4/vendor/date-picker/js/datepicker.js') }}"></script>
		<script src="{{asset ('../template_register/colorlib-wizard-4/vendor/date-picker/js/datepicker.en.js') }}"></script>

		<script src="{{asset ('../template_register/colorlib-wizard-4/js/main.js') }}"></script>
<!-- Template created and distributed by Colorlib -->
</body>
</html>