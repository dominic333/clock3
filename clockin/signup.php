<?php include "header.html"; ?>

<section id="signup">
   <div class="container">
      <div class="row">
         <div class="col-sm-12 text-center">
            <p class="title">Sign Up Form</p>
         </div>
      </div>
      <div class="row">
         <div class="col-sm-10 col-sm-offset-1">
            <form class="form-horizontal" name="form" action="check.php" method="post">
               <div class="form-group">
                  <div class="col-sm-5">
                     <label for="plan-details" class="control-label">Plan Details</label>
                  </div>
                  <div class="col-sm-7">
                     <!-- ==== MEMBERSHIP PLAN ==== -->
                     <div class="col-sm-5 no-padding-right">
                        <select class="form-control" name="plan" required>
                           <option value="" selected="" disabled>Select Plan</option>
                           <option value="free">FREE</option>
                           <option value="paid">PAID</option>
                        </select>
                     </div>
                     <div class="col-sm-3 no-padding-left no-padding-right">
                        <select class="form-control" name="currency">
                           <option value="usd" selected="select">USD</option>
                           <option value="php">PHP</option>
                           <option value="sgd">SGD</option>
                           <option value="aud">AUD</option>
                        </select>
                     </div>
                     
                     <!-- ==== NUMBER OF USERS ==== -->
                     <div class="col-sm-4 no-padding-left">
                        <input type="number" class="form-control" name="no-user"  min="1" placeholder="No. of Users" required>
                        
                     </div>
                     
                     <!-- ==== DURATION PLAN ==== -->
                     <div class="col-sm-12 no-padding plan-total">
                        <div class="col-md-5 col-sm-7">
                           <select class="form-control" name="terms">
                              <option value="6" selected="select">6 Months</option>
                              <option value="12">12 Months</option>
                           </select>
                        </div>
                        <div class="col-sm-5 no-padding">
                           <label style="text-align:left;font-size:1em" class="control-label"><b>TOTAL</b></label>&emsp;
                           <label id="total" class="control-label"></label>
                        </div>
                     </div>
                  </div>
               </div>
               
                  <hr>
               <!-- ACCOUNT DETAILS -->
               <div class="form-group">
                  <div class="col-sm-5">
                     <label for="plan-details" class="control-label">Account Details</label>
                  </div>
                  <div class="col-sm-7">
                  
                     <!-- ==== NAME ==== -->
                     <div class="col-sm-6 no-padding-right">
                        <input type="text" class="form-control" name="fname" placeholder="First name" required>
                     </div>
                     <div class="col-sm-6 no-padding-left">
                        <input type="text" class="form-control" name="lname" placeholder="Last name" required>
                     </div>
                     
                     <!-- ==== COMPANY NAME ==== -->
                     <div class="col-sm-12">
                        <input type="text" class="form-control no-padding" name="cname" placeholder="Company Name" style="margin-bottom:0" required>
                        <span id="helpBlock" class="help-block" style="margin-bottom:5%">If you don't have a company name yet, please enter your name here.</span>
                     </div>
                     
                     <!-- ==== ADDRESS ==== -->
                     <div class="col-sm-12">
                        <textarea name="address" class="form-control" placeholder="Address" required></textarea>
                     </div>
                     
                     <!-- ==== CITY & STATE ==== -->
                     <div class="col-sm-6 no-padding-right">
                        <input type="text" class="form-control" name="city" placeholder="City" required>
                     </div>
                     <div class="col-sm-6 no-padding-left">
                        <input type="text" class="form-control" name="state" placeholder="State" required>
                     </div>
                     
                     <!-- ==== ZIPCODE & COUNTRY ==== -->
                     <div class="col-sm-6 no-padding-right">
                        <input type="text" class="form-control" name="zipcode" placeholder="Postcode / Zipcode" required>
                     </div>
                     <div class="col-sm-6 no-padding-left">
                        <select class="form-control" name="country" required>
                           <option value="" selected="" disabled>Select Country</option>
                           <option value="Afganistan">Afghanistan</option>
                           <option value="Albania">Albania</option>
                           <option value="Algeria">Algeria</option>
                           <option value="American Samoa">American Samoa</option>
                           <option value="Andorra">Andorra</option>
                           <option value="Angola">Angola</option>
                           <option value="Anguilla">Anguilla</option>
                           <option value="Antigua &amp; Barbuda">Antigua &amp; Barbuda</option>
                           <option value="Argentina">Argentina</option>
                           <option value="Armenia">Armenia</option>
                           <option value="Aruba">Aruba</option>
                           <option value="Australia">Australia</option>
                           <option value="Austria">Austria</option>
                           <option value="Azerbaijan">Azerbaijan</option>
                           <option value="Bahamas">Bahamas</option>
                           <option value="Bahrain">Bahrain</option>
                           <option value="Bangladesh">Bangladesh</option>
                           <option value="Barbados">Barbados</option>
                           <option value="Belarus">Belarus</option>
                           <option value="Belgium">Belgium</option>
                           <option value="Belize">Belize</option>
                           <option value="Benin">Benin</option>
                           <option value="Bermuda">Bermuda</option>
                           <option value="Bhutan">Bhutan</option>
                           <option value="Bolivia">Bolivia</option>
                           <option value="Bonaire">Bonaire</option>
                           <option value="Bosnia &amp; Herzegovina">Bosnia &amp; Herzegovina</option>
                           <option value="Botswana">Botswana</option>
                           <option value="Brazil">Brazil</option>
                           <option value="British Indian Ocean Ter">British Indian Ocean Ter</option>
                           <option value="Brunei">Brunei</option>
                           <option value="Bulgaria">Bulgaria</option>
                           <option value="Burkina Faso">Burkina Faso</option>
                           <option value="Burundi">Burundi</option>
                           <option value="Cambodia">Cambodia</option>
                           <option value="Cameroon">Cameroon</option>
                           <option value="Canada">Canada</option>
                           <option value="Canary Islands">Canary Islands</option>
                           <option value="Cape Verde">Cape Verde</option>
                           <option value="Cayman Islands">Cayman Islands</option>
                           <option value="Central African Republic">Central African Republic</option>
                           <option value="Chad">Chad</option>
                           <option value="Channel Islands">Channel Islands</option>
                           <option value="Chile">Chile</option>
                           <option value="China">China</option>
                           <option value="Christmas Island">Christmas Island</option>
                           <option value="Cocos Island">Cocos Island</option>
                           <option value="Colombia">Colombia</option>
                           <option value="Comoros">Comoros</option>
                           <option value="Congo">Congo</option>
                           <option value="Cook Islands">Cook Islands</option>
                           <option value="Costa Rica">Costa Rica</option>
                           <option value="Cote DIvoire">Cote D'Ivoire</option>
                           <option value="Croatia">Croatia</option>
                           <option value="Cuba">Cuba</option>
                           <option value="Curaco">Curacao</option>
                           <option value="Cyprus">Cyprus</option>
                           <option value="Czech Republic">Czech Republic</option>
                           <option value="Denmark">Denmark</option>
                           <option value="Djibouti">Djibouti</option>
                           <option value="Dominica">Dominica</option>
                           <option value="Dominican Republic">Dominican Republic</option>
                           <option value="East Timor">East Timor</option>
                           <option value="Ecuador">Ecuador</option>
                           <option value="Egypt">Egypt</option>
                           <option value="El Salvador">El Salvador</option>
                           <option value="Equatorial Guinea">Equatorial Guinea</option>
                           <option value="Eritrea">Eritrea</option>
                           <option value="Estonia">Estonia</option>
                           <option value="Ethiopia">Ethiopia</option>
                           <option value="Falkland Islands">Falkland Islands</option>
                           <option value="Faroe Islands">Faroe Islands</option>
                           <option value="Fiji">Fiji</option>
                           <option value="Finland">Finland</option>
                           <option value="France">France</option>
                           <option value="French Guiana">French Guiana</option>
                           <option value="French Polynesia">French Polynesia</option>
                           <option value="French Southern Ter">French Southern Ter</option>
                           <option value="Gabon">Gabon</option>
                           <option value="Gambia">Gambia</option>
                           <option value="Georgia">Georgia</option>
                           <option value="Germany">Germany</option>
                           <option value="Ghana">Ghana</option>
                           <option value="Gibraltar">Gibraltar</option>
                           <option value="Great Britain">Great Britain</option>
                           <option value="Greece">Greece</option>
                           <option value="Greenland">Greenland</option>
                           <option value="Grenada">Grenada</option>
                           <option value="Guadeloupe">Guadeloupe</option>
                           <option value="Guam">Guam</option>
                           <option value="Guatemala">Guatemala</option>
                           <option value="Guinea">Guinea</option>
                           <option value="Guyana">Guyana</option>
                           <option value="Haiti">Haiti</option>
                           <option value="Hawaii">Hawaii</option>
                           <option value="Honduras">Honduras</option>
                           <option value="Hong Kong">Hong Kong</option>
                           <option value="Hungary">Hungary</option>
                           <option value="Iceland">Iceland</option>
                           <option value="India">India</option>
                           <option value="Indonesia">Indonesia</option>
                           <option value="Iran">Iran</option>
                           <option value="Iraq">Iraq</option>
                           <option value="Ireland">Ireland</option>
                           <option value="Isle of Man">Isle of Man</option>
                           <option value="Israel">Israel</option>
                           <option value="Italy">Italy</option>
                           <option value="Jamaica">Jamaica</option>
                           <option value="Japan">Japan</option>
                           <option value="Jordan">Jordan</option>
                           <option value="Kazakhstan">Kazakhstan</option>
                           <option value="Kenya">Kenya</option>
                           <option value="Kiribati">Kiribati</option>
                           <option value="Korea North">Korea North</option>
                           <option value="Korea Sout">Korea South</option>
                           <option value="Kuwait">Kuwait</option>
                           <option value="Kyrgyzstan">Kyrgyzstan</option>
                           <option value="Laos">Laos</option>
                           <option value="Latvia">Latvia</option>
                           <option value="Lebanon">Lebanon</option>
                           <option value="Lesotho">Lesotho</option>
                           <option value="Liberia">Liberia</option>
                           <option value="Libya">Libya</option>
                           <option value="Liechtenstein">Liechtenstein</option>
                           <option value="Lithuania">Lithuania</option>
                           <option value="Luxembourg">Luxembourg</option>
                           <option value="Macau">Macau</option>
                           <option value="Macedonia">Macedonia</option>
                           <option value="Madagascar">Madagascar</option>
                           <option value="Malaysia">Malaysia</option>
                           <option value="Malawi">Malawi</option>
                           <option value="Maldives">Maldives</option>
                           <option value="Mali">Mali</option>
                           <option value="Malta">Malta</option>
                           <option value="Marshall Islands">Marshall Islands</option>
                           <option value="Martinique">Martinique</option>
                           <option value="Mauritania">Mauritania</option>
                           <option value="Mauritius">Mauritius</option>
                           <option value="Mayotte">Mayotte</option>
                           <option value="Mexico">Mexico</option>
                           <option value="Midway Islands">Midway Islands</option>
                           <option value="Moldova">Moldova</option>
                           <option value="Monaco">Monaco</option>
                           <option value="Mongolia">Mongolia</option>
                           <option value="Montserrat">Montserrat</option>
                           <option value="Morocco">Morocco</option>
                           <option value="Mozambique">Mozambique</option>
                           <option value="Myanmar">Myanmar</option>
                           <option value="Nambia">Nambia</option>
                           <option value="Nauru">Nauru</option>
                           <option value="Nepal">Nepal</option>
                           <option value="Netherland Antilles">Netherland Antilles</option>
                           <option value="Netherlands">Netherlands (Holland, Europe)</option>
                           <option value="Nevis">Nevis</option>
                           <option value="New Caledonia">New Caledonia</option>
                           <option value="New Zealand">New Zealand</option>
                           <option value="Nicaragua">Nicaragua</option>
                           <option value="Niger">Niger</option>
                           <option value="Nigeria">Nigeria</option>
                           <option value="Niue">Niue</option>
                           <option value="Norfolk Island">Norfolk Island</option>
                           <option value="Norway">Norway</option>
                           <option value="Oman">Oman</option>
                           <option value="Pakistan">Pakistan</option>
                           <option value="Palau Island">Palau Island</option>
                           <option value="Palestine">Palestine</option>
                           <option value="Panama">Panama</option>
                           <option value="Papua New Guinea">Papua New Guinea</option>
                           <option value="Paraguay">Paraguay</option>
                           <option value="Peru">Peru</option>
                           <option value="Phillipines">Philippines</option>
                           <option value="Pitcairn Island">Pitcairn Island</option>
                           <option value="Poland">Poland</option>
                           <option value="Portugal">Portugal</option>
                           <option value="Puerto Rico">Puerto Rico</option>
                           <option value="Qatar">Qatar</option>
                           <option value="Republic of Montenegro">Republic of Montenegro</option>
                           <option value="Republic of Serbia">Republic of Serbia</option>
                           <option value="Reunion">Reunion</option>
                           <option value="Romania">Romania</option>
                           <option value="Russia">Russia</option>
                           <option value="Rwanda">Rwanda</option>
                           <option value="St Barthelemy">St Barthelemy</option>
                           <option value="St Eustatius">St Eustatius</option>
                           <option value="St Helena">St Helena</option>
                           <option value="St Kitts-Nevis">St Kitts-Nevis</option>
                           <option value="St Lucia">St Lucia</option>
                           <option value="St Maarten">St Maarten</option>
                           <option value="St Pierre &amp; Miquelon">St Pierre &amp; Miquelon</option>
                           <option value="St Vincent &amp; Grenadines">St Vincent &amp; Grenadines</option>
                           <option value="Saipan">Saipan</option>
                           <option value="Samoa">Samoa</option>
                           <option value="Samoa American">Samoa American</option>
                           <option value="San Marino">San Marino</option>
                           <option value="Sao Tome &amp; Principe">Sao Tome &amp; Principe</option>
                           <option value="Saudi Arabia">Saudi Arabia</option>
                           <option value="Senegal">Senegal</option>
                           <option value="Serbia">Serbia</option>
                           <option value="Seychelles">Seychelles</option>
                           <option value="Sierra Leone">Sierra Leone</option>
                           <option value="Singapore">Singapore</option>
                           <option value="Slovakia">Slovakia</option>
                           <option value="Slovenia">Slovenia</option>
                           <option value="Solomon Islands">Solomon Islands</option>
                           <option value="Somalia">Somalia</option>
                           <option value="South Africa">South Africa</option>
                           <option value="Spain">Spain</option>
                           <option value="Sri Lanka">Sri Lanka</option>
                           <option value="Sudan">Sudan</option>
                           <option value="Suriname">Suriname</option>
                           <option value="Swaziland">Swaziland</option>
                           <option value="Sweden">Sweden</option>
                           <option value="Switzerland">Switzerland</option>
                           <option value="Syria">Syria</option>
                           <option value="Tahiti">Tahiti</option>
                           <option value="Taiwan">Taiwan</option>
                           <option value="Tajikistan">Tajikistan</option>
                           <option value="Tanzania">Tanzania</option>
                           <option value="Thailand">Thailand</option>
                           <option value="Togo">Togo</option>
                           <option value="Tokelau">Tokelau</option>
                           <option value="Tonga">Tonga</option>
                           <option value="Trinidad &amp; Tobago">Trinidad &amp; Tobago</option>
                           <option value="Tunisia">Tunisia</option>
                           <option value="Turkey">Turkey</option>
                           <option value="Turkmenistan">Turkmenistan</option>
                           <option value="Turks &amp; Caicos Is">Turks &amp; Caicos Is</option>
                           <option value="Tuvalu">Tuvalu</option>
                           <option value="Uganda">Uganda</option>
                           <option value="Ukraine">Ukraine</option>
                           <option value="United Arab Erimates">United Arab Emirates</option>
                           <option value="United Kingdom">United Kingdom</option>
                           <option value="United States of America">United States of America</option>
                           <option value="Uraguay">Uruguay</option>
                           <option value="Uzbekistan">Uzbekistan</option>
                           <option value="Vanuatu">Vanuatu</option>
                           <option value="Vatican City State">Vatican City State</option>
                           <option value="Venezuela">Venezuela</option>
                           <option value="Vietnam">Vietnam</option>
                           <option value="Virgin Islands (Brit)">Virgin Islands (Brit)</option>
                           <option value="Virgin Islands (USA)">Virgin Islands (USA)</option>
                           <option value="Wake Island">Wake Island</option>
                           <option value="Wallis &amp; Futana Is">Wallis &amp; Futana Is</option>
                           <option value="Yemen">Yemen</option>
                           <option value="Zaire">Zaire</option>
                           <option value="Zambia">Zambia</option>
                           <option value="Zimbabwe">Zimbabwe</option>
                        </select>
                     </div>
                     
                     <!-- ==== PHONE NUMBER ==== -->
                     <div class="col-sm-12">
                        <input type="text" class="form-control" name="pnum" placeholder="Phone Number" required>
                     </div>
                     
                     <!-- ==== EMAIL ==== -->
                     <div class="col-sm-12">
                        <input type="email" class="form-control" name="email" placeholder="Email Address" style="margin-bottom:0" required>
                        <span id="helpBlock" class="help-block" style="margin-bottom:5%">Please use an e-mail address which you check regularly.</span>
                     </div>
                     
                  </div>
               </div>
               <hr>
               <div class="form-group payment hidden">
                  <div class="col-sm-5">
                     <label for="plan-details" class="control-label">Payment Details</label>
                  </div>
                  <div class="col-sm-7">
                     
                     <!-- ==== PAYMENT TYPE ==== -->
                     <div class="col-sm-12">
                        <select class="form-control" name="payment">
                           <option value="" selected="" disabled>Select Payment Method</option>
                           <option value="cc">Credit Card</option>
                           <option value="paypal">Paypal</option>
                        </select>
                     </div>
                     <div id="cc" class="hidden">
                        <label for="plan-details" class="control-label" style="font-size:1em;font-weight:bold">Credit Card Details</label>
                        
                        <!-- ==== Name on card ==== -->
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="ccname" placeholder="Name on card">
                        </div>
                        <!-- ==== Credit Card Number ==== -->
                        <div class="col-sm-12">
                           <input type="text" class="form-control" name="ccnum" placeholder="Credit Card Number">
                        </div>
                        <!-- ==== CC Month & Year ==== -->
                        <div class="col-sm-6 no-padding-right">
                           <select class="form-control" name="ccmonth">
                              <option value="" selected="" disabled>Month</option>
                              <option value="01">January</option>
                              <option value="02">February</option>
                              <option value="03">March</option>
                              <option value="04">April</option>
                              <option value="05">May</option>
                              <option value="06">June</option>
                              <option value="07">July</option>
                              <option value="08">August</option>
                              <option value="09">September</option>
                              <option value="10">October</option>
                              <option value="11">November</option>
                              <option value="12">December</option>
                           </select>
                        </div>
                        <div class="col-sm-6 no-padding-left">
                           <select class="form-control" name="ccyear">
                              <option value="" selected="" disabled>Year</option>
                              <option value="17">2017</option>
                              <option value="18">2018</option>
                              <option value="19">2019</option>
                              <option value="20">2020</option>
                              <option value="21">2021</option>
                              <option value="22">2022</option>
                              <option value="23">2023</option>
                              <option value="24">2024</option>
                              <option value="25">2025</option>
                              <option value="26">2026</option>
                              <option value="27">2027</option>
                           </select>
                        </div>
                        
                        <!-- ==== CC Bank & CVV2 ==== -->
                        <div class="col-sm-6 no-padding-right">
                           <input type="text" class="form-control" name="ccbank" placeholder="Name of Issuing Bank">
                        </div>
                        <div class="col-sm-6 no-padding-left">
                           <input type="text" class="form-control" name="ccv" placeholder="Card ID / CVV2">
                           <span id="helpBlock" class="help-block pull-right" style="margin-bottom:5%"><a href="#">What's this?</a></span>
                        </div>
                        <div class="term">
                           <ul class="text-center">
                              <li>Transaction will appear as</li>
                              <li><h4><b>Flexi e-Solutions Pty Ltd</b></h4></li>
                              <li>on your Credit Card Statement</li>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <hr/>
               </div>
               <hr>
               <div class="form-group">
                  <div class="col-sm-4">
                     <label for="plan-details" class="control-label">Verification</label>
                  </div>
                  <div class="col-sm-8">
                     
                     <!-- ==== TERMS & CONDITION ==== -->
                     <div class="checkbox">
                        <label style="font-size:16px">
                           <input type="checkbox" required> I hereby agree with the <a href="#">Terms & Conditions</a>
                        </label>
                     </div>
                  </div>
               </div>
               <div class="form-group">
                  <div class="link text-center">
                     <button type="submit" class="btn btn-default btn-lg" name="submit">SUBMIT</button>
                  </div>
                  
               </div>
               
            </form>
         </div>
      </div>
   </div>
</section>
<script>
function numberWithCommas(x) {
    var parts = x.toString().split(".");
    parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    return parts.join(".");
}
   $(document).ready(function(){
      $(".payment,select[name=currency],.plan-total").addClass("hidden");
      $("select[name=plan]").change(function(){
         if($(this).val() == "free"){
            $("input[name=no-user").attr("max","50");
            $(".payment,select[name=currency],.plan-total").addClass("hidden");
            $("select[name=payment]").attr("required", false);
         }
         else if($(this).val() == "paid"){
            $("input[name=no-user]").attr("max", "1000");
            $(".payment,select[name=currency],.plan-total").removeClass("hidden");
            $("select[name=payment],select[name=currency],.plan-total").attr("required", true);
            $("select[name=currency],select[name=terms],input[name=no-user]").change(function(){
               var currency = $("select[name=currency]").val();
               var terms = $("select[name=terms]").val();
               var user = $("input[name=no-user]").val();
               var sign,price;
               if(currency == "php"){
                  sign = "₱ ";
                  price = 49.31;
               }
               else {
                  sign = "$ ";
                  if(currency == "usd") price = 0.99;
                  else if(currency == "aud") price = 1.32;
                  else if(currency == "sgd") price = 1.41;
               }
               var total = parseFloat((price * user) * terms).toFixed(2);
               $("label#total").text(sign + numberWithCommas(total));
            });
            $("select[name=payment]").change(function(){
               if($(this).val() == "cc"){
                  $("#cc").removeClass("hidden");
                  $("#cc input, #cc select").attr("required", true);
               }
               else{
                  $("#cc").addClass("hidden");
                  $("#cc input, #cc select").attr("required", false);
               }
            });
         }
      });
   });
</script>
<?php include "footer.html"; ?>