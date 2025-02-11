window.addEventListener('load', async function () {
    const url = "../public/drinks.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const json = await response.json();
        insertDrinks(json);
    } catch (error) {
        console.error(error.message);
    }
});

function insertDrinks(drinks) {
    const menuList = document.querySelector("#menu_list");
    const template = document.querySelector("#drink_template");
    for (const drinkInfo of drinks) {
        const drink = drinkInfo['drink'];
        const sizes = drinkInfo['sizes'];
        const clone = template.content.cloneNode(true);
        let img = clone.querySelector("div.thumbnail img");
        let name = clone.querySelector("div.desc h3");
        let prices = clone.querySelector("div.desc .prices");
        img.src = (drink.image.startsWith("public") ? "../" : "") + drink.image;
        name.textContent = drink.name;
        for (const price of sizes) {
            let p = document.createElement("button");
            p.innerHTML = `${price.size}<br>$${price.pricePromo ?? price.price}`;
            p.style.minWidth = '80px';
            p.onclick = function (e) {
                e.preventDefault();
                p.form.querySelector("input[name='drink-id']").value = drink.id;
                p.form.querySelector("input[name='size']").value = price.size;
                p.form.submit();
            }
            prices.appendChild(p);
        }
        menuList.appendChild(clone);
    }
}