@extends('auth.auth_layout.main_layout')
@yield('title', 'Registration')
@section('customcss')
<style>
    
</style>
@endsection
@section('content')
    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact section-bg">
      <div class="container">

        <div class="section-title">
          <h2>Registration</h2>
          <p>Register Here</p>
        </div>

        <div class="row">

          <!-- <div class="col-lg-6">

            <div class="row">
              <div class="col-md-12">
                <div class="info-box">
                  <i class="bx bx-map"></i>
                  <h3>Our Address</h3>
                  <p>Aana Business<br>
                     Laxmi Bhuvan Square,<br>
                     5<sup>th</sup> Floor Gotmare Market,<br>
                     Dharampeth, Nagpur.
                  </p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-envelope"></i>
                  <h3>Email Us</h3>
                  <p>info@aanabusiness.com</p>
                </div>
              </div>
              <div class="col-md-6">
                <div class="info-box mt-4">
                  <i class="bx bx-phone-call"></i>
                  <h3>Call Us</h3>
                  <p>+91 8055500012</p>
                </div>
              </div>
            </div>

          </div> -->
          <div class="col-lg-2">
          </div>
          <div class="col-lg-8">
           
            <form action="{{ route('register.save') }}" method="post" enctype="multipart/form-data" role="form" class="php-email-form">
            @csrf
                <div class="text-light p-3 mb-2" style="background-color:#ed502e;">
                    <p>
                        आप आना बिज़नेस में ज्वाइन होते ही आप कोई भी चीज़ 25 %जमा कर के पूरी तरह से चीजे  ख़रीदी कर सकते हैं, बाक़ी 75 % माफ़(Discount) 
                        आना बिज़नेस मे सामील लोगों को         50,000-10 लाख तक का क्रेडिट लोन ले सकते हैं (NO CIBIL required ) 
                    </p>
                    <p>
                        Only PAN Card , Adhar card , cancel chaqu is required.
                    </p>
                    <p>
                        आप आना बिज़नेस के मेंबर बनते ही सीमित अवधि तक बिज़नेस करने का सुनहरा मौक़ा आप को मिलता है जिसमें आप अनगिनतलाखों करोड़ों रक़म कमा सकते हो 
                        आप आना बिज़नस के समूह के किसी भी प्रोडक्ट में शेयर पार्टनर बन सकते हैं 
                        आना बिज़नेस में Join होकर अपने सपनों की दुनिया को हक़ीक़त में सजाए
                    </p>
                </div>
               <div>
                    <p>
                        Joining on every four members you can earn a Cash bonus with angel Plant free after complete your time period you can return this plants and get back surprisingly cash bonus on each and every line which would be you earn on your selected time period.
                    </p>
                </div>
            <label>Name: </label>
            <div class="form-row">
                <div class="col form-group">
                  <input type="text" name="first_name" class="form-control @error('name') is-invalid @enderror" id="first_name" placeholder="Your First Name" />
                  <div class="validate"></div>
                </div>
                 <div class="col form-group">
                  <input type="text" name="middle_name" class="form-control @error('name') is-invalid @enderror" id="middle_name" placeholder="Your Middle Name" />
                  <div class="validate"></div>
                </div>
                 <div class="col form-group">
                  <input type="text" name="last_name" class="form-control @error('name') is-invalid @enderror" id="last_name" placeholder="Your Last Name" />
                  <div class="validate"></div>
                </div>
            </div>
            <label>User ID: </label>
                <div class="form-row">
                    <div class="col form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="username" id="username" placeholder="Add User Name" />
                    <div class="validate"></div>
                    </div>
                    <div class="col form-group">
                        <input type="password" class="form-control @error('name') is-invalid @enderror" name="password" id="password" placeholder="Password" />
                        <div class="validate"></div>
                    </div>
                </div>
                <label>Mobile: </label>
                <div class="form-row">
                    <div class="col form-group">
                        <input type="number" class="form-control @error('name') is-invalid @enderror" name="mobile_no1" id="mobile_no1" placeholder="Your Mobile No. 1" />
                    <div class="validate"></div>
                    </div>
                    <div class="col form-group">
                        <input type="number" class="form-control @error('name') is-invalid @enderror" name="mobile_no2" id="mobile_no2" placeholder="Your Mobile No. 2" />
                    <div class="validate"></div>
                    </div>
                    <div class="col form-group">
                        <input type="number" class="form-control @error('name') is-invalid @enderror" name="landline" id="landline" placeholder="Land line number" />
                        <div class="validate"></div>
                    </div>
                </div>
                <label>Details: </label>
                <div class="form-row">
                    
                    <div class="col form-group">
                        <input type="email" class="form-control @error('name') is-invalid @enderror" name="email" id="email" placeholder="Enter Email" />
                        <div class="validate"></div>
                    </div>
                    <div class="col form-group">
                        <input type="date" class="form-control @error('name') is-invalid @enderror" name="dob" id="dob" placeholder="Enter Date Of Birth" />
                        <div class="validate"></div>
                    </div>
                    <div class="col form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="blood_group" id="blood_group" placeholder="Enter Blood Group" />
                        <div class="validate"></div>
                    </div>
                </div>
                    <label>Promoter: </label>
                <div class="form-row">
                    
                    <div class="col form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="promoter_name" id="promoter_name" placeholder="Promoter Name"/>
                        <div class="validate"></div>
                    </div>
                    <div class="col form-group">
                        <input type="text" class="form-control @error('name') is-invalid @enderror" name="promoter_mobile" id="promoter_mobile" placeholder="Promoter Mobile"/>
                        <div class="validate"></div>
                    </div>
                    
                </div>
                <label>Address: </label>
                <div class="form-group">
                    <input type="address" class="form-control @error('name') is-invalid @enderror" name="address" id="address" placeholder="Address" />
                    <div class="validate"></div>
                </div>
                    
               <!--<label></label>-->
                <div class="form-row">
                    <div class="col form-group">
                        <p>Photo :
                        <input type="file" name="photo" id="photo" class="form-control @error('name') is-invalid @enderror" placeholder="Upload photo" /></p>
                        <div class="validate"></div>
                    </div>
                    <div class=" col form-group">
                     <p>Self :
                        <input type="checkbox" class="col form-control" name="self" /></p>
                        <div class="validate"></div>
                    </div>
                </div>
                <div class="form-group">
                    <select class="form-control" id="payment_mode">
                        <option value="">Select Payment Mode</option>
                        <!-- <option>Paytm</option> -->
                        <option value="Credit Card">Credit Card</option>
                        <!-- <option>Google Pay</option> -->
                    </select>
                    
                    <div class="validate"></div>
                </div>
                <!-- <div class="form-group">
                    <textarea class="form-control" name="message" rows="5" data-rule="required" data-msg="Please write something for us" placeholder="Message"></textarea>
                    <div class="validate"></div>
                </div> -->
                <div class="text-center"><button type="submit">Submit</button></div>
            </form>
        </div>
        <div class="col-lg-2">
        </div>
    </div>

      </div>
    </section><!-- End Contact Section -->
@endsection
@section('customjs')
@endsection