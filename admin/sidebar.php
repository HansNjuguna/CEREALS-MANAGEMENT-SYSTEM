<h1>CMS</h1>
<ul>
    <li><a href="dashboard.php">Dashboard</a> </li>
    <li><a href="Products.php">Products</a></li>
    <li><a href="add_product.php">Add Products</a></li>
    <li><a href="orders.php">Orders</a></li>
    <li><a href="users.php">Users</a></li>
    <li><a href="messages.php">Messages</a></li>
    <li><a href="settings.php">Settings</a></li>
    <li><a href="../logout.php">Logout</a></li>
</ul>
<script>
    // get current page
    let current = window.location.pathname;
    console.log(current);
    // get all links
    let links = document.querySelectorAll('a');
    // loop through links
    links.forEach(link => {
        // get link href
        let href = link.getAttribute('href');
        // add /work/CEREALS%20MANAGEMENT%20SYSTEM/admin/ to href
        href = '/work/CEREALS%20MANAGEMENT%20SYSTEM/admin/' + href;
        // if current page is equal to link href
        if (current == href) {
            // add active class to link
            link.classList.add('active');
        }
    });
</script>