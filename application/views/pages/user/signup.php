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

        <?php echo form_open_multipart('auth/signup', array('class'=> 'space-y-5')); ?>

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

        <!-- Avatar Upload (v4 styled) -->
        <div>
            <label for="avatar" class="block text-sm font-medium text-gray-700 mb-1">Choose your Avatar</label>
            <input type="file" id="avatar" name="avatar"
                class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
        </div>

        <!-- Submit -->
        <div class="pt-2">
            <input type="submit" value="Signup"
                class="w-full cursor-pointer flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors">
        </div>
        </form>
    </div>
</div>