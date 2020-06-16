<html>
<head></head>
<link href="css/cal.css" rel="stylesheet" type="text/css" />
<body>
<div class="container">
    <div class="calculator">

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
  

</body>
</html>

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