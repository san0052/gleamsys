<?php
include_once("includes/links_frontend.php"); ?>

<!DOCTYPE html>
<html lang="en">
<?php include_once('includes/pagesources.php');?>
<body>
    <? include_once('includes/header.php') ?>

    <div class="container-fluid slide_container">
        <?php 
           $sql =   "SELECT * FROM ".$cfg['DB_SERVICE_BANNER']."
                                     WHERE  
                                    `status` ='A' 
                                    AND `id` = 3
                                    AND `bannerType`='computer-services'"; 
            $res    =   $mycms->sql_query($sql);
            $row    =   $mycms->sql_fetchrow($res);
        ?>
        <div class="item">

            <img src="images/<?php echo $row['bannerImg']?>">

            <div class="banner-text">

                 <?php echo $row['BannerTitle']?><br>

            </div>

        </div>

    </div>

    <div class="container-fluid">

        <div class="container">

            <div class="row">

                <div class="cm-tr-up">

                    <div class="cm-tr-pic">

                        <img src="images/cm-tr.jpg">

                    </div>

                    <div class="cm-tr-tab">

                        <div class="tab">

                            <button class="tablinks active" onclick="openCity(event, 'London')">Training</button>

                            <button class="tablinks" onclick="openCity(event, 'Paris')">Aims</button>

                            <button class="tablinks" onclick="openCity(event, 'Tokyo')">Outcomes</button>

                        </div>



                        <div id="London" class="tabcontent" style="display: block;">

                            <ul class="why-us-content">

                                <li><span class="chk-tick"><i class="fa fa-check"></i></span>Attend our free computer education sessions</li>

                                <li><span class="chk-tick"><i class="fa fa-check"></i></span>Join specific groups</li>

                                <li><span class="chk-tick"><i class="fa fa-check"></i></span>Certified Trainers</li>

                            </ul>

                        </div>



                        <div id="Paris" class="tabcontent">

                            <p>This course aims to familiarise you with computers and Microsoft Windows, while learning basic computer, mouse and keyboard skills in a supportive classroom environment.</p>

                        </div>



                        <div id="Tokyo" class="tabcontent">

                            <ul class="why-us-content">

                                <li><span class="chk-tick"><i class="fa fa-check"></i></span>Appropriately start up and shut down your computer</li>

                                <li><span class="chk-tick"><i class="fa fa-check"></i></span>Navigate the operating system and start applications</li>

                                <li><span class="chk-tick"><i class="fa fa-check"></i></span>Perform basic functions of file management</li>

                                <li><span class="chk-tick"><i class="fa fa-check"></i></span>Perform basic functions in a word processor and spreadsheet</li>

                                <li><span class="chk-tick"><i class="fa fa-check"></i></span>Manage print settings and print documents</li>

                                <li><span class="chk-tick"><i class="fa fa-check"></i></span>Receive and send emails</li>

                                <li><span class="chk-tick"><i class="fa fa-check"></i></span>Use a web browser to navigate the Internet</li>

                            </ul>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

    <div class="container-fluid cm-tr-content-wrap">

        <div class="container">

            <div class="row">

                <div class="col-xs-12 heading">

                    <h2>Training Courses</h2>

                </div>

                <div class="col-xs-12 cm-tr-contents">

                    <div class="col-xs-12 cm-tr-content-box">

                        <svg xmlns="http://www.w3.org/2000/svg" id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512">

                            <g>

                                <g>

                                    <path d="m472 76v300h-432v-300z" fill="#99ebfa" />

                                    <path d="m502 376c0 33.14-26.86 60-60 60h-372c-33.14 0-60-26.86-60-60z" fill="#eefaff" />

                                    <path d="m395.39 262.97c-5.133 5.133-37.253 37.253-42.42 42.42l-31.82-74.24z" fill="#8690a6" />

                                    <circle cx="196" cy="226" fill="#eefaff" r="90" />

                                </g>

                                <g>

                                    <path d="m196 126c-55.14 0-100 44.86-100 100s44.86 100 100 100 100-44.86 100-100-44.86-100-100-100zm79.353 90h-39.534c-.861-23.989-4.837-47.937-12.228-65.094 27.549 10.154 47.998 35.065 51.762 65.094zm-79.353 90c-.858 0-6.351-3.394-11.727-19.521-4.553-13.658-7.352-31.308-8.078-50.479l39.609-.01c-.725 19.171-3.525 36.831-8.078 50.489-5.375 16.127-10.868 19.521-11.726 19.521zm-19.805-90c.725-19.171 3.525-36.821 8.078-50.479 5.376-16.128 10.869-19.521 11.727-19.521s6.351 3.394 11.727 19.521c4.553 13.658 7.352 31.308 8.078 50.479zm-7.785-65.094c-7.391 17.156-11.367 41.105-12.228 65.094h-39.534c3.763-30.029 24.212-54.94 51.762-65.094zm-51.763 85.094h39.534c.861 23.989 4.837 47.937 12.228 65.094-27.549-10.155-47.998-35.066-51.762-65.094zm106.943 65.093c7.391-17.156 11.367-41.115 12.228-65.104l39.534.01c-3.763 30.029-24.212 54.94-51.762 65.094z" />

                                    <path d="m413.071 308.928-24.749-24.749 14.139-14.139c4.994-4.995 3.369-13.477-3.132-16.263l-74.24-31.82c-3.758-1.61-8.118-.771-11.011 2.12-2.891 2.892-3.731 7.252-2.12 11.011l31.82 74.24c2.797 6.526 11.282 8.113 16.263 3.132l14.139-14.139 24.749 24.749c3.905 3.905 10.237 3.905 14.143 0 3.904-3.904 3.904-10.236-.001-14.142zm-56.728-21.053-16.152-37.685 37.685 16.152-10.762 10.762c-.002.002-.003.003-.005.005s-.003.003-.005.005z" />

                                    <circle cx="256" cy="436" r="10" />

                                    <path d="m502 366h-20v-290c0-5.523-4.477-10-10-10h-432c-5.523 0-10 4.477-10 10v290h-20c-5.523 0-10 4.477-10 10 0 38.598 31.402 70 70 70h141c5.523 0 10-4.477 10-10s-4.477-10-10-10h-141c-24.146 0-44.349-17.206-48.996-40.01h469.991c-4.646 22.804-24.849 40.01-48.995 40.01h-141c-5.523 0-10 4.477-10 10s4.477 10 10 10h141c38.598 0 70-31.402 70-70 0-5.523-4.477-10-10-10zm-452-280h412v280h-412z" />

                                </g>

                            </g>

                        </svg>

                        <h4>Beginner</h4>

                        <button class="enquery-btn" onclick="enqueryslide('begin')">Enquiry</button>

                        <ul class="why-us-content">

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Fundamentals of computer</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Fundamental of operating system</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>E-mail & internet</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Introduction of computer virus</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Introduction to search engine</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Sending and receiving e-mail</li>

                        </ul>



                    </div>

                    <div class="col-xs-12 cm-tr-content-box">

                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 480.003 480.003" style="enable-background:new 0 0 480.003 480.003;" xml:space="preserve">

                            <path style="fill:#E0E0E2;" d="M456.002,376.003h-432c-8.837,0-16,7.163-16,16v64c0,8.837,7.163,16,16,16h432  c8.837,0,16-7.163,16-16v-64C472.002,383.167,464.838,376.003,456.002,376.003z M64.002,448.003c-13.255,0-24-10.745-24-24  s10.745-24,24-24s24,10.745,24,24S77.256,448.003,64.002,448.003L64.002,448.003z" />

                            <circle style="fill:#2488FF;" cx="64.002" cy="424.003" r="24" />

                            <path style="fill:#FFDA44;" d="M256.002,320.003l160,24v-168h-160V320.003z" />

                            <path style="fill:#5EAC24;" d="M416.002,8.003l-160,32v112h160V8.003z" />

                            <path style="fill:#006DF0;" d="M64.002,288.003l160,24v-136h-160V288.003z" />

                            <path style="fill:#FF9811;" d="M224.002,48.003l-160,32v72h160V48.003z" />

                            <g>

                                <path style="fill:#231F20;" d="M456.002,480.003h-432c-13.255,0-24-10.745-24-24v-64c0-13.255,10.745-24,24-24h432   c13.255,0,24,10.745,24,24v64C480.002,469.258,469.256,480.003,456.002,480.003z M24.002,384.003c-4.418,0-8,3.582-8,8v64   c0,4.418,3.582,8,8,8h432c4.418,0,8-3.582,8-8v-64c0-4.418-3.582-8-8-8H24.002z" />

                                <path style="fill:#231F20;" d="M64.002,456.003c-17.673,0-32-14.327-32-32s14.327-32,32-32s32,14.327,32,32   S81.675,456.003,64.002,456.003z M64.002,408.003c-8.837,0-16,7.163-16,16s7.163,16,16,16s16-7.163,16-16   S72.838,408.003,64.002,408.003z" />

                                <path style="fill:#231F20;" d="M440.002,432.003h-320c-4.418,0-8-3.582-8-8s3.582-8,8-8h320c4.418,0,8,3.582,8,8   S444.42,432.003,440.002,432.003z" />

                                <path style="fill:#231F20;" d="M416.002,352.003c-0.396-0.001-0.792-0.031-1.184-0.088l-160-24   c-3.917-0.586-6.816-3.951-6.816-7.912v-144c0-4.418,3.582-8,8-8h160c4.418,0,8,3.582,8,8v168   C424.002,348.421,420.42,352.003,416.002,352.003z M264.002,313.115l144,21.6V184.003h-144V313.115z" />

                                <path style="fill:#231F20;" d="M416.002,160.003h-160c-4.418,0-8-3.582-8-8v-112c-0.001-3.802,2.675-7.08,6.4-7.84l160-32   c4.329-0.884,8.555,1.909,9.438,6.238c0.108,0.527,0.162,1.064,0.162,1.602v144C424.002,156.421,420.42,160.003,416.002,160.003z    M264.002,144.003h144V17.763l-144,28.8V144.003z" />

                                <path style="fill:#231F20;" d="M224.002,320.003c-0.396-0.001-0.792-0.031-1.184-0.088l-160-24   c-3.917-0.586-6.816-3.951-6.816-7.912v-112c0-4.418,3.582-8,8-8h160c4.418,0,8,3.582,8,8v136   C232.002,316.421,228.42,320.003,224.002,320.003z M72.002,281.115l144,21.6V184.003h-144V281.115z" />

                                <path style="fill:#231F20;" d="M224.002,160.003h-160c-4.418,0-8-3.582-8-8v-72c-0.001-3.802,2.675-7.08,6.4-7.84l160-32   c4.329-0.884,8.555,1.909,9.438,6.238c0.108,0.527,0.162,1.064,0.162,1.602v104C232.002,156.421,228.42,160.003,224.002,160.003z    M72.002,144.003h144v-86.24l-144,28.8V144.003z" />

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                            <g>

                            </g>

                        </svg>

                        <h4>Advanced</h4>

                        <button class="enquery-btn" onclick="enqueryslide('adv')">Enquiry</button>

                        <ul class="why-us-content">

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Application software(Microsoft office)</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Operating system-windows</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Ms PowerPoint (animation)</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Ms word (text)</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Ms excel (a/c maintain)</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Ms access (data base management system)</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Introduction to pc h/w</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Introduction to networking</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>H/w installation and configuration</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Pc debugging, troubleshooting & maintenance</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>S/w installation & configuration, networking basis & configuration</li>

                        </ul>

                    </div>

                    <div class="col-xs-12 cm-tr-content-box">

                        <svg xmlns="http://www.w3.org/2000/svg" id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512">

                            <g>

                                <path d="m504.5 151h-497v-42c0-16.569 13.431-30 30-30h437c16.569 0 30 13.431 30 30z" fill="#43809f" />

                                <path d="m474.5 79v72h30v-42c0-16.569-13.431-30-30-30z" fill="#3a7190" />

                                <path d="m474.5 433h-437c-16.569 0-30-13.431-30-30v-252h497v252c0 16.569-13.431 30-30 30z" fill="#a9dbf5" />

                                <path d="m474.5 151v282c16.569 0 30-13.431 30-30v-252z" fill="#88c3e0" />

                                <circle cx="55.507" cy="115.371" fill="#29cef6" r="15" />

                                <circle cx="113.666" cy="115.371" fill="#f3f3f3" r="15" />

                                <circle cx="171.825" cy="115.371" fill="#f78e36" r="15" />

                                <path d="m382.5 234.868h-47c-8.284 0-15-6.716-15-15 0-8.284 6.716-15 15-15h47c8.284 0 15 6.716 15 15 0 8.284-6.716 15-15 15z" fill="#29cef6" />

                                <path d="m459.5 294.868h-124c-8.284 0-15-6.716-15-15 0-8.284 6.716-15 15-15h124c8.284 0 15 6.716 15 15 0 8.284-6.716 15-15 15z" fill="#ffc328" />

                                <path d="m422.665 354.868h-87.165c-8.284 0-15-6.716-15-15 0-8.284 6.716-15 15-15h87.165c8.284 0 15 6.716 15 15 0 8.284-6.716 15-15 15z" fill="#f78e36" />

                                <g>

                                    <path d="m474.5 71.5h-26.261c-4.143 0-7.5 3.357-7.5 7.5s3.357 7.5 7.5 7.5h26.261c12.406 0 22.5 10.094 22.5 22.5v34.5h-482v-34.5c0-12.406 10.093-22.5 22.5-22.5h377.809c4.143 0 7.5-3.357 7.5-7.5s-3.357-7.5-7.5-7.5h-377.809c-20.678 0-37.5 16.822-37.5 37.5v82.681c0 4.143 3.358 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-33.181h482v193.366c0 4.143 3.357 7.5 7.5 7.5s7.5-3.357 7.5-7.5v-242.866c0-20.678-16.822-37.5-37.5-37.5z" />

                                    <path d="m504.5 375.994c-4.143 0-7.5 3.357-7.5 7.5v19.506c0 12.406-10.094 22.5-22.5 22.5h-437c-12.407 0-22.5-10.094-22.5-22.5v-179.133c0-4.143-3.358-7.5-7.5-7.5s-7.5 3.357-7.5 7.5v179.133c0 20.678 16.822 37.5 37.5 37.5h437c20.678 0 37.5-16.822 37.5-37.5v-19.506c0-4.142-3.357-7.5-7.5-7.5z" />

                                    <path d="m108.482 234.457c-2.929-2.928-7.678-2.928-10.606 0l-45.07 45.07c-1.407 1.407-2.197 3.314-2.197 5.304s.79 3.896 2.197 5.304l44.474 44.474c1.464 1.464 3.384 2.196 5.303 2.196s3.839-.732 5.303-2.196c2.929-2.93 2.929-7.678 0-10.607l-39.171-39.17 39.767-39.767c2.93-2.93 2.93-7.678 0-10.608z" />

                                    <path d="m209.344 334.608c1.464 1.464 3.384 2.196 5.303 2.196s3.839-.732 5.303-2.196l44.475-44.474c1.406-1.407 2.196-3.314 2.196-5.304s-.79-3.896-2.196-5.304l-45.071-45.07c-2.929-2.928-7.678-2.928-10.606 0-2.929 2.93-2.929 7.678 0 10.607l39.768 39.767-39.171 39.17c-2.93 2.931-2.93 7.679-.001 10.608z" />

                                    <path d="m131.99 362.234c3.025 0 5.876-1.844 7.013-4.841l53.294-140.398c1.47-3.873-.478-8.204-4.35-9.674-3.872-1.471-8.204.478-9.673 4.35l-53.294 140.4c-1.47 3.872.478 8.203 4.35 9.673.876.333 1.775.49 2.66.49z" />

                                    <path d="m33.006 115.371c0 12.406 10.093 22.5 22.5 22.5s22.5-10.094 22.5-22.5-10.093-22.5-22.5-22.5-22.5 10.094-22.5 22.5zm30 0c0 4.136-3.364 7.5-7.5 7.5s-7.5-3.364-7.5-7.5 3.364-7.5 7.5-7.5 7.5 3.364 7.5 7.5z" />

                                    <path d="m91.166 115.371c0 12.406 10.093 22.5 22.5 22.5s22.5-10.094 22.5-22.5-10.093-22.5-22.5-22.5-22.5 10.094-22.5 22.5zm30 0c0 4.136-3.364 7.5-7.5 7.5s-7.5-3.364-7.5-7.5 3.364-7.5 7.5-7.5 7.5 3.364 7.5 7.5z" />

                                    <path d="m149.325 115.371c0 12.406 10.093 22.5 22.5 22.5s22.5-10.094 22.5-22.5-10.093-22.5-22.5-22.5-22.5 10.094-22.5 22.5zm30 0c0 4.136-3.364 7.5-7.5 7.5s-7.5-3.364-7.5-7.5 3.364-7.5 7.5-7.5 7.5 3.364 7.5 7.5z" />

                                    <path d="m335.5 242.368h47c12.406 0 22.5-10.094 22.5-22.5s-10.094-22.5-22.5-22.5h-47c-12.406 0-22.5 10.094-22.5 22.5s10.094 22.5 22.5 22.5zm0-30h47c4.136 0 7.5 3.364 7.5 7.5s-3.364 7.5-7.5 7.5h-47c-4.136 0-7.5-3.364-7.5-7.5s3.364-7.5 7.5-7.5z" />

                                    <path d="m335.5 302.368h124c12.406 0 22.5-10.094 22.5-22.5s-10.094-22.5-22.5-22.5h-124c-12.406 0-22.5 10.094-22.5 22.5s10.094 22.5 22.5 22.5zm0-30h124c4.136 0 7.5 3.364 7.5 7.5s-3.364 7.5-7.5 7.5h-124c-4.136 0-7.5-3.364-7.5-7.5s3.364-7.5 7.5-7.5z" />

                                    <path d="m335.5 362.368h87.165c12.406 0 22.5-10.094 22.5-22.5s-10.094-22.5-22.5-22.5h-87.165c-12.406 0-22.5 10.094-22.5 22.5s10.094 22.5 22.5 22.5zm0-30h87.165c4.136 0 7.5 3.364 7.5 7.5s-3.364 7.5-7.5 7.5h-87.165c-4.136 0-7.5-3.364-7.5-7.5s3.364-7.5 7.5-7.5z" />

                                </g>

                            </g>

                        </svg>

                        <h4>Professional</h4>

                        <button class="enquery-btn" onclick="enqueryslide('prof')">Enquiry</button>

                        <ul class="why-us-content">

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Concept of web designing</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Introduction to web technology</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Introduction to client server technology</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Concept of internet working</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Fundamental of browsers</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Introduction to Photoshop</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Internet, protocols and browser</li>

                            <li><span class="chk-tick"><i class="fa fa-check"></i></span>Html, Dhtml, Css, java script</li>

                        </ul>

                    </div>



                </div>



            </div>

        </div>

    </div>

    <? include_once('includes/footer.php') ?>

</body>

<script>

    function openCity(evt, cityName) {

        var i, tabcontent, tablinks;

        tabcontent = document.getElementsByClassName("tabcontent");

        for (i = 0; i < tabcontent.length; i++) {

            tabcontent[i].style.display = "none";

        }

        tablinks = document.getElementsByClassName("tablinks");

        for (i = 0; i < tablinks.length; i++) {

            tablinks[i].className = tablinks[i].className.replace(" active", "");

        }

        document.getElementById(cityName).style.display = "block";

        evt.currentTarget.className += " active";

    }

</script>



</html>