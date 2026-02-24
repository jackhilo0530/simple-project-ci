<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex justify-center mt-10">
    <div class="w-full max-w-lg">
        <!-- Error Alert -->
        <?php if (isset($error)): ?>
            <div class="mb-6 p-4 text-sm text-red-700 bg-red-50 border border-red-200 rounded-lg" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Signup</h1>
        </div>

        <?php echo form_open_multipart('auth/signup', array('class' => 'space-y-5')); ?>

        <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <div class="text-xs text-red-600 mb-1"><?php echo form_error('username'); ?></div>
            <input type="text" id="username" name="username" placeholder="Enter a username"
                value="<?php echo set_value('username'); ?>"
                class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
            <div class="text-xs text-red-600 mb-1"><?php echo form_error('email'); ?></div>
            <input type="email" id="email" name="email" placeholder="Enter your email"
                value="<?php echo set_value('email'); ?>"
                class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
            <div class="text-xs text-red-600 mb-1"><?php echo form_error('password'); ?></div>
            <input type="password" id="password" name="password" placeholder="Enter a password"
                class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirm" class="block text-sm font-medium text-gray-700 mb-1">Confirm password</label>
            <div class="text-xs text-red-600 mb-1"><?php echo form_error('password_confirm'); ?></div>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm your password"
                class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Wrapper for One Row -->
        <div class="mt-4 flex flex-row gap-4">

            <!-- Role Selection -->
            <div class="basis-1/2">
                <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Select Role</label>
                <div class="text-xs text-red-600 mb-1"><?php echo form_error('role'); ?></div>
                <select id="role" name="role"
                    class="block w-full px-3 py-2 bg-white border border-gray-300 rounded-md text-sm shadow-sm focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
                    <option value="">Choose a role...</option>
                    <option value="user" <?php echo set_select('role', 'user'); ?>>User</option>
                    <option value="admin" <?php echo set_select('role', 'admin'); ?>>Admin</option>
                </select>
            </div>

            <!-- Avatar Upload Row -->
            <div class="mt-4 flex flex-col md:flex-row gap-4 items-end">
                <div class="basis-1/2">
                    <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Choose your Avatar</label>
                    <input type="file" id="avatar" name="avatar" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">

                    <!-- Preview Area -->
                    <div id="previewContainer" class="mt-4 ml-auto">
                        <div class="h-16 w-16 rounded-full bg-gray-100 border-2 border-gray-200 overflow-hidden">
                            <!-- Placeholder Icon -->
                            <svg id="placeholderIcon" class="h-8 w-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <!-- The Actual Image (Initial src is a transparent pixel to avoid broken icons) -->
                            <img id="avatarPreview"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                alt="Avatar Preview"
                                class="h-full w-full object-cover hidden">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Submit -->
        <div class="pt-2">
            <input type="submit" value="Signup"
                class="w-full cursor-pointer flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
        </div>
        </form>
    </div>
</div>

<script>
    document.getElementById('avatar').addEventListener('change', function(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('avatarPreview');
        const placeholder = document.getElementById('placeholderIcon');

        if (file) {
            const reader = new FileReader();

            reader.onload = function(e) {
                // 1. Set the new source
                preview.src = e.target.result;
                // 2. Show the image, hide the icon
                preview.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }

            reader.readAsDataURL(file);
        } else {
            // Reset if user cancels
            preview.classList.add('hidden');
            placeholder.classList.remove('hidden');
            nameLabel.textContent = "No file selected";
        }
    });
</script>