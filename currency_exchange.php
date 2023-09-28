<?php

require 'header.php';

if (!isset($_SESSION['name'])) {
    header('location:login.php');
}
?>

<body>
    <div class="container-fluid banner">
        <div class="row">
            <div class="col-md-12">
                <nav class="navbar navbar-md">
                    <div class="navbar-brand">TechnoHacks Internship</div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link" href="home.php">Dashboard</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">Log Out</a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="converter">
                <div class="container-fluid banner">
                    <section class="wrapper">
                        <div class="container">
                            <div class="col-sm-8 offset-sm-2 col-lg-6 offset-lg-3 col-xl-6 offset-xl-3 text-center">
                                <form action="convert.php" method="post" class="rounded bg-white shadow p-5">
                                    <h3 class="text-dark fw-bolder fs-4 mb-2">Currency Converter</h3>
                                    <div class="fw-normal text-muted mb-4">
                                        Here i used open exchange rates API to convert currency.
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center fw-bold mb-4">
                                        <!-- <span>Base Currency:</span> -->
                                        <label for="base_currency">Base Currency</label>
                                        <select class="form-control" name="base_currency" id="base_currency">
                                        <!-- Options will be dynamically populated with available currencies -->
                                    </select>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-center fw-bold mb-4">
                                        <!-- <span>Target Currency:</span> -->
                                        <label for="target_currency">Target Currency</label>
                                        <select class="form-control" name="target_currency" id="target_currency">
                                        <!-- Options will be dynamically populated with available currencies -->
                                    </select>
                                    </div>

                                
                                    <label for="amount">Amount:</label>
                                    <input type="number" name="amount" id="amount" step="0.01" class="form-control" required>
                                    <button type="submit" name="submit" class="btn btn-primary submit_btn my-4">Convert</button>
                                   <hr>

                                    <div class="fw-normal text-muted mb-2">
                                        <div class="result" id="result"></div>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </section>


                </div>

            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Fetch list of supported currencies
                fetch('https://openexchangerates.org/api/currencies.json')
                    .then(response => response.json())
                    .then(data => {
                        const baseCurrencySelect = document.getElementById('base_currency');
                        const targetCurrencySelect = document.getElementById('target_currency');

                        // Populate base currency dropdown
                        for (const currencyCode in data) {
                            const option = document.createElement('option');
                            option.value = currencyCode;
                            option.textContent = `${currencyCode} - ${data[currencyCode]}`;
                            baseCurrencySelect.appendChild(option);
                        }

                        // Clone options to target currency dropdown
                        [...baseCurrencySelect.options].forEach(option => {
                            targetCurrencySelect.appendChild(option.cloneNode(true));
                        });
                    })
                    .catch(error => console.error('Error fetching currencies:', error));

                // Handle form submission
                const form = document.querySelector('form');
                form.addEventListener('submit', function(event) {
                    event.preventDefault();

                    const baseCurrency = document.getElementById('base_currency').value;
                    const targetCurrency = document.getElementById('target_currency').value;
                    const amount = parseFloat(document.getElementById('amount').value);

                    // Fetch exchange rates and perform conversion
                    fetch(`https://openexchangerates.org/api/latest.json?app_id=1713d426779640068c09a29589c6ade8&base=${baseCurrency}`)
                        .then(response => response.json())
                        .then(data => {
                            const exchangeRate = data.rates[targetCurrency];
                            const convertedAmount = amount * exchangeRate;

                            const resultElement = document.getElementById('result');
                            resultElement.textContent = `${amount} ${baseCurrency} is equal to ${convertedAmount.toFixed(2)} ${targetCurrency}`;
                        })
                        .catch(error => console.error('Error fetching exchange rates:', error));
                });
            });
        </script>
</body>

<?php
require 'footer.php';
?>