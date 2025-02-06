
<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentication - EduLearn</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="bg-gray-50">
    <?php if(isset($_SESSION['error'])): ?>
        <script>
            Swal.fire({
                title: "Error!",
                text: "<?php echo $_SESSION['error']; ?>",
                icon: "error"
            });
        </script>
        <?php unset($_SESSION['error']); ?>
    <?php elseif(isset($_SESSION['success'])): ?>
        <script>
            Swal.fire({
                title: "Good job!",
                text: "<?php echo $_SESSION['success']; ?>",
                icon: "success"
            });
        </script>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <nav class="bg-white shadow">
        <div class="max-w-7xl mx-auto px-4">
            <div class="flex justify-between h-16 items-center">
                <div class="flex items-center">
                    <a href="../public/index.php"><span class="text-2xl font-bold text-purple-600">YouDemy</span></a>
                </div>
                <div class="hidden md:flex items-center space-x-4">
                    <button onclick="showLogin()" class="text-gray-700 hover:text-purple-600">Login</button>
                    <button onclick="showSignup()" class="px-4 py-2 rounded-lg bg-purple-600 text-white hover:bg-purple-700">Sign Up</button>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Form -->
    <div id="loginForm" class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Welcome back</h2>
                <p class="mt-2 text-gray-600">Please sign in to your account</p>
            </div>
            <form method="POST" action="../controller/public/AuthController.php" class="mt-8 space-y-6" onsubmit="handleLogin(event)">
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input name="email" type="email" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input name="password" type="password" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input type="checkbox" class="h-4 w-4 text-purple-600 rounded border-gray-300">
                        <label class="ml-2 block text-sm text-gray-700">Remember me</label>
                    </div>
                    <a href="#" class="text-sm text-purple-600 hover:text-purple-500">Forgot password?</a>
                </div>

                <button name="signin" type="submit"
                    class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Sign In
                </button>

                <p class="text-center text-sm text-gray-600">
                    Don't have an account?
                    <button type="button" onclick="showSignup()" class="text-purple-600 hover:text-purple-500">Sign up</button>
                </p>
            </form>
        </div>
    </div>

    <!-- Signup Form -->
    <div id="signupForm" class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 hidden">
        <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Create Account</h2>
                <p class="mt-2 text-gray-600">Join our learning platform</p>
            </div>
            <form action="<?php echo URLROOT . '/userController/signup' ?>" method="POST" class="mt-8 space-y-6" onsubmit="handleSignup(event)">
                <div class="space-y-4">
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">First Name</label>
                            <input name="Fname" type="text" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Last Name</label>
                            <input name="Lname" type="text" required
                                class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Email</label>
                        <input name="email" type="email" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Password</label>
                        <input name="password" type="password" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input name="confirm_pass" type="password" required
                            class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="role" class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-purple-500">
                            <option value="3">Student</option>
                            <option value="2">Teacher</option>
                        </select>
                    </div>
                </div>

                <div class="flex items-center">
                    <input type="checkbox" required class="h-4 w-4 text-purple-600 rounded border-gray-300">
                    <label class="ml-2 block text-sm text-gray-700">
                        I agree to the Terms and Conditions
                    </label>
                </div>

                <button type="submit" name="create_acc"
                    class="w-full py-2 px-4 border border-transparent rounded-md shadow-sm text-white bg-purple-600 hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                    Create Account
                </button>

                <p class="text-center text-sm text-gray-600">
                    Already have an account?
                    <button type="button" onclick="showLogin()" class="text-purple-600 hover:text-purple-500">Sign in</button>
                </p>
            </form>
        </div>
    </div>

    <script>
        function showLogin() {
            document.getElementById('loginForm').classList.remove('hidden');
            document.getElementById('signupForm').classList.add('hidden');
        }

        function showSignup() {
            document.getElementById('loginForm').classList.add('hidden');
            document.getElementById('signupForm').classList.remove('hidden');
        }

        function handleLogin(event) {
            const formData = new FormData(event.target);
            const email = formData.get('email');
            const password = formData.get('password');

            console.log('Login attempt:', { email, password });
        }

        function handleSignup(event) {
            const formData = new FormData(event.target);
            console.log('Signup attempt:', Object.fromEntries(formData));

            const password = formData.get('password');
            const confirmPassword = formData.get('confirm_pass');

            if (password !== confirmPassword) {
                Swal.fire({
                    title: "Error!",
                    text: "Passwords do not match!",
                    icon: "error"
                });

            } else {
                Swal.fire({
                    title: "Good job!",
                    text: "You have been registered!",
                    icon: "success"
                });
                setTimeout(() => {
                    showLogin();
                }, 6000);
            }
        }

        function validatePassword(password) {
            const minLength = 8;
            const hasUpperCase = /[A-Z]/.test(password);
            const hasLowerCase = /[a-z]/.test(password);
            const hasNumbers = /\d/.test(password);
            const hasSpecialChar = /[!@#$%^&*(),.?":{}|<>]/.test(password);

            return password.length >= minLength && hasUpperCase && hasLowerCase &&
                hasNumbers && hasSpecialChar;
        }

        function showError(message) {
            const errorDiv = document.createElement('div');
            errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative';
            errorDiv.role = 'alert';
            errorDiv.textContent = message;

            setTimeout(() => errorDiv.remove(), 3000);
        }
    </script>
</body>

</html>