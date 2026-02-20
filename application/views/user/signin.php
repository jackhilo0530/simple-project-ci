<?php defined('BASEPATH') or exit('No direct script access allowed'); ?>
<div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 flex justify-center mt-12">
    <!-- Added hover:shadow-md and transition for a premium feel -->
    <div class="w-full max-w-md">

        <!-- Error Alert -->
        <?php if (isset($error)): ?>
            <div class="mb-6 p-4 text-sm text-red-800 bg-red-50 border border-red-200 rounded-lg flex items-center gap-2" role="alert">
                <i class="bi bi-exclamation-circle-fill"></i>
                <span><?php echo $error; ?></span>
            </div>
        <?php endif; ?>

        <div class="mb-8">
            <h1 class="text-3xl font-bold tracking-tight text-gray-900">Signin</h1>
        </div>

        <!-- Note: Ensure your controller 'auth/signin' matches this route -->
        <?php echo form_open('auth/signin', array('class' => 'space-y-6')); ?>

        <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">Username</label>
            <div class="text-xs font-medium text-red-600 mb-1"><?php echo form_error('username'); ?></div>
            <input type="text" id="username" name="username" placeholder="Your username"
                value="<?php echo set_value('username'); ?>"
                class="block w-full px-3 py-2.5 bg-white border border-gray-300 rounded-lg text-sm shadow-sm placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
        </div>

        <!-- Password -->
        <div>
            <div class="flex items-center justify-between mb-1">
                <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                <a href="#" class="text-xs font-semibold text-blue-600 hover:text-blue-500 no-underline transition-colors">Forgot password?</a>
            </div>
            <div class="text-xs font-medium text-red-600 mb-1"><?php echo form_error('password'); ?></div>
            <input type="password" id="password" name="password" placeholder="Your password"
                class="block w-full px-3 py-2.5 bg-white border border-gray-300 rounded-lg text-sm shadow-sm placeholder-gray-400 focus:outline-hidden focus:border-blue-500 focus:ring-1 focus:ring-blue-500 transition-all">
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit"
                class="w-full cursor-pointer flex justify-center py-2.5 px-4 border border-transparent rounded-lg shadow-sm text-sm font-semibold text-white bg-blue-600 hover:bg-blue-700 focus:outline-hidden focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-all active:scale-98">
                Signin
            </button>
        </div>

        <!-- Sign up Link -->
        <p class="text-center text-sm text-gray-600 mt-4">
            Don't have an account?
            <a href="<?php echo base_url('signup'); ?>" class="font-semibold text-blue-600 hover:text-blue-500 no-underline transition-colors">Sign up</a>
        </p>

        <?php echo form_close(); ?>
    </div>
</div>