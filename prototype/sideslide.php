<div class="col-xs-12 side-modal-box" id="side-modal">
    <div class="col-xs-12 side-modal-main-box">
        <div class="login-box" id="login">
            <div class="book-header">
                <p>LOGIN</p>
                <button onclick="bookcls()"><i class="fas fa-grip-lines"></i></button>
            </div>
            <div class="book-content">
                <div class="book-content-inner">
                    <form>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Email Id">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="password" placeholder="Password">
                        </div>
                    </form>
                </div>
                <div class="book-footer">
                    <div class="total">

                        <p class="prd-price">Do Not have Account?</p>
                        <a onclick="openregi()">Register Now</a>
                    </div>
                    <div style="float:right;">
                        <button type="button" id="nextBtn" onclick="nextPrev(1)" class="demo-class">LOGIN</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="regi-box" id="regi">
            <div class="book-header">
                <p>REGISTRATION</p>
                <button onclick="bookcls()"><i class="fas fa-grip-lines"></i></button>
            </div>
            <div class="book-content">
                <div class="book-content-inner">
                    <form>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Full Name">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Mobile Number">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Email Id">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Location">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="City">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="State">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Country">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Pin Code">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="password" placeholder="Password">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="password" placeholder="Confirm Password">
                        </div>
                    </form>
                </div>
                <div class="book-footer">
                    <div class="total">

                        <p class="prd-price">Already have Account?</p>
                        <a onclick="openlogin()">Login Now</a>
                    </div>
                    <div style="float:right;">
                        <button type="button" id="nextBtn" onclick="nextPrev(1)" class="demo-class">REGISTER</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-box" id="enquery">
            <div class="book-header">
                <p>ENQUIRY</p>
                <button onclick="bookcls()"><i class="fas fa-grip-lines"></i></button>
            </div>
            <div class="book-content">
                <div class="book-content-inner">
                    <form>
                    <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Full Name">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Email Id">
                        </div>
                        <div class="col-xs-12 form-group">
                            <!-- <label>Full Name</label> -->
                            <input type="text" placeholder="Mobile Number">
                        </div>
                        <div class="col-xs-12 form-group pl pr">
                                    <div class="col-xs-4 rc pl">
                                        <label>BEGINNER
                                            <div>
                                            <input type="radio" name="loginType" value="student" checked="">
                                            <span class="checkmark"></span>
                                            </div>
                                            
                                        </label>
                                    </div>
                                    <div class="col-xs-4 rc pr">
                                        <label>ADVANCED
                                            <input type="radio" name="loginType" value="teacher">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                    <div class="col-xs-4 rc pr">
                                        <label>PROFESSIONAL
                                            <input type="radio" name="loginType" value="teacher">
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                        <div class="col-xs-12 form-group">
                            <textarea placeholder="Message"></textarea>
                        </div>
                    </form>
                </div>
                <div class="book-footer">
                    
                    <div style="float:right;">
                        <button type="button" id="nextBtn" onclick="nextPrev(1)" class="demo-class">SUBMIT</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>