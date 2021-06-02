<?php 

echo '
<div class="row">
      <div class="col-md-2"></div>
      <div class="col-md-8 p-4 bg-white rounded-lg shadow-sm">
      <form class="branding-form">
      <div class="form-group mb-3">
      <label for="brand_name"><b>Enter brand name&nbsp; <i class="fa fa-edit branding-edit" style="cursor:pointer;"></i></b></label>
      <input type="text" name="brand_name" id="brand_name" placeholder="Wap institute" class="form-control">
      </div>

      <div class="form-group mb-3">
      <label for="brand_logo"><b>Upload brand logo</b></label>
      <input type="file" id="brand_logo" name="brand_logo" class="form-control">
      </div>

      <div class="form-group mb-3">
      <label for="domain_name"><b>Enter domain name</b></label>
      <input type="url" name="domain_name" id="domain_name" placeholder="www.Wapinstitute.com" class="form-control">
      </div>

      <div class="form-group mb-3">
      <label for="email"><b>Email</b></label>
      <input type="email" name="email" id="email" placeholder="Wapinstitute@gmail.com" class="form-control">
      </div>

      <div class="form-group mb-3">
      <label for="phone"><b>Phone</b></label>
      <input type="number" id="phone" name="phone" placeholder="Phone" class="form-control">
      </div>

      <div class="form-group mb-3">
      <label><b>Social handle</b></label>
      <input type="url" name="facebook_url" id="facebook_url" placeholder="Facebook page url" class="form-control mb-2">
      <input type="url" name="twitter_url" id="twitter_url" placeholder="Twitter page url" class="form-control">
      </div>

      <div class="form-group mb-3">
      <label for="address"><b>Address</b></label>
      <textarea name="address" class="form-control" id="address"></textarea>
      </div>

      <div class="form-group mb-3">
      <label for="about-us"><b>About  <small class="about-us-count">0</small><small>/500</small></b></label>
      <textarea maxlength="5000" rows="10" name="about" id="about_us" class="form-control"></textarea>
      </div>


      <div class="form-group mb-3">
      <label for="p_policy"><b>Privacy policy <small class="privacy-count">0</small><small>/500</small></b></label>
      <textarea rows="10" name="p_policy" maxlength="5000" id="p_policy" class="form-control" maxlength="5000"></textarea>
      </div>

      <div class="form-group mb-3">
      <label for="c_policy"><b>Cookies policy <small class="cookies-count">0</small><small>/500</small> </b></label>
      <textarea rows="10" maxlength="5000" name="c_policy" id="c_policy" class="form-control"></textarea>
      </div>

      <div class="form-group mb-3">
      <label for="t_condition"><b>Terms & condition <small class="terms-count">0</small><small>/500</small></b></label>
      <textarea maxlength="5000" rows="10" name="t_condition" id="t_condition" class="form-control"></textarea>
      </div>


      <div class="form-group mb-3">
     <button type="submit" class="btn btn-primary">Submit your information</button>
      </div>


      </form>
      </div>
      <div class="col-md-2"></div>
      </div>
  
       </div>';
       ?>