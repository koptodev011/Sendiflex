New! Keyboard shortcuts … Drive keyboard shortcuts have been updated to give you first-letters navigation
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Simple Calculator</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom styles -->
  <style>
    .calculator {
      max-width: 400px;
      margin: 0 auto;
      margin-top: 50px;
      border: 1px solid #ccc;
      padding: 20px;
      border-radius: 5px;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="calculator">
      <h2 class="text-center mb-4">Simple Calculator</h2>
      <form id="calculatorForm">
        <div class="form-group">
          <label for="num1">Number 1</label>
          <input type="number" class="form-control" id="num1" name="num1" required>
        </div>
        <div class="form-group">
          <label for="operator">Operator</label>
          <select class="form-control" id="operator" name="operator" required>
            <option value="+">+</option>
            <option value="-">-</option>
            <option value="*">*</option>
            <option value="/">/</option>
          </select>
        </div>
        <div class="form-group">
          <label for="num2">Number 2</label>
          <input type="number" class="form-control" id="num2" name="num2" required>
        </div>
        <button type="submit" class="btn btn-primary btn-block">Calculate</button>
      </form>
      <div id="result" class="mt-4">
        <!-- Result will be displayed here -->
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <!-- Calculator logic -->
  <script>
    document.getElementById('calculatorForm').addEventListener('submit', function(event) {
      event.preventDefault();
      let num1 = parseFloat(document.getElementById('num1').value);
      let num2 = parseFloat(document.getElementById('num2').value);
      let operator = document.getElementById('operator').value;
      let result;

      switch (operator) {
        case '+':
          result = num1 + num2;
          break;
        case '-':
          result = num1 - num2;
          break;
        case '*':
          result = num1 * num2;
          break;
        case '/':
          result = num1 / num2;
          break;
        default:
          result = 'Invalid operator';
      }

      document.getElementById('result').innerHTML = `<h4>Result: ${result}</h4>`;
    });
  </script>
</body>
</html>
