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
        <a href="/" style="position: fixed; align-self: end; margin-right: 50px;">Home</a>

        <form method="post" action="/users">
            @csrf

            <h2>Create new user</h2>

            <div style="display: flex; flex-direction: column;">
                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="firstName" placeholder="First Name" required>
                <input type="text" name="lastName" placeholder="Last Name" required>
                <input type="text" name="location" placeholder="Location">
                <input type="text" name="jobTitle" placeholder="Job Title" required>
                <input type="number" name="hourlyRate" step="0.01" placeholder="Hourly Rate" required>
                <select name="currency" required>
                    <option value="" selected>Please choose a currency...</option>
                    <option value="eur">EUR</option>
                    <option value="usd">USD</option>
                    <option value="gbp">GBP</option>
                </select>
                <input type="text" name="bio" placeholder="Bio">

                <button type="submit">Submit</button>
            </div>
        </form>
    </body>
</html>