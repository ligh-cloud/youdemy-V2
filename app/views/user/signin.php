<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign In</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<h1>Sign In</h1>
<div id="loginForm" class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-8 rounded-xl shadow-lg">
        <div class="text-center">
            <h2 class="text-3xl font-bold text-gray-900">Welcome back</h2>
            <p class="mt-2 text-gray-600">Please sign in to your account</p>
        </div>
<form action="<?php echo URLROOT; ?>/userController/signin" method="POST">
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
<?php if (isset($data['error'])): ?>
    <p style="color: red;"><?php echo $data['error']; ?></p>
<?php endif; ?>
</body>
</html>


