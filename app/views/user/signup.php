<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<h1>Sign Up</h1>

<?php if (isset($data['error'])): ?>
    <p style="color: red;"><?php echo $data['error']; ?></p>
<?php endif; ?>

<?php if (isset($_SESSION['signup_success'])): ?>
    <script>
        Swal.fire({
            icon: 'success',
            title: 'Inscription réussie!',
            text: 'Votre compte a été créé avec succès.',
            confirmButtonText: 'OK'
        });
        <?php unset($_SESSION['signup_success']); // Unset the session variable after displaying the message ?>
    </script>
<?php endif; ?>


<div id="signupForm" class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 hidden">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Create Account</h2>
            <p class="mt-2 text-gray-600">Join our learning platform</p>
        </div>
        <form action="<?php echo URLROOT; ?>/userController/signup" method="POST">
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
</body>
</html>