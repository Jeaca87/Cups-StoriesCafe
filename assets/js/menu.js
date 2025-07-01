function showCategory(category) {
    const menuContent = document.getElementById('menu-content');

    setTimeout(() => {
        let items = [];

        if (category === "Coffee") {
            items = [
                { name: "Americano", price: "₱120", reward: "10 points", image: "/projectc&s/images/coffee1.jpg" },
                { name: "Cafe Latte", price: "₱100", reward: "8 points", image: "/projectc&s/images/coffee2.jpeg" },
                { name: "Cappuccino", price: "₱130", reward: "12 points", image: "/projectc&s/images/coffee1.jpg" },
                { name: "Mocha Latte", price: "₱130", reward: "12 points", image: "/projectc&s/images/coffee2.jepg" },
                { name: "White Mocha Latte", price: "₱130", reward: "12 points", image: "/projectc&s/images/coffee1.jpg" },
                { name: "Peppermint Mocha", price: "₱130", reward: "12 points", image: "/projectc&s/images/coffee2.jpeg" },
                { name: "Salted Caramel", price: "₱130", reward: "12 points", image: "/projectc&s/images/coffee1.jpg" },
                { name: "Caramel Macchiato", price: "₱130", reward: "12 points", image: "/projectc&s/images/coffee2.jpeg" },
                { name: "Hazelnut Latte", price: "₱130", reward: "12 points", image: "/projectc&s/images/coffee1.jpg" }
            ];
        } else if (category === "Non-Coffee") {
            items = [
                { name: "European Chocolate", price: "₱110", reward: "9 points", image: "/projectc&s/images/Ncoffee.jpg" },
                { name: "Matcha latte", price: "₱90", reward: "7 points", image: "/projectc&s/images/Ncoffee.jpg" },
                { name: "Green Tea", price: "₱140", reward: "12 points", image: "/projectc&s/images/Ncoffee.jpg" }
            ];
        } else if (category === "FRAPPE") {
            items = [
                { name: "Salted Caramel", price: "₱110", reward: "9 points", image: "/projectc&s/images/choco.jpg" },
                { name: "White Chocolate Mocha", price: "₱90", reward: "7 points", image: "/projectc&s/images/choco.jpg" },
                { name: "Java Chips", price: "₱140", reward: "12 points", image: "/projectc&s/images/choco.jpg" },
                { name: "Dark Mocha", price: "₱130", reward: "12 points", image: "/projectc&s/images/choco.jpg" },
                { name: "Oreo", price: "₱130", reward: "12 points", image: "/projectc&s/images/choco.jpg" },
                { name: "Coffee Jelly", price: "₱130", reward: "12 points", image: "/projectc&s/images/choco.jpg" },
                { name: "Caramel Coffee Jelly", price: "₱130", reward: "12 points", image: "/projectc&s/images/choco.jpg" },
                { name: "Matcha Latte", price: "₱130", reward: "12 points", image: "/projectc&s/images/choco.jpg" }
            ];
        } else if (category === "Milk Tea") {
            items = [
                { name: "Okinawa", price: "₱110", reward: "9 points", image: "/projectc&s/images/Milktea.jpg" },
                { name: "Dark Chocolate", price: "₱90", reward: "7 points", image: "/projectc&s/images/Milktea.jpg" },
                { name: "Dark Chocolate with Oreo", price: "₱140", reward: "12 points", image: "/projectc&s/images/Milktea.jpg" },
                { name: "Strawberry Smoothie", price: "₱130", reward: "12 points", image: "/projectc&s/images/Milktea.jpgno.jpg" },
                { name: "Red Velvet", price: "₱130", reward: "12 points", image: "/projectc&s/images/Milktea.jpgo.jpg" },
                { name: "Salted Caramel", price: "₱130", reward: "12 points", image: "/projectc&s/images/Milktea.jpg" },
                { name: "Nutella", price: "₱130", reward: "12 points", image: "/projectc&s/images/Milktea.jpg" }
            ];
        } else if (category === "Pasta") {
            items = [
                { name: "Spaghetti", price: "₱110", reward: "9 points", image: "/projectc&s/images/spag.jpg" },
                { name: "Carbonara", price: "₱90", reward: "7 points", image: "/projectc&s/images/spag.jpg" },
                { name: "Creamy Pesto", price: "₱140", reward: "12 points", image: "/projectc&s/images/pesto.jpeg" }
            ];
        }else if (category === "Sandwich") {
            items = [
                { name: "Clubchouse", price: "₱110", reward: "9 points", image: "/projectc&s/images/sandwich.jpg" },
                { name: "Tuna Sandwich", price: "₱90", reward: "7 points", image: "/projectc&s/images/sandwich.jpg" },
                { name: "Peanutbutter Jelly", price: "₱140", reward: "12 points", image: "/projectc&s/images/sandwich.jpg" },
                { name: "French Toast with Cream cheese & Marmalade", price: "₱130", reward: "12 points", image: "/projectc&s/images/sandwich.jpg" },
                { name: "Ham & Cheese", price: "₱130", reward: "12 points", image: "/projectc&s/images/sandwich.jpg" }
            ];
        } else if (category === "PICA PICA") {
            items = [
                { name: "Beef Nachos", price: "₱110", reward: "9 points", image: "/projectc&s/images/fries.jpg" },
                { name: "Cheese Quesadilla", price: "₱90", reward: "7 points", image: "/projectc&s/images/fries.jpg" },
                { name: "Beef Quesadilla", price: "₱140", reward: "12 points", image: "/projectc&s/images/fries.jpg" },
                { name: "Tacos", price: "₱130", reward: "12 points", image: "/projectc&s/images/fries.jpg" },
                { name: "Fries", price: "₱130", reward: "12 points", image: "/projectc&s/images/fries.jpg" }
            ];
        } else if (category === "Rice Meals") {
            items = [
                { name: "Fried Quarter Chicken", price: "₱140", reward: "12 points", image: "/projectc&s/images/ricechick.jpg" },
                { name: "Spicy Fried Quarter Liempo", price: "₱130", reward: "12 points", image: "/projectc&s/images/ricechick.jpg" },
                { name: "Lengua on Creamy Sauce", price: "₱130", reward: "12 points", image: "/projectc&s/images/ricechick.jpg" },
                { name: "Beef Caldereta", price: "₱130", reward: "12 points", image: "/projectc&s/images/ricechick.jpg" }
            ];
        } else if (category === "Cake") {
            items = [
                { name: "Blueberry Cheesecake", price: "₱110", reward: "9 points", image: "/projectc&s/images/Strawberry-Cheesecake.jpg" },
                { name: "Chocolate Praline", price: "₱90", reward: "7 points", image: "/projectc&s/images/Strawberry-Cheesecake.jpg" },
                { name: "Salted Caramel Cheesecake", price: "₱140", reward: "12 points", image: "/projectc&s/images/Strawberry-Cheesecake.jpg" },
                { name: "Bisco Cheesecake", price: "₱130", reward: "12 points", image: "/projectc&s/images/Strawberry-Cheesecake.jpg" }
            ];
        }

        if (items.length > 0) {
            let contentHtml = `<h2>${category}</h2>`;
            items.forEach(item => {
                contentHtml += `
                    <div class="menu-item">
                        <img src="${item.image}" alt="${item.name}" class="menu-item-image">
                        <h3>${item.name}</h3>
                        <p>Price: ${item.price}</p>
                        <p>Reward: ${item.reward}</p>
                    </div>
                `;
            });
            menuContent.innerHTML = contentHtml;
        } else {
            menuContent.innerHTML = `<p>No items available for "${category}".</p>`;
        }
    }, 500);
}
