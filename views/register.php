<?php
global $countries;
global $categories;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php Component::renderComponent("links.php"); ?>
    <script src="../public/scripts/validators.js" defer></script>
    <script src="../public/scripts/register.js" defer></script>
    <title>Register</title>
    <link rel="stylesheet" href="../public/styles/styles.css">
</head>
<body>
<script>
    window.addEventListener('load', function () {
        let countriesData = <?= json_encode($countries) ?>;
        let countries = countriesData.map(el => el.country);
        let states = countriesData.reduce((dict, el) => {
            dict[el.country.id] = el.states;
            return dict;
        }, []);
        let countrySelector = document.getElementById("country");
        let stateSelector = document.getElementById("state");

        for (const country of [{id: "", name: "Select your country"}, ...countries]) {
            let opt = document.createElement('option');
            opt.value = country.id;
            opt.innerHTML = country.name;
            countrySelector.appendChild(opt);
        }

        countrySelector.addEventListener("change", (event) => {
            stateSelector.innerHTML = '';
            stateSelector.value = null;
            for (const state of [{id: "", name: "Select your state"}, ...(states[event.target.value])]) {
                let opt = document.createElement('option');
                opt.value = state.id;
                opt.innerHTML = state.name;
                stateSelector.appendChild(opt);
            }
        });
    });
</script>
<header>
    <?php Component::renderComponent("nav.php"); ?>
</header>
<main class="register">
    <section id="register">
        <h1>Register</h1>
        <form method="post" action="#" novalidate>
            <div>
                <label for="first-name">First Name:</label>
                <input type="text" id="first-name" name="first-name" required>
                <div id="first-name_error" class="error"></div>
            </div>

            <div>
                <label for="last-name">Last Name:</label>
                <input type="text" id="last-name" name="last-name" required>
                <div id="last-name_error" class="error"></div>
            </div>

            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <div id="email_error" class="error"></div>
            </div>

            <div>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <div id="password_error" class="error"></div>
            </div>

            <div>
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
                <div id="confirm-password_error" class="error"></div>
            </div>

            <div>
                <fieldset>
                    <legend>Gender:</legend>
                    <input type="radio" name="gender" value="M" required> Male
                    <input type="radio" name="gender" value="F"> Female
                </fieldset>
                <div id="gender_error" class="error"></div>
            </div>

            <div>
                <fieldset>
                    <legend>Interests:</legend>
                    <?php foreach ($categories as $category): ?>
                        <label><input type="checkbox" name="interests[]"
                                      value="<?= $category->id; ?>"> <?= $category->name; ?></label>
                    <?php endforeach; ?>
                </fieldset>
                <div id="interests[]_error" class="error"></div>
            </div>

            <div>
                <label for="country">Country:</label>
                <select id="country" name="country" required>
                </select>
                <div id="country_error" class="error"></div>
            </div>

            <div>
                <label for="state">State:</label>
                <select id="state" name="state" required>
                    <option value="">Select your state</option>
                </select>
                <div id="state_error" class="error"></div>
            </div>

            <button type="submit">Register</button>
        </form>
    </section>
</main>

<?php Component::renderComponent("footer.php"); ?>
<?php Component::renderComponent("modal.php"); ?>
</body>
</html>