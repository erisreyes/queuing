<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>
    <button onclick="serveNextCustomer()">Next Customer</button>
    <div id="activeCustomers">
        <h2>Active Customers</h2>
        <ul id="customerList"></ul>
    </div>

    <script>
        function serveNextCustomer() {
            fetch('serve_next_customer.php')
                .then(() => getActiveCustomers());
        }

        function getActiveCustomers() {
            fetch('get_active_customers.php')
                .then(response => response.json())
                .then(customers => {
                    const customerList = document.getElementById('customerList');
                    customerList.innerHTML = '';
                    customers.forEach(customer => {
                        const listItem = document.createElement('li');
                        listItem.textContent = `${customer.name} (ID: ${customer.unique_number})`;
                        customerList.appendChild(listItem);
                    });
                });
        }

        getActiveCustomers();
    </script>
</body>
</html>
