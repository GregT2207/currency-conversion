<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Currency Conversion</title>

        <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
        <link rel="stylesheet" href="/styles.css">
    </head>
    <body>
        <a href="/users/create" style="position: fixed; align-self: end; margin-right: 50px;">Create new user</a>

        <form id="convertForm">
            @csrf

            <h2>Convert user currency</h2>

            <div style="display: flex; flex-direction: column;">
                <input type="number" name="userID" step="1" placeholder="User ID" required>
                <select name="currency" required>
                    <option value="" selected>Please choose a currency...</option>
                    <option value="eur">EUR</option>
                    <option value="usd">USD</option>
                    <option value="gbp">GBP</option>
                </select>

                <button type="submit">Submit</button>
            </div>
        </form>

        <script>
            var form = document.querySelector('#convertForm');
            form.addEventListener('submit', (e) => {
                e.preventDefault();

                window.location.href = '/users/'+form.userID.value+'/'+form.currency.value;
            })
        </script>
    </body>
</html>