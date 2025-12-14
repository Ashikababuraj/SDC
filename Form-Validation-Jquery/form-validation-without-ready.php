<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

        <title>Document</title>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script>
    const form = $("#accountForm");

    form.on("submit", function(e) {
        e.preventDefault();
        
        let isValid = true;

        $("small.text-danger").text("");

        let holder = $("#holder_name").val().trim();
        if (holder === "") {
            $("#holder_error").text("Holder name is required");
            isValid = false;
        }

        let accNum = $("#account_number").val().trim();
        if (accNum === "") {
            $("#account_error").text("Account number is required");
            isValid = false;
        } else if (!/^\d+$/.test(accNum)) {
            $("#account_error").text("Account number must be digits only");
            isValid = false;
        } else if (accNum.length < 10) {
            $("#account_error").text("Account number must be at least 10 digits");
            isValid = false;
        }

        let balance = $("#balance").val().trim();
        if (balance === "") {
            $("#balance_error").text("Balance is required");
            isValid = false;
        } else if (isNaN(balance)) {
            $("#balance_error").text("Balance must be a number");
            isValid = false;
        }

        let status = $("#status").val();
        if (status === "") {
            $("#status_error").text("Please select a status");
            isValid = false;
        }

        if (isValid) {
            alert("Form submitted successfully!");
        }
    });
</script>


    </head>
    <body>
        <div class="container mt-5">
            <h3>Add new Account</h3>

<form id="accountForm">
    <div class="form-group">
        <label>Holder Name *</label>
        <input type="text" id="holder_name" class="form-control">
        <small class="text-danger" id="holder_error"></small>
    </div>

    <div class="form-group">
        <label>Account Number *</label>
        <input type="text" id="account_number" class="form-control">
        <small class="text-danger" id="account_error"></small>
    </div>

    <div class="form-group">
        <label>Balance *</label>
        <input type="text" id="balance" class="form-control">
        <small class="text-danger" id="balance_error"></small>
    </div>

    <div class="form-group">
        <label>Status *</label>
        <select id="status" class="form-control">
            <option value="">--Select Status--</option>
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
        </select>
        <small class="text-danger" id="status_error"></small>
    </div>

    <button type="submit" class="btn btn-primary mt-3">Submit</button>
</form>


<!-- 🔻 Script placed at bottom, so no need for document.ready -->

    </body>
</html>