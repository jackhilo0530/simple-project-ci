<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="mx-auto mt-10 flex max-w-7xl justify-center px-4 sm:px-6 lg:px-8">
    <div class="w-full max-w-lg">
        <!-- Error Alert -->
        <?php if (isset($error)): ?>
            <div class="mb-6 rounded-lg border border-red-200 bg-red-50 p-4 text-sm text-red-700" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Signup</h1>
        </div>

        <?php echo form_open_multipart('signup', array('class' => 'space-y-5')); ?>

        <!-- Username -->
        <div>
            <label for="username" class="mb-1 block text-sm font-medium text-gray-700">Username</label>
            <div class="mb-1 text-xs text-red-600"><?php echo form_error('username'); ?></div>
            <input type="text" id="username" name="username" placeholder="Enter a username"
                value="<?php echo set_value('username'); ?>"
                class="focus:outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="mb-1 block text-sm font-medium text-gray-700">Email</label>
            <div class="mb-1 text-xs text-red-600"><?php echo form_error('email'); ?></div>
            <input type="email" id="email" name="email" placeholder="Enter your email"
                value="<?php echo set_value('email'); ?>"
                class="focus:outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="mb-1 block text-sm font-medium text-gray-700">Password</label>
            <div class="mb-1 text-xs text-red-600"><?php echo form_error('password'); ?></div>
            <input type="password" id="password" name="password" placeholder="Enter a password"
                class="focus:outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirm" class="mb-1 block text-sm font-medium text-gray-700">Confirm password</label>
            <div class="mb-1 text-xs text-red-600"><?php echo form_error('password_confirm'); ?></div>
            <input type="password" id="password_confirm" name="password_confirm" placeholder="Confirm your password"
                class="focus:outline-hidden block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm placeholder-gray-400 shadow-sm focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
        </div>

        <!-- Wrapper for One Row -->
        <div class="mt-4 flex flex-row gap-4">

            <!-- Role Selection -->
            <div class="basis-1/2">
                <label for="role" class="mb-1 block text-sm font-medium text-gray-700">Select Role</label>
                <div class="mb-1 text-xs text-red-600"><?php echo form_error('role'); ?></div>
                <select id="role" name="role"
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2 text-sm shadow-sm focus:border-blue-500 focus:outline-none focus:ring-1 focus:ring-blue-500">
                    <option value="">Choose a role...</option>
                    <option value="user" <?php echo set_select('role', 'user'); ?>>User</option>
                    <option value="admin" <?php echo set_select('role', 'admin'); ?>>Admin</option>
                </select>
            </div>

            <!-- Avatar Upload Row -->
            <div class="mt-4 flex flex-col items-end gap-4 md:flex-row">
                <div class="basis-1/2">
                    <label for="avatar" class="mb-1 block text-sm font-medium text-gray-700">Choose your Avatar</label>
                    <input type="file" id="avatar" name="avatar" accept="image/*"
                        class="block w-full text-sm text-gray-500 file:mr-4 file:rounded-md file:border-0 file:bg-blue-50 file:px-4 file:py-2 file:text-sm file:font-semibold file:text-blue-700 hover:file:bg-blue-100">

                    <!-- Preview Area -->
                    <div id="previewContainer" class="ml-auto mt-4">
                        <div class="h-16 w-16 overflow-hidden rounded-full border-2 border-gray-200 bg-gray-100">
                            <!-- Placeholder Icon -->
                            <svg id="placeholderIcon" class="h-8 w-8 text-gray-400" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                            </svg>
                            <!-- The Actual Image (Initial src is a transparent pixel to avoid broken icons) -->
                            <img id="avatarPreview"
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                alt="Avatar Preview"
                                class="hidden h-full w-full object-cover">
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Submit -->
        <div class="pt-2">
            <input type="submit" value="Signup"
                class="focus:outline-hidden flex w-full cursor-pointer justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm transition-colors hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
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