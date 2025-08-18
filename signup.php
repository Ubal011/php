<?php
// signup.php - User Registration Page
$pageTitle = 'Ballot BUZZ - Sign Up';
$activePage = 'signup'; // Corrected to reflect the active page
$pageStyles = <<<CSS
body {
    margin: 0;
    font-family: Arial, sans-serif;
    background-image: url('https://i.im.ge/2025/08/11/JxP26M.bbuzz.png');
    background-size: cover;
    background-position: center;
    color: white;
    display: flex;
    height: 100vh;
    align-items: center;
    justify-content: center;
}
.container {
    background-color: rgba(26, 26, 46, 0.95);
    padding: 2rem;
    border-radius: 1rem;
    box-shadow: 0 0 20px rgba(0,0,0,0.5);
    width: 350px;
}
h1 {
    text-align: center;
    margin-bottom: 1rem;
}
input, select {
    width: 100%;
    padding: 0.5rem;
    margin: 0.4rem 0 1rem 0;
    border-radius: 0.5rem;
    border: none;
}
button {
    width: 100%;
    background-color: #003b99;
    color: white;
    padding: 0.7rem;
    font-size: 1rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
}
.error {
    color: #f44336;
    margin-bottom: 1rem;
    font-weight: bold;
    text-align: center;
}
CSS;

// Include header
include __DIR__ . '/includes/header.php';
?>

<div class="container">
    <h1>Sign Up</h1>
    <div id="error-msg" class="error"></div>
    <form id="signup-form">
        <input type="text" id="fullname" placeholder="Full Name" required />
        <input type="number" id="age" placeholder="Age" min="1" required />
        <input type="date" id="birthday" placeholder="Birthday" required />
        <input type="text" id="address" placeholder="Address" required />
        <select id="valid-id" required>
            <option value="">Select Valid ID</option>
            <option>National ID</option>
            <option>Driver's License</option>
            <option>Senior Citizen</option>
            <option>Passport</option>
            <option>SSS ID</option>
        </select>
        <input type="text" id="username" placeholder="Username" required />
        <input type="password" id="password" placeholder="Password" required />
        <button type="submit">Sign Up</button>
    </form>
</div>

<script>
const form = document.getElementById('signup-form');
const errorMsg = document.getElementById('error-msg');

form.addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent default form submission
    errorMsg.textContent = ''; // Clear previous error messages

    // Gather form data
    const fullname = document.getElementById('fullname').value.trim();
    const age = parseInt(document.getElementById('age').value);
    const birthday = document.getElementById('birthday').value;
    const address = document.getElementById('address').value.trim();
    const validId = document.getElementById('valid-id').value;
    const username = document.getElementById('username').value.trim();
    const password = document.getElementById('password').value;

    // Validation checks
    if (!fullname || !age || !birthday || !address || !validId || !username || !password) {
        errorMsg.textContent = 'Please fill in all fields.';
        return;
    }
    if (age < 1) {
        errorMsg.textContent = 'Age must be at least 1.';
        return;
    }
    if (localStorage.getItem('user_' + username)) {
        errorMsg.textContent = 'Username already taken.';
        return;
    }

    // Create user object and store in local storage
    const user = { fullname, age, birthday, address, validId, username, password };
    localStorage.setItem('user_' + username, JSON.stringify(user));

    // Success message and redirect
    alert('Registration successful! You can now log in.');
    window.location.href = 'login.php'; // Redirect to login page
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
