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


		{{-- HERE MAPS --}}
		<script src="https://js.api.here.com/v3/3.1/mapsjs-core.js" type="text/javascript" charset="utf-8"></script>
		<script src="https://js.api.here.com/v3/3.1/mapsjs-service.js" type="text/javascript" charset="utf-8"></script>
		<script src="https://js.api.here.com/v3/3.1/mapsjs-mapevents.js" type="text/javascript" charset="utf-8"></script>
		<script src="https://js.api.here.com/v3/3.1/mapsjs-ui.js" type="text/javascript" charset="utf-8"></script>
		<link rel="stylesheet" type="text/css" href="https://js.api.here.com/v3/3.1/mapsjs-ui.css" />
		
		<!-- STYLE CSS -->

		<link rel="stylesheet" href="{{ asset ('../template_register/colorlib-wizard-4/css/style.css') }}">

        <style>
            .btn-upload-gambar{
                padding: 0;
                border: none;
                display: inline-flex;
                height: 40px;
                width: 180px;
                letter-spacing: 1.3px;
                align-items: center;
                background: #979899;
                font-family: 'Muli-Bold';
                cursor: pointer;
                position: relative;
                padding-left: 34px;
                text-transform: uppercase;
                color: #fff;
                border-radius: 5px;
            }
        </style>
	</head>
	<body>
		<div class="wrapper">
			<div class="image-holder">
				<img src="{{asset ('../template_register/colorlib-wizard-4/images/form-wizard.png') }}" alt="">
			</div>
            <form id="formRegister" action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                @method('post')

            	<div class="form-header">
            		<a href="#">#Yunit Laundry</a>
            		<h3>Mendaftar untuk menjadi partner</h3>
					<a style="margin-bottom: 20px; background: #0075fc;" href="{{ route('login.index') }}"  >Login Account</a>
            	</div>
            	<div id="wizard">
            		<!-- SECTION 1 -->
	                <h4></h4>
	                <section>
	                    <div class="form-row" style="margin-bottom: 26px;">
	                    	<label for="">
	                    		Nama Laundry
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" name="nama" id="" placeholder="laundry maju, hebat laundry..." class="form-control" autocomplete="off" required >
								
	                    	</div>
	                    </div>
                        <div class="form-row" style="margin-bottom: 26px;">
	                    	<label for="">
	                    		Nomor Telepon
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="number" name="no_telp" id="" placeholder="081xxxxxx..." class="form-control" autocomplete="off" required >
								
	                    	</div>
	                    </div>	
	                   
{{-- 	                   	
	                    <div class="form-row">
	                    	<label for="">
	                    		Term:
	                    	</label>
	                    	<div class="form-holder">
	                    		<select name="" id="" class="form-control">
	                    			<option value="" selected disabled>Select Term</option>
									<option value="term 1" class="option">Term 1</option>
									<option value="term 2" class="option">Term 2</option>
									<option value="term 3" class="option">Term 3</option>
								</select>
								<i class="zmdi zmdi-caret-down"></i>
	                    	</div>
	                    </div>	 --}}
	                    @if ($errors->any())
                       	<div class="alert alert-danger" style="color: #000000; background:rgba(145, 145, 145, 0.3); padding:5%; border-radius: 25px;" >
                            <strong style="color: #C74667;">Whoops!</strong> There were some problems with your input.<br>
								<ul>
                                {{-- @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach --}}
								@error('nama')
                                <li>{{ $message }}</li>
								@enderror
								@error('no_telp')
                                <li>{{ $message }}</li>
								@enderror
								
                            </ul>
                        </div>
                        @endif
	                </section>
	                
					<!-- SECTION 2 -->
	                <h4></h4>
	                <section>
	                     
                        <div class="form-row">
	                    	<label for="">
	                    		Foto Usaha 
	                    	</label>
	                    	<div class="form-holder" >
                                <input type="file" name="gambar" id="gambar" onchange="document.getElementById('output').src = window.URL.createObjectURL(this.files[0])" style="visibility: hidden;">
								<img id="output" src=""  style="display: none; max-width:100%; height:auto;">
                                <button type="button" onclick="getFoto()" class="btn-upload-gambar" >Pilih Foto</button>
                            </div>
	                    </div>
                        <div class="form-row">
	                    	<label for="">
	                    		Deskripsi Usaha 
	                    	</label>
	                    	<div class="form-holder" >
	                    		<textarea style="height: 100px; padding: 0 10px 0 10px" class="form-control" name="deskripsi" id=""  placeholder="Usaha ini adalah..."></textarea>
	                    	</div>
	                    </div>	
                        {{-- <div class="form-row">
	                    	<label for="">
	                    		Alamat 
	                    	</label>
	                    	<div class="form-holder" >
	                    		<textarea style="height: 100px; padding: 0 10px 0 10px" class="form-control" name="alamat" id=""  placeholder="Tataaran 1, Tondano Selatan, Kabupaten Minahas, Sulawesi Utara..."></textarea>
	                    	</div>
	                    </div>
						
						
						
						<div class="form-row" style="margin-bottom: 26px;">
	                    	<label for="">
	                    		Longitude
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" name="longitude" value="1.468785" id="" placeholder="" class="form-control" autocomplete="off" required readonly>
								
	                    	</div>
	                    </div>	
						<div class="form-row" style="margin-bottom: 26px;">
	                    	<label for="">
	                    		Latitude
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" name="latitude" value="124.830677" id="" placeholder="" class="form-control" autocomplete="off" required readonly>
								
	                    	</div>
	                    </div>	 --}}
						{{-- <div class="form-row" >
	                    	<label for="">Pin Location</label>
	                    	<div id="here-maps" class="form-holder">
								<div id="mapContainer" style="height:300px"></div>
							</div>
	                    </div> --}}

						{{-- <div id="here-maps" style="background: #000000;">
                            <label for="">Pin Location</label>
                            <div id="mapContainer" style="height:500px; "></div>
                        </div> --}}
						@if ($errors->any())
                       	<div class="alert alert-danger" style="color: #000000; background:rgba(145, 145, 145, 0.3); padding:5%; border-radius: 25px;" >
                            <strong style="color: #C74667;">Whoops!</strong> There were some problems with your input.<br>
								<ul>
                                {{-- @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach --}}
								@error('gambar')
                                <li>{{ $message }}</li>
								@enderror
								@error('deskripsi')
                                <li>{{ $message }}</li>
								@enderror
                            </ul>
                        </div>
                        @endif
                        {{-- <div class="form-row">
	                    	<label for="">
	                    		Date of Birth:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control datepicker-here" data-language='en' data-date-format="dd - mm - yyyy" id="dp1">
	                    	</div>
	                    </div>	 --}}
	                    {{-- <div class="form-row">
	                    	<label for="">
	                    		Country of Birth:
	                    	</label>
	                    	<div class="form-holder">
	                    		<select name="" id="" class="form-control">
									<option value="united states" class="option">United States</option>
									<option value="united kingdom" class="option">United Kingdom</option>
									<option value="viet nam" class="option">Viet Nam</option>
								</select>
								<i class="zmdi zmdi-caret-down"></i>
	                    	</div>
	                    </div>	
	                    <div class="form-row">
	                    	<label for="">
	                    		Your Email:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control">
	                    	</div>
	                    </div>	
	                    <div class="form-row" style="margin-bottom: 3.4vh">
	                    	<label for="">
	                    		Phone Number:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="text" class="form-control">
	                    	</div>
	                    </div>	
	                    <div class="form-row" style="margin-bottom: 50px;">
	                    	<label for="">
	                    		Gender:
	                    	</label>
	                    	<div class="form-holder">
	                    		<div class="checkbox-circle">
									<label class="male">
										<input type="radio" name="gender" value="male" checked> Male<br>
										<span class="checkmark"></span>
									</label>
									<label class="female">
										<input type="radio" name="gender" value="female"> Female<br>
										<span class="checkmark"></span>
									</label>
									
								</div>
	                    	</div>
	                    </div>		 --}}
	                </section>

	                <!-- SECTION 3 -->
	                <h4></h4>
	                <section>
	                    <div class="form-row">
	                    	<label for="">
	                    		Email:
	                    	</label>
	                    	<div class="form-holder">
	                    		<input type="email" name="email" class="form-control" placeholder="test@g.com..." required>
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
	                    <div class="checkbox-circle" style="margin-bottom: 48px;">
							<label>
								<input type="checkbox" checked>I agree all statement in Terms & Conditions
								<span class="checkmark"></span>
							</label>
						</div>
						{{-- @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> There were some problems with your input.<br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif --}}
						@if ($errors->any())
                       	<div class="alert alert-danger" style="color: #000000; background:rgba(145, 145, 145, 0.3); padding:5%; border-radius: 25px;" >
                            <strong style="color: #C74667;">Whoops!</strong> There were some problems with your input.<br>
								<ul>
                                {{-- @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach --}}
								@error('email')
                                <li>{{ $message }}</li>
								@enderror
								@error('password')
                                <li>{{ $message }}</li>
								@enderror
                            </ul>
                        </div>
                        @endif
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
                let showGbr = document.getElementById("output");
                inGbr.click();
				$("#output").show();
            }
        </script>
		<script src="{{asset ('../template_register/colorlib-wizard-4/js/jquery-3.3.1.min.js') }}"></script>
		@stack('script')
		<script>
			window.hereApiKey = "{{ env('HERE_API_KEY') }}"
		</script>
		<script src="{{ asset('js/here.js') }}"></script>
		<!-- JQUERY STEP -->
		<script src="{{ asset ('../template_register/colorlib-wizard-4/js/jquery.steps.js') }}"></script>

		<!-- DATE-PICKER -->
		{{-- <script src="{{asset ('../template_register/colorlib-wizard-4/vendor/date-picker/js/datepicker.js') }}"></script>
		<script src="{{asset ('../template_register/colorlib-wizard-4/vendor/date-picker/js/datepicker.en.js') }}"></script> --}}

		
		<script src="{{asset ('../template_register/colorlib-wizard-4/js/main.js') }}"></script>
		
<!-- Template created and distributed by Colorlib -->
</body>
</html>