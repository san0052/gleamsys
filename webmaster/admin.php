<?php 
include_once('../includes_webmaster/links.php');
include_once('../includes_webmaster/admininit.php');
page_header($cfg['ADMIN_TITLE']." - Admin Index");
?>
<link href="css/adminstyle.css" rel="stylesheet" type="text/css" />
<link href="css/cal.css" rel="stylesheet" type="text/css" />
<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<td vAlign=top align="center" width="99%"><!-- Start Body Here -->

  <table width="100%" border="0" align="center" cellpadding="2" cellspacing="0">
    <tr height="34">
      <td width="25%" rowspan="2" colspan="3" align="center" valign="top"><br />
        <br />
        <?php include_once("left_bar.php");?></td>
      </tr>
      <tr>
        <td align="center" valign="middle"><img src="images/spacer.gif" width="1" height="550" /></td>
        <td align="left" valign="top" width="99%">
          <table width="698" align="center" border="0" cellspacing="0" cellpadding="0" style="background:url(images/welcome_head.jpg) center top no-repeat;">
            <tr height="35" >
              <td align="left" valign="middle">&nbsp;&nbsp;<span class="style1">Welcome
                <?=$_SESSION['admin_user_name']?>
              </span></td>
              <td align="right" valign="middle" class="style5"><? include_once('dropdown.php');?>
              <a href="login.php?act=<?=md5("logout")?>" title="Logout"><img src="images/lock.png" height="24" width="24" border="0" style="vertical-align: middle;"/></a>&nbsp;&nbsp; </td>
            </tr>
            <tr>
              <td height="500" valign="top" colspan="2" align="center" style="background-color:#d5ecf7;">&nbsp;
            
                <h1> 
                  <!--  <script language="javascript"  src="ajax.js"></script> -->
                  <span class="portalpostheader"> ADMIN INDEX</span>&nbsp;&nbsp;<button type="button" data-toggle="modal" data-target="#myModal" ><i class="fa fa-calculator slow" aria-hidden="true" ></i></button></h1>
                  <div id="myModal" class="modal fade" role="dialog">
                    <div class="modal-dialog">

                      <!-- Modal content-->
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                          <h4 class="modal-title">Calculator</h4>
                        </div>
                        <div class="modal-body">
                       
                          <div class="calculator" style="height: 513px;">

                              <input type="text" class="calculator-screen" id="calculator-screen" value="" disabled />

                              <div class="calculator-keys">
                              
                                  <button type="button" class="operator" value="+">+</button>
                                  <button type="button" class="operator" value="-">-</button>
                                  <button type="button" class="operator" value="*">&times;</button>
                                  <button type="button" class="operator" value="/">&divide;</button>

                                  <button type="button" value="7">7</button>
                                  <button type="button" value="8">8</button>
                                  <button type="button" value="9">9</button>


                                  <button type="button" value="4">4</button>
                                  <button type="button" value="5">5</button>
                                  <button type="button" value="6">6</button>


                                  <button type="button" value="1">1</button>
                                  <button type="button" value="2">2</button>
                                  <button type="button" value="3">3</button>


                                  <button type="button" value="0">0</button>
                                  <button type="button" class="decimal function" value=".">.</button>
                                  <button type="button" class="all-clear function" value="all-clear">AC</button>

                                  <button type="button" class="equal-sign operator" value="=">=</button>  
                                  <button type="button" class="del function" id="del" >Del</button>
                              </div>
                          </div>
                       
  
                        </div>
                        <div class="modal-footer" style="height:449px;">
                          <!-- <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button> -->
                        </div>
                      </div>

                    </div>
                  </div>
                  <p>&nbsp;</p>
                  <table width="100%" border="0">
                    <?	
                    $a=date('Y-m-d');
                    $tomorrow = date("Y-m-d", strtotime("+1 day"));
// $sqlcutTime = "SELECT * FROM ".$cfg['DB_ORDER']." WHERE  `siteId`='".$cfg['SESSION_SITE']."' ";
// $rescutTime=$heart->sql_query($sqlcutTime);
// while($rowcutTime = $heart->sql_fetchrow($rescutTime))
// {
//    $rowdate = $rowcutTime['od_date'];
//    $rowdate1= explode(' ', $rowdate);
//    $rowdate2 = $rowdate1[0];
// }

                    $sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_delivery_date` ='".$a."' AND `siteId`='".$cfg['SESSION_SITE']."' ";
                    $res=$heart->sql_query($sql);
                    $maxrow=$heart->sql_numrows($res);
                    ?>
                    <tr align="center">
                      <td colspan="2"><strong>Today's Total Order:&nbsp;&nbsp;</strong>
                        <?=$maxrow?></td>
                      </tr>
                      <tr>
                        <td align="center" width="50%">&nbsp;</td>
                        <td align="center">&nbsp;</td>
                      </tr>
                      <tr>
                        <td colspan="2"><?php if($maxrow>0){ ?>
                          <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                            <thead>
                              <tr>
                                <td align="left"  class="style2" colspan="2" ><strong>Order Summary:</strong></td>
                              </tr>
                              <tr class="headercontent">
                                <td align="center" width="50%"  class="style2"><strong>Status</strong></td>
                                <td align="center"  class="style2"><strong>Number of Order </strong></td>
                              </tr>
                              <?
                              $sql1="SELECT count(`od_id`),`od_status` FROM ".$cfg['DB_ORDER']." WHERE `od_delivery_date` ='".$a."'  AND `siteId`='".$cfg['SESSION_SITE']."' group by `od_status` ";
                              $res1=$heart->sql_query($sql1);
                              $maxrow1=$heart->sql_numrows($res1);
                              $k=0;
                              while($row1=$heart->sql_fetchrow($res1)){ 
                                $k++;
                                ?>
                                <? if($k%2==0){?>
                                  <tr class="row1">
                                  <? } else { ?>
                                    <tr class="row2">
                                    <? }?>
                                    <td align="center"><a href="order.php?status=<?=$row1['od_status']?>&date=<?=date('Y-m-d')?>&show=date">Today's
                                      <?=$row1['od_status']?>
                                    Order</a></td>
                                    <td align="center"><?=$row1['count(`od_id`)']?></td>
                                  </tr>
                                <? } ?>

                              </table>
                              <? } ?></td>
                            </tr>
                            <?php
                            $sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_delivery_date` ='".$tomorrow."' AND `siteId`='".$cfg['SESSION_SITE']."' ";
                            $res=$heart->sql_query($sql);
                            $maxrow=$heart->sql_numrows($res);
                            ?>
                            <tr align="center">
                              <td colspan="2"><strong>Tommorrow's Total Order:&nbsp;&nbsp;</strong>
                                <?=$maxrow?></td>
                              </tr>
                              <tr>
                                <td align="center" width="50%">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2"><?php if($maxrow>0){ ?>
                                  <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                                    <thead>
                                      <tr>
                                        <td align="left"  class="style2" colspan="2" ><strong>Order Summary:</strong></td>
                                      </tr>
                                      <tr class="headercontent">
                                        <td align="center" width="50%"  class="style2"><strong>Status</strong></td>
                                        <td align="center"  class="style2"><strong>Number of Order </strong></td>
                                      </tr>
                                      <?
                                      $sql2="SELECT count(`od_id`),`od_status` FROM ".$cfg['DB_ORDER']." WHERE `od_delivery_date` ='".$tomorrow."'  AND `siteId`='".$cfg['SESSION_SITE']."' group by `od_status` ";
                                      $res2=$heart->sql_query($sql2);
                                      $maxrow2=$heart->sql_numrows($res2);
                                      $k=0;
                                      while($row2=$heart->sql_fetchrow($res2)){ 
                                        $k++;
                                        ?>
                                        <? if($k%2==0){?>
                                          <tr class="row1">
                                          <? } else { ?>
                                            <tr class="row2">
                                            <? }?>
                                            <td align="center"><a href="order.php?status=<?=$row2['od_status']?>&date=<?=$tomorrow?>&show=date">Tommorrow's
                                              <?=$row2['od_status']?>
                                            Order</a></td>
                                            <td align="center"><?=$row2['count(`od_id`)']?></td>
                                          </tr>
                                        <? } ?>

                                      </table>
                                      <? } ?></td>
                                    </tr>
                                     <?php
                                   $sql="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_status`!='D' AND `od_delivery_date` !='".$tomorrow."' AND `od_delivery_date` !='".$a."'  AND `siteId`='".$cfg['SESSION_SITE']."' ";
                                  $res=$heart->sql_query($sql);
                                  //$row2 = $res[0];
                                  $maxrow=$heart->sql_numrows($res);
                                ?>
                            <tr align="center">
                              <td colspan="2"><strong><a href="order.php" style="text-decoration:none; cursor:pointer; color:#005B5B">Total Order:</a>&nbsp;&nbsp;</strong>
                                <?=$maxrow?></td>
                              </tr>
                              <tr>
                                <td align="center" width="50%">&nbsp;</td>
                                <td align="center">&nbsp;</td>
                              </tr>
                              <tr>
                                <td colspan="2"><?php if($maxrow>0){ ?>
                                  <table width="90%" align="center" cellPadding=6 cellSpacing=1 class="tborder_new">
                                    <thead>
                                      <tr>
                                        <td align="left"  class="style2" colspan="2" ><strong>Order Summary:</strong></td>
                                      </tr>
                                      <tr class="headercontent">
                                        <td align="center" width="50%"  class="style2"><strong>Status</strong></td>
                                        <td align="center"  class="style2"><strong>Number of Order </strong></td>
                                      </tr>
                                      <?
                                      $sql2="SELECT * FROM ".$cfg['DB_ORDER']." WHERE `od_status`!='D' AND `od_delivery_date` !='".$tomorrow."' AND `od_delivery_date` !='".$a."' AND  `siteId`='".$cfg['SESSION_SITE']."' ";
                                      $res2=$heart->sql_query($sql2);
                                      $maxrow2=$heart->sql_numrows($res2);
                                      $k=0;
        
                                        $k++;
                                        $deliveryDate = substr($row2['od_delivery_date'], 0, 10);
                                      
                                      
                                        ?>
                                        <? if($k%2==0){?>
                                          <tr class="row1">
                                          <? } else { ?>
                                            <tr class="row2">
                                            <? }?>
                                            <td align="center"><a href="order.php?show=total&on_date=<?=$a?>&to_date=<?=$tomorrow?>">Total
                                            Order</a></td>
                                            <td align="center"><?=$maxrow2?></td>
                                          </tr>
                                    

                                      </table>
                                      <? } ?></td>
                                    </tr>
                                  </table></td>
                                </tr>

                                
                                  </table></td>
                                </tr>
                                <!--<tr height="16">
                                  <td colspan="2" style="background:url(images/foot_bg.jpg) center top no-repeat; box-shadow:0 10px 6px -6px #777;">&nbsp;</td>
                                </tr>-->
                              </table></td>
                            </tr>
                            <tr>
                              <td colspan="3" align="right"></td>
                            </tr>
                          </table>
                          
<script type="text/javascript">
  const calculator = 
  {
    displayValue: '0',
    firstOperand: null,
    waitingForSecondOperand: false,
    operator: null,
  };

  function inputDigit(digit) 
  {
    const { displayValue, waitingForSecondOperand } = calculator;

    if (waitingForSecondOperand === true) 
    {
      calculator.displayValue = digit;
      calculator.waitingForSecondOperand = false;
    } else 
    {
      calculator.displayValue = displayValue === '0' ? digit : displayValue + digit;
    }
  //   console.log(calculator);
  }

  function inputDecimal(dot) 
  {
      if (calculator.waitingForSecondOperand === true) return;
    // If the `displayValue` does not contain a decimal point
    if (!calculator.displayValue.includes(dot)) 
    {
      // Append the decimal point
      calculator.displayValue += dot;
    }
  }

  function handleOperator(nextOperator) 
  {
      const { firstOperand, displayValue, operator } = calculator
      const inputValue = parseFloat(displayValue);

      if (operator && calculator.waitingForSecondOperand) 
      {
          calculator.operator = nextOperator;
          console.log(calculator);
          return;
      }

      if (firstOperand == null) 
      {
          calculator.firstOperand = inputValue;
      } else if (operator) 
      {
          const result = performCalculation[operator](firstOperand, inputValue);

          calculator.displayValue = String(result);
          calculator.firstOperand = result;
      }

      calculator.waitingForSecondOperand = true;
      calculator.operator = nextOperator;
      console.log(calculator);
  }

  const performCalculation = 
  {
    '/': (firstOperand, secondOperand) => firstOperand / secondOperand,

    '*': (firstOperand, secondOperand) => firstOperand * secondOperand,

    '+': (firstOperand, secondOperand) => firstOperand + secondOperand,

    '-': (firstOperand, secondOperand) => firstOperand - secondOperand,

    '=': (firstOperand, secondOperand) => secondOperand
  };

  function resetCalculator() 
  {
    calculator.displayValue = '0';
    calculator.firstOperand = null;
    calculator.waitingForSecondOperand = false;
    calculator.operator = null;
  }

  function back() 
  {
      var value = calculator.displayValue;
      var len   = value.length-1;
      var newnumber = value.substring(0,len);
      calculator.displayValue = newnumber;
      calculator.firstOperand = null;
      calculator.waitingForSecondOperand = false;
      calculator.operator = null;
      
  }


  function updateDisplay() 
  {
    const display = document.querySelector('.calculator-screen');
    display.value = calculator.displayValue;
  }

  updateDisplay();

  const keys = document.querySelector('.calculator-keys');
  keys.addEventListener('click', (event) => 
  {
      const { target } = event;
      if (!target.matches('button')) 
      {
          return;
      }

      if (target.classList.contains('operator')) 
      {
          handleOperator(target.value);
          updateDisplay();
          return;
      }

      if (target.classList.contains('decimal')) 
      {
          inputDecimal(target.value);
          updateDisplay();
          return;
      }

      if (target.classList.contains('all-clear')) 
      {
          resetCalculator();
          updateDisplay();
          return;
      }

      if (target.classList.contains('del')) 
      {
          back();
          updateDisplay();
          return;
      }

      inputDigit(target.value);
      updateDisplay();
  });
</script>