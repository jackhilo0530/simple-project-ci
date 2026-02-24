<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>

<div class="min-h-screen flex-1 bg-gray-50/50 p-6 lg:p-10">
    <!-- Header Section -->
    <div class="mb-8 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900 sm:text-4xl">
                Edit User
            </h1>
            <p class="mt-2 text-sm text-gray-500">Update account information and security settings.</p>
        </div>
        <a href="<?php echo site_url('users'); ?>" class="rounded-lg border text-sm font-semibold text-indigo-600 transition-colors hover:text-indigo-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            &larr; Back to Users
        </a>
    </div>

    <!-- Main Form Card -->
    <div class="max-w-2xl overflow-hidden rounded-2xl border border-gray-200 border-gray-300 bg-white shadow-sm transition-all hover:shadow-md">

        <form action="<?php echo site_url('auth/edit_user/' . $user['id']); ?>" method="post" enctype="multipart/form-data" class="p-8">
            <div class="grid grid-cols-1 gap-y-6 space-y-8 sm:grid-cols-2 sm:gap-x-6">

                <!-- Username -->
                <div class="sm:col-span-1">
                    <label for="username" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-500">Username</label>
                    <input type="text" name="username" id="username"
                        value="<?php echo set_value('username', $user['username']); ?>"
                        class="shadow-xs block w-full rounded-xl border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20">
                </div>

                <!-- Email -->
                <div class="sm:col-span-1">
                    <label for="email" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-500">Email Address</label>
                    <input type="email" name="email" id="email"
                        value="<?php echo set_value('email', $user['email']); ?>"
                        class="shadow-xs block w-full rounded-xl border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20">
                </div>

                <!-- Role Selection -->
                <div class="sm:col-span-2">
                    <label for="role" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-500">User Role</label>
                    <select name="role" id="role"
                        class="shadow-xs block w-full appearance-none rounded-xl border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20">
                        <option value="admin" <?php echo set_select('role', 'admin', $user['role'] === 'admin'); ?>>Admin</option>
                        <option value="user" <?php echo set_select('role', 'user', $user['role'] === 'user'); ?>>User</option>
                    </select>
                </div>

                <!-- Current Avatar -->
                <div class="sm:col-span-2">
                    <label class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-500">Current Avatar</label>
                    <div class="flex items-center gap-4">
                        <img src="<?php echo base_url('uploads/avatars/' . ($user['img_path'] ?: 'default.jpg')); ?>" alt="Current Avatar" class="h-16 w-16 rounded-full border border-gray-300 object-cover">
                        <span class="text-sm text-gray-500">This is your current profile picture.</span>
                    </div>
                </div>

                <!-- Avatar Upload -->
                <div class="sm:col-span-2">
                    <label for="avatar" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-500">Change Avatar</label>
                    <input type="file" name="avatar" id="avatar" accept="image/*"
                        class="shadow-xs block w-full rounded-xl border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20">
                    <p class="mt-2 text-xs italic text-gray-400">Leave empty to keep current avatar.</p>
                </div>

                <!-- Previous Password -->
                <div class="sm:col-span-2">
                    <label for="current_password" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-500">Current Password</label>
                    <input type="password" name="current_password" id="current_password" placeholder=""
                        class="shadow-xs block w-full rounded-xl border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20">
                </div>

                <!-- New Password -->
                <div class="sm:col-span-1">
                    <label for="password" class="mb-1.5 block text-xs font-bold uppercase tracking-wider text-gray-500">New Password</label>
                    <input type="password" name="password" id="password" placeholder=""
                        class="shadow-xs block w-full rounded-xl border-gray-200 bg-gray-50/50 px-4 py-2.5 text-sm text-gray-900 outline-none transition-all focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-500/20">
                </div>
            </div>

            <!-- Footer Actions -->
            <div class="mt-3 flex justify-center gap-3 gap-x-4 pt-8">
                <button type="submit"
                    class="rounded-xl border bg-indigo-600 px-8 py-3 text-sm font-bold text-gray-500 shadow-lg shadow-indigo-200 transition-all hover:-translate-y-0.5 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-100 active:translate-y-0">
                    Save Changes
                </button>
                <button type="button" onclick="history.back()" class="rounded-xl border bg-indigo-600 px-8 py-3 text-sm font-bold text-gray-500 shadow-lg shadow-indigo-200 transition-all hover:-translate-y-0.5 hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-100 active:translate-y-0">Cancel</button>
            </div>
        </form>
    </div>
</div>