document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll('.product_btn');
    const monthSelects = document.querySelectorAll('.months_select');

    addToCartButtons.forEach(button => {
        button.addEventListener('click', function (event) {
            event.preventDefault();
            const productId = this.getAttribute('href').split('=')[1];
            addToCart(productId);
        });
    });

    monthSelects.forEach(select => {
        select.addEventListener('change', function () {
            const productId = this.dataset.id;
            const months = this.value;
            updateMonths(productId, months);
        });
    });

    function addToCart(productId) {
        fetch(`cart.php?action=add&id=${productId}`)
            .then(response => {
                if (response.ok) {
                    return response.text();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                alert('Product added to cart!');
                location.reload(); // Reload the page to update the cart
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }

    function updateMonths(productId, months) {
        fetch(`cart.php?action=update_months&id=${productId}&months=${months}`)
            .then(response => {
                if (response.ok) {
                    return response.text();
                }
                throw new Error('Network response was not ok.');
            })
            .then(data => {
                location.reload(); // Reload the page to update the total price
            })
            .catch(error => {
                console.error('There was a problem with the fetch operation:', error);
            });
    }
});
